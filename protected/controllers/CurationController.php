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
            $url = Yii::app()->params['api-domain']."/collections/".
                   Yii::app()->params['resourceMapConfig']['public_collection_id'].
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
               
                
                //print_r(ChangeRequest::getFieldValues(99247));exit;
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
            $model->primary_site_code = $site['properties'][FieldMapping::CC_PRIMARY_SITE_CODE];
            $model->version_id = $site['version'];
            $model->requested_by = Yii::app()->user->getState('user_id');
            $model->request_type = ChangeRequest::TYPE_CREATE;
            $model->status = ChangeRequest::STATUS_PENDING;
            $model->requested_date = date('Y-m-d H:i:s');
            
            $model->save();
            $this->logChangeRequestNote($model);
            $this->logChangeRequestFields($model->id, $site['properties']);
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
            
            
            $model = new SiteForm();
            
            if(isset($_POST['SiteForm'])){
               
               $url = Yii::app()->params['api-domain']."/collections/".
                      Yii::app()->params['resourceMapConfig']['curation_collection_id'].
                      "/sites.json";
             
               //capture form values
               $model->attributes = $_POST['SiteForm'];
               $data = array(
                    'name'=>$model->commonFacilityName,
                    'properties'=>$this->curationCollectionSitePropertiesMapping($model),
                );
            //convert data into json format 
            $json = CJSON::encode($data);

            $params = array('site'=>$json);
            $response = RestUtility::execCurlPost($url, $params);
            $site = CJSON::decode($response);
            $site['note'] = $model->note;
            
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
            
          
            $this->render('site_create',array('model'=>$model));
        }

    public function curationCollectionSitePropertiesMapping($model) {
        
        return array(
            '1810' =>$model->administrativeDivision,
            '1839' =>$model->ownershipDetailOrName,
            '1831' =>$model->locationDescription,
            '1819' =>$model->postalAddress,
            '1843' =>$model->receptionRoom,
            '1872' =>$model->generalClinicalServices,
            '1814' =>'',
            '1832' =>$model->wayPointNumber,
            '1811' =>$model->facilityType,
            '1812' =>$model->ownership,
            '1840' =>$model->registrationStatus,
            '1820' =>$model->postalCode,
            '1844' =>$model->consultationRoom,
            '1873' =>$model->malariaDiagnosisAndTreatment,
            '1816' =>$model->registrationId,
            '1817' =>$model->ctcId,
            '1833' =>$model->altitude,
            '1822' =>$model->officialPhoneNumber,
            '1845' =>$model->dressingRoom,
            '1874' =>$model->TBDiagnosisCareAndTreatment,
            '1841' =>$model->licensingStatus,
            '1842' =>$model->otherClinic,
            '1889' =>$model->oldHFRId,
            '1818' =>$model->mtuhaCode,
            '1813' =>$model->operatingStatus,
            '1834' =>$model->serviceAreas,
            '1823' =>$model->officialFax,
            '1875' =>$model->cardiovasculasCareAndTreatment,
            '1835' =>$model->serviceAreaPopulation,
            '1824' =>$model->officialEmail,
            '1847' =>$model->wardRoom,
            '1876' =>$model->HIVAIDSPrevention,
            '1848' =>$model->observationRoom,
            '1836' =>$model->catchmentArea,
            '1877' =>$model->HIVAIDSCareAndTreatment,
            '1837' =>$model->catchmentPopulation,
            '1826' =>$model->inChargeName,
            '1849' =>$model->remarks,
            '1878' =>$model->therapeutics,
            '1838' =>$model->dateOpened,
            '1827' =>$model->inChargeCadre,
            '1850' =>$model->patientBeds,
            '1879' =>$model->prostheticsAndMedicalDevices,
            '1828' =>$model->inChargeEmail,
            '1851' =>$model->deliveryBeds,
            '1880' =>$model->healthPromotionAndDiseasePrevention,
            '1852' =>$model->babyCots,
            '1881' =>$model->diagnosticServices,
            '1829' =>$model->inChargeNID,
            '1830' =>$model->inChargeMobilePhone,
            '1853' =>$model->ambulances,
            '1882' =>$model->reproductiveAndChildHealthCareServices,
            '1854' =>$model->cars,
            '1883' =>$model->growthMonitoringOrNutritionalSurveillance,
            '1855' =>$model->motorcycles,
            '1884' =>$model->oralHealthService,
            '1856' =>$model->otherTransport,
            '1885' =>$model->ENTServices,
            '1857' =>$model->noOfOtherTransport,
            '1886' =>$model->supportServices,
            '1858' =>$model->sterilizationAndInfectionControl,
            '1887' =>$model->emergencyPreparedness,
            '1859' =>$model->meansOfTransportToReferralPoint,
            '1888' =>$model->otherServices,
            '1860' =>$model->distanceToReferralPoint,
            '1861' =>$model->challengesToReachReferralPoint,
            '1862' =>$model->sourceOfEnergy,
            '1863' =>$model->otherEnergySource,
            '1864' =>$model->mobileNetworks,
            '1865' =>$model->otherMobileNetwork,
            '1866' =>$model->sourceOfWater,
            '1867' =>$model->otherSourceOfWater,
            '1868' =>$model->toiletFacility,
            '1869' =>$model->toiletRemarks,
            '1870' =>$model->wasteManagement,
            '1871' =>$model->otherWasteManagement,
        );
    }
    
    public function publicCollectionSitePropertiesMapping($model) {
        
        return array(
            '1810' =>$model->administrativeDivision,
            '1839' =>$model->ownershipDetailOrName,
            '1831' =>$model->locationDescription,
            '1819' =>$model->postalAddress,
            '1843' =>$model->receptionRoom,
            '1872' =>$model->generalClinicalServices,
            '1814' =>'',
            '1832' =>$model->wayPointNumber,
            '1811' =>$model->facilityType,
            '1812' =>$model->ownership,
            '1840' =>$model->registrationStatus,
            '1820' =>$model->postalCode,
            '1844' =>$model->consultationRoom,
            '1873' =>$model->malariaDiagnosisAndTreatment,
            '1816' =>$model->registrationId,
            '1817' =>$model->ctcId,
            '1833' =>$model->altitude,
            '1822' =>$model->officialPhoneNumber,
            '1845' =>$model->dressingRoom,
            '1874' =>$model->TBDiagnosisCareAndTreatment,
            '1841' =>$model->licensingStatus,
            '1842' =>$model->otherClinic,
            '1889' =>$model->oldHFRId,
            '1818' =>$model->mtuhaCode,
            '1813' =>$model->operatingStatus,
            '1834' =>$model->serviceAreas,
            '1823' =>$model->officialFax,
            '1875' =>$model->cardiovasculasCareAndTreatment,
            '1835' =>$model->serviceAreaPopulation,
            '1824' =>$model->officialEmail,
            '1847' =>$model->wardRoom,
            '1876' =>$model->HIVAIDSPrevention,
            '1848' =>$model->observationRoom,
            '1836' =>$model->catchmentArea,
            '1877' =>$model->HIVAIDSCareAndTreatment,
            '1837' =>$model->catchmentPopulation,
            '1826' =>$model->inChargeName,
            '1849' =>$model->remarks,
            '1878' =>$model->therapeutics,
            '1838' =>$model->dateOpened,
            '1827' =>$model->inChargeCadre,
            '1850' =>$model->patientBeds,
            '1879' =>$model->prostheticsAndMedicalDevices,
            '1828' =>$model->inChargeEmail,
            '1851' =>$model->deliveryBeds,
            '1880' =>$model->healthPromotionAndDiseasePrevention,
            '1852' =>$model->babyCots,
            '1881' =>$model->diagnosticServices,
            '1829' =>$model->inChargeNID,
            '1830' =>$model->inChargeMobilePhone,
            '1853' =>$model->ambulances,
            '1882' =>$model->reproductiveAndChildHealthCareServices,
            '1854' =>$model->cars,
            '1883' =>$model->growthMonitoringOrNutritionalSurveillance,
            '1855' =>$model->motorcycles,
            '1884' =>$model->oralHealthService,
            '1856' =>$model->otherTransport,
            '1885' =>$model->ENTServices,
            '1857' =>$model->noOfOtherTransport,
            '1886' =>$model->supportServices,
            '1858' =>$model->sterilizationAndInfectionControl,
            '1887' =>$model->emergencyPreparedness,
            '1859' =>$model->meansOfTransportToReferralPoint,
            '1888' =>$model->otherServices,
            '1860' =>$model->distanceToReferralPoint,
            '1861' =>$model->challengesToReachReferralPoint,
            '1862' =>$model->sourceOfEnergy,
            '1863' =>$model->otherEnergySource,
            '1864' =>$model->mobileNetworks,
            '1865' =>$model->otherMobileNetwork,
            '1866' =>$model->sourceOfWater,
            '1867' =>$model->otherSourceOfWater,
            '1868' =>$model->toiletFacility,
            '1869' =>$model->toiletRemarks,
            '1870' =>$model->wasteManagement,
            '1871' =>$model->otherWasteManagement,
        );
    }
       

	
}
