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
                    'actions'=>array('CreateSite','Facilities','pendingRequests','SearchFacilityByPSCode','viewFacility'),
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
                        array('model'=>$this->loadFacility($id)));
	}
        
        public function loadFacility($id){
            $url = Yii::app()->params['api-domain']."/collections/777/sites/$id.json"; 
            $response = RestUtility::execCurl($url);
            $result = json_decode($response,true);
            
            return $result;
        }
       
        
        public function actionFacilities($node_id = null){
            
            $url = Yii::app()->params['api-domain']."/api/collections/777.json?page=all&Admin_div[under]=".Yii::app()->user->getState('node_id');          
            if(isset($node_id))
                $url = Yii::app()->params['api-domain']."/api/collections/777.json?page=all&Admin_div[under]={$node_id}";
            $response = RestUtility::execCurl($url);
            $result = json_decode($response,true);
            
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
            
            $result = Yii::app()->user->getState('hierarchy');
            $rootNode = Yii::app()->user->getState('node_id');
            $filteredData = Layer::search($result['config']['hierarchy'],'id',$rootNode);
            $data = $this->parseHierarchy($filteredData);
            $this->render('exploreFacilities',array('data'=>$data,'sites'=>$sites));
        }
        
        public function actionSearchFacilityByPSCode($search_query){
            if(isset($search_query)){
                $url = Yii::app()->params['api-domain']."/api/collections/777.json?page=all&Fac_ID={$search_query}";
                $response = RestUtility::execCurl($url);
                $result = json_decode($response,true);
                
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
                    foreach ($hierarchy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = $this->parseHierarchy($node['sub']);
                                $treeNodeArray = array('text'=>'<span style="color:#3AA1BF;">'.CHtml::link(TbHtml::icon(TbHtml:: ICON_FOLDER_CLOSE).$node['name'],$this->createUrl('facilities',array('node_id'=>$node['id']))).'</span>','children'=>$subNodes);
                            } else {
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
                
                $this->render('pending_requests');
        }
        
        
        public function actionCreateSite(){
            
            $model = new SiteForm;
            
            if(isset($_POST['SiteForm'])){
               //to be changed
               $url = Yii::app()->params['api-domain']."/collections/777/sites.json";
             
               //capture form values
               $model->name = $_POST['SiteForm']['commonFacilityName'];
               $model->properties = $_POST['SiteForm']['properties'];
               
               //prepare data in array
               $data = array(
                    'name'=>$model->name,
                    'properties'=>$model->properties,
                );
            
            //convert data into json format 
            $json = CJSON::encode($data);
            
            $params = array('site'=>$json);
            $response = RestUtility::execCurlPost($url, $params);  
            
            $site = CJSON::decode($response);
                if(isset($site['id'])){
                    Yii::app()->user->setFlash('success','Site created successfully');
                    $this->render('facility',array('model'=>$site));
                    Yii::app()->end();
                }
                else{  
                    Yii::app()->user->setFlash('failure','Site creation failed');
                }
            
            }
            
            
            $this->render('site_create',array('model'=>$model));
        }
       

	
}
