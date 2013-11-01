<?php

class CurationController extends Controller
{
    
        public function filters() {
           return array(
               'accessControl', // perform access control for CRUD operations
               'postOnly + delete', // we only allow deletion via POST request
           );
       }
       
        public function accessRules() {
            
            return array(
                array('allow',
                    'actions'=>array('Approve','UpdateSite','CreateSite','Facilities','pendingRequests','SearchFacilityByPSCode','viewFacility'),
                    'users'=>array('@'),
                    ),
                array('deny', // deny all users
                'users' => array('*'),
            ),
                );
        }
    
	public function actionViewFacility($id)
	{
		$this->render('facility', 
                        array('model'=>$this->loadFacility($id,Yii::app()->params['resourceMapConfig']['curation_collection_id'])));
	}
        
        public function loadFacility($id,$collection_id){
            $url = Yii::app()->params['api-domain']."/collections/".
                   $collection_id.
                   "/sites/$id.json"; 
            $response = RestUtility::execCurl($url);
            $result = CJSON::decode($response,true);
            
            return $result;
        }
       
        
        public function actionFacilities($node_id = null){
            
            $url = Yii::app()->params['api-domain']."/api/collections/".
                   Yii::app()->params['resourceMapConfig']['public_collection_id'].".json?page=all&Admin_div[under]=".
                   Yii::app()->user->getState('node_id');          
            if(isset($node_id))
                $url = Yii::app()->params['api-domain']."/api/collections/".
                       Yii::app()->params['resourceMapConfig']['public_collection_id'].
                       ".json?page=all&Admin_div[under]={$node_id}";
            $response = RestUtility::execCurl($url);
            $result = CJSON::decode($response,true);
            
            $totalItemCount = (int)$result['count'];
            $totalPages = (int)$result['totalPages']==0?1:(int)$result['totalPages'];
            $pageSize = ceil($totalItemCount/$totalPages);

            $sites = new CArrayDataProvider($result['sites'],
                          array(
                                'totalItemCount'=>$totalItemCount,
                                'pagination'=>array(
                                    'pageSize'=>20
                                    )
                              )
                    );
            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_facilityGrid',array('sites'=>$sites));
                Yii::app()->end();
            }
            
            $result = Yii::app()->cache->get('hierarchy');
            $rootNode = Yii::app()->user->getState('node_id');
            $filteredData = Layer::search($result['config']['hierarchy'],'id',$rootNode);
            $data = $this->parseHierarchy($filteredData);
            $this->render('exploreFacilities',array('data'=>$data,'sites'=>$sites));
        }
        
        public function actionSearchFacilityByPSCode($search_query){
            if(isset($search_query)){
                $url = Yii::app()->params['api-domain']."/api/collections/".
                       Yii::app()->params['resourceMapConfig']['public_collection_id'].
                       ".json?page=all&Fac_IDNumber={$search_query}";
                       
                $response = RestUtility::execCurl($url);
                $result = CJSON::decode($response,true);
                
                $totalItemCount = (int)$result['count'];
                $sites = new CArrayDataProvider($result['sites'],
                          array(
                                'totalItemCount'=>$totalItemCount,
                                'pagination'=>array(
                                    'pageSize'=>20
                                    )
                              )
                    );
                 
                $this->renderPartial('_facilityGrid', array('sites'=>$sites));
            }
        }
        
        
        public function parseHierarchy($hierarchy){
             $treeArray = array();
                if(is_array($hierarchy)){
                    foreach($hierarchy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = $this->parseHierarchy($node['sub']);
                                $treeNodeArray = array('text'=>'<span style="color:#3AA1BF;">'.CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],$this->createUrl('facilities',array('node_id'=>$node['id']))).'</span>','children'=>$subNodes);
                            }else{
                                $treeNodeArray = array('text'=>'<span style="color:#3AA1BF;">'.CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],$this->createUrl('facilities',array('node_id'=>$node['id']))).'</span>');
                            }
                            array_push($treeArray, $treeNodeArray);                       
                        }
                      }
                                       
                    } 
                    
                   return $treeArray;
                }
                       
        }
        
        
        public function actionPendingRequests(){  
            
                $myPendingRequests = array();
                $models = ChangeRequest::model()->findAllByAttributes(array('status'=>ChangeRequest::STATUS_PENDING));
                foreach($models as $model){
                    if($this->hasApprovePrivilegesForRequest($model->requestedBy->node_id)){
                        array_push($myPendingRequests, $model);
                    }
                }
                $this->render('pending_requests',array('models'=>$myPendingRequests));
              
        }
        
        public function hasApprovePrivilegesForRequest($node_id){
            
            $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['curation_collection_id']."/fields/".
                   FieldMapping::CC_HIERARCHY_FIELD_ID."/hierarchy?under=".Yii::app()->user->getState('node_id')."&node={$node_id}";
            
            $isUnderFlag = RestUtility::execCurl($url);       
            if($isUnderFlag)
                return true;
            
            return false;
        }
        
        
        public function onSiteCreateRequest($event){
            $this->raiseEvent('onSiteCreateRequest', $event);
        }
        
        public function afterSiteCreate($site){
            if($this->hasEventHandler('onSiteCreateRequest')){
                $event = new CEvent($this,$site);
                $this->onSiteCreateRequest($event);
            }
        }
        
        public function logChangeRequest($event){
            $model = new ChangeRequest();
            $site = $event->params;
            
            $model->note = $site['note'];
            $model->cc_site_id = $site['id'];
            $model->primary_site_code = $site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE];
            $model->version_id = $site['version'];
            $model->requested_by = Yii::app()->user->getState('user_id');
            $model->request_type = $site['request_type'];
            $model->status = ChangeRequest::STATUS_PENDING;
            $model->requested_date = date('Y-m-d H:i:s');
            
            $model->save();
            $this->logChangeRequestNote($model);
            $this->logChangeRequestFields($model->id, $site['saved_properties']);
        }
        
        public function logChangeRequestNote($changeRequestModel){
           $model = new ChangeRequestNote();
           $model->change_request_id = $changeRequestModel->id ;
           $model->user_id = Yii::app()->user->getState('user_id');
           $model->note = $changeRequestModel->note;
           $model->save();
        }
        
        public function logChangeRequestFields($change_request_id,$fields){
            
            foreach($fields as  $key=>$value){
                $model = new ChangeRequestFields();
                $model->change_request_id = $change_request_id;
                $model->field_id = $key;
                $model->save();
            }
            
               
        }
        
        public function actionCreateSite(){
            
            
            $model = new FacilityForm();
            
            if(isset($_POST['FacilityForm'])){
               
               $url = Yii::app()->params['api-domain']."/collections/".
                      Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                      "/sites.json";
             
               //capture form values
               $model->attributes = $_POST['FacilityForm'];
                   if($model->validate()){
                        //prepare properties array
                        $properties = array();
                        foreach($model->attributes as $key=>$attribute){
                            if($key=='note')continue;
                            $properties[trim($key,'_')] = $attribute;
                        }

                        $data = array(
                             'name'=>$model->_1815,//common facility name
                             'properties'=>$properties,
                         );

                     //convert data into json format 
                     $json = CJSON::encode($data);

                     $params = array('site'=>$json);
                     $response = RestUtility::execCurlPost($url, $params);
                     $site = CJSON::decode($response);
                     $site['note'] = $model->note;
                     $site['request_type'] = ChangeRequest::TYPE_CREATE;
                     $site['saved_properties'] = $site['properties'];
                     //echo $response;exit;
                         if(isset($site['id'])){

                             $this->onSiteCreateRequest = array($this,'logChangeRequest');
                             $this->afterSiteCreate($site);
                             Yii::app()->user->setFlash('success','Site created successfully');
                             $this->render('facility',array('model'=>$site));
                             Yii::app()->end();
                         }
                         else{  
                             Yii::app()->user->setFlash('failure','Site creation failed');
                         }
                   }
            }
            
          
            $this->render('site_form',array('model'=>$model,'layers'=>$this->generateCurationForm($model)));
        }
        
        
        
        public function actionUpdateSite($id){
            
            $site = $this->loadFacility($id, 
                     Yii::app()->params['resourceMapConfig']['curation_collection_id']
                    ); 
            $form = new FacilityForm();
            if($site){
                foreach($site['properties'] as $key=>$value){
                   $form->setAttributes(array("_$key"=>$value));
                }
            }
            
            if(isset($_POST['FacilityForm'])){  
                
                $form->attributes = $_POST['FacilityForm'];
                if($form->validate()){
                $properties = array();
                foreach($form->attributes as $key=>$attribute){
                    if($key=='note')continue;
                    //check for updated fields only and add them to properties array
                    if(isset($site['properties'][trim($key,'_')])){
                        if($form->attributes[$key] != $site['properties'][trim($key,'_')]){
                            $properties[trim($key,'_')] = $attribute;
                        }
                    }else{
                        if($form->attributes[$key]!= null){
                            $properties[trim($key,'_')] = $attribute;
                        }
                    }
                }
                
                //print_r($properties);exit;
                $data = array(
                    'name'=>$form->_1815,//common facility name
                    'properties'=>$properties,
                );
              
                //convert data into json format 
                $json = CJSON::encode($data);
               
                $params = array('site'=>$json);
                $url = Yii::app()->params['api-domain']."/collections/".
                       Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                      "/sites/{$id}/partial_update";
                $response = RestUtility::execCurlPost($url, $params);
                $site = CJSON::decode($response);
                $site['note'] = $form->note;
                $site['request_type'] = ChangeRequest::TYPE_UPDATE;
                $site['saved_properties'] = $properties;
                $site['saved_properties'][FieldMapping::CC_PRIMARY_SITE_CODE]=$site['properties'][FieldMapping::CC_PRIMARY_SITE_CODE];
                //print_r($site['saved_properties']);exit;
                //echo $response;exit;
                  if(isset($site['id'])){

                             $this->onSiteCreateRequest = array($this,'logChangeRequest');
                             $this->afterSiteCreate($site);
                             Yii::app()->user->setFlash('success','Site Updated successfully');
                             $this->render('facility',array('model'=>$site));
                             Yii::app()->end();
                         }
                         else{  
                             Yii::app()->user->setFlash('failure','Site update failed');
                         }
                         
                  }//if(validate())
            }
            
            $this->render('site_form',array('model'=>$form,'layers'=>$this->generateCurationForm($form)));
        }
        
        public function generateCurationForm($formModel){
            
            $fieldMappings = FieldMapping::model()->findAll();
            $layerMappings = LayerMapping::model()->findAll();
            $layers = array();
            foreach($fieldMappings as $fieldMapping){

                   $fieldDetails = CJSON::decode($fieldMapping->cc_field_structure,true);
                   
                   foreach($layerMappings as $layerMapping){
                       if(!isset($layers[$layerMapping->layer_name])){
                           $layers[$layerMapping->layer_name] = '';
                       }
                       if($fieldDetails['layer_id'] == $layerMapping->cc_layer_id){
                           ob_start();
                           $this->generateFieldWidgets($fieldDetails,$formModel);
                           $layers[$layerMapping->layer_name] .= ob_get_contents();
                           ob_end_clean();
                       }
                       
                   }     
                   
            }
            
            return $layers;
        }
       
        
        private function generateFieldWidgets($fieldDetails,$formModel){
            
            switch($fieldDetails['kind']){
                       case 'select_many':
                           $options = array();
                           foreach($fieldDetails['config']['options'] as $option){
                             $options[$option['id']] = $option['label'];
                           }
                           
                           echo "<div class='row'>".
                           TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']).
                           TbHtml::activeCheckBoxList($formModel, '_'.$fieldDetails['id'], $options).
                           TbHtml::error($formModel, '_'.$fieldDetails['id']).
                           "</div>";
                           break;
                           
                       case 'select_one':
                           $options = array();
                           foreach($fieldDetails['config']['options'] as $option){
                             $options[$option['id']] = $option['label'];
                           }
                            echo "<div class='row'>".
                           TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']).
                           TbHtml::activeDropDownList($formModel, '_'.$fieldDetails['id'], $options,array('prompt'=>'--Please select--')).
                           TbHtml::error($formModel, '_'.$fieldDetails['id']).
                           "</div>";
                           break;
                       
                       case 'hierarchy':
                           $filteredData = Layer::search($fieldDetails['config']['hierarchy'], 'id', Yii::app()->user->getState('node_id'));
                           if(!$filteredData){
                             $data = Layer::parseHierarchy($fieldDetails['config']['hierarchy']);
                           }
                           else{
                             $data = Layer::parseHierarchy($filteredData);
                           }
                           echo "<div class='row'>";
                           
                           echo TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']);
                           $this->widget('CTreeView',array(
                            'id'=>'_'.$fieldDetails['id'],
                            'data'=>$data,
                            'control'=>'#treecontrol',
                            'animated'=>'fast',
                            'collapsed'=>true,
                            'htmlOptions'=>array(
                            'class'=>'treeview-gray',

                                    )
                              ) );
                           echo "</div>";
                           break;
                       case 'email':
                           echo "<div class='row'>".
                           TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']).
                           TbHtml::activeEmailField($formModel, '_'.$fieldDetails['id']).
                           TbHtml::error($formModel, '_'.$fieldDetails['id']).
                          "</div>";
                           break;
                       case 'date':
                           
                           echo "<div class='row'>";
                           echo TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']);
                                 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$formModel,
                                    'attribute'=>'_'.$fieldDetails['id'],
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'showOn'=>'both',//focus,button,both
                                        'buttonText'=>'Please select date',
                                        'buttonImage'=>Yii::app()->request->baseUrl."/images/calendar.png",
                                        'buttonImageOnly'=>true,
                                        'dateFormat'=>'dd/mm/yy',
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'height:25px;',
                                    ),
                                ));  
                           echo TbHtml::error($formModel, '_'.$fieldDetails['id']);
                           echo "</div>";
                           break;
                       case 'numeric':
                           echo "<div class='row'>".
                           TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']).
                           TbHtml::activeNumberField($formModel, '_'.$fieldDetails['id'],array('min'=>0)).
                           TbHtml::error($formModel, '_'.$fieldDetails['id']).
                           "</div>";
                           break;
                       
                       default:
                           echo "<div class='row'>".
                           TbHtml::activeLabel($formModel, '_'.$fieldDetails['id']).
                           TbHtml::activeTextField($formModel, '_'.$fieldDetails['id']).
                           TbHtml::error($formModel, '_'.$fieldDetails['id']).
                          "</div>";
                         
                   } 
        }
        
        
        public function actionApprove($id){
            $changeRequest = ChangeRequest::model()->findByPk($id);
            if($changeRequest){
                  $version = $changeRequest->version_id;
                  $requestType = $changeRequest->request_type;
                  $siteID = $changeRequest->cc_site_id;
                  $url = Yii::app()->params['api-domain']."/collections/".
                         Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                         "/sites/{$siteID}/histories?version=$version";
                  $response = RestUtility::execCurl($url);
                  $responseArray = CJSON::decode($response, true);
                   if($requestType == ChangeRequest::TYPE_CREATE){
                       
                       $data = array(
                           'name'=>$responseArray['name'],
                           'properties'=>$responseArray['properties']
                       );
                       
                       $json = CJSON::encode($data);
                       $params = array('site'=>$json);
                       $url = Yii::app()->params['api-domain']."/collections/".
                              Yii::app()->params['resourceMapConfig']['public_collection_id'].
                               "/sites.json";
                       $response = RestUtility::execCurlPost($url, $params);
                       $site = CJSON::decode($response,true);
                       if(isset($site['id'])){
                           $changeRequest->pc_site_id = $site['id'];
                           $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                           $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                           $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                           $changeRequest->save();
                           $note = new ChangeRequestNote();
                           $note->change_request_id = $changeRequest->id;
                           $note->user_id = Yii::app()->user->getState('user_id');
                           $note->note = ' ';
                           $note->save();
                       }
                   }
                   elseif($requestType == ChangeRequest::TYPE_UPDATE){
                       //get changed fields from change_request_fields table
                       $changedFields = ChangeRequestFields::model()->findAllByAttributes(
                              array( 
                                  'change_request_id'=>$changeRequest->id,
                               )
                             );
                       //filter out non-updated fields
                       $properties = array();
                       foreach($responseArray['properties'] as $key=>$property){
                           foreach($changedFields as $field){
                               if($key == $field->field_id){
                                   $properties[$key]= $property;
                               }
                           }
                       }
                       
                       $data = array(
                           'properties'=>$properties,
                       );
                       
                       //encode the data into json format
                       $json = CJSON::encode($data);
                       $params = array('site'=>$json);
                       
                       //update site in the public collection
                       $url = Yii::app()->params['api-domain']."/collections/".
                              Yii::app()->params['resourceMapConfig']['public_collection_id'].
                              "/sites/{$changeRequest->pc_site_id}/partial_update";
                      
                       $response = RestUtility::execCurlPost($url, $params);
                       
                       //change status to approved and log info
                           $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                           $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                           $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                           $changeRequest->save();
                           $note = new ChangeRequestNote();
                           $note->change_request_id = $changeRequest->id;
                           $note->user_id = Yii::app()->user->getState('user_id');
                           $note->note = ' ';
                           $note->save();
                   }
                   elseif($requestType == ChangeRequest::TYPE_DELETE){
                          
                       //delete from public collection
                           $url = Yii::app()->params['api-domain']."/collections/".
                              Yii::app()->params['resourceMapConfig']['public_collection_id'].
                               "/sites/{$changeRequest->pc_site_id}";
                           RestUtility::execCurlDelete($url);
                       
                       //delete from curation collection
                           $url = Yii::app()->params['api-domain']."/collections/".
                                   Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                                    "/sites/{$changeRequest->cc_site_id}";
                           RestUtility::execCurlDelete($url);
                           
                           $changeRequest->status = ChangeRequest::STATUS_APPROVED;
                           $changeRequest->reviewed_by = Yii::app()->user->getState('user_id');
                           $changeRequest->reviewed_date = date('Y-m-d H:i:s');
                           $changeRequest->save();
                           $note = new ChangeRequestNote();
                           $note->change_request_id = $changeRequest->id;
                           $note->user_id = Yii::app()->user->getState('user_id');
                           $note->note = ' ';
                           $note->save();
                   }

                  
            }
        }
  
       
        
          //This was used to populate fields mapping table cache of field structures
        public function batchCache(){
            $fieldMappings = FieldMapping::model()->findAll();
             foreach($fieldMappings as $fieldMapping){
               $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['public_collection_id'].
                   "/fields/{$fieldMapping->pc_field_id}.json";
                   
                   $response = RestUtility::execCurl($url);
                   $fieldMapping->pc_field_structure = $response;
                   $fieldMapping->save();
                   
               }
        }
        
        
       
        
        
	
}
