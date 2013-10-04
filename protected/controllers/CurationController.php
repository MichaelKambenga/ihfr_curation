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
                    'actions'=>array('Facilities','pendingRequests'),
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
       
        
        public function actionFacilities(){
           
            $url= Yii::app()->params['api-domain']."/collections/777/sites.json"; 
            $response = RestUtility::execCurl($url);
            $result = json_decode($response,true);
            
            $sites = new CArrayDataProvider($result);
            
            $result = Yii::app()->user->getState('hierarchy');
            $rootNode = Yii::app()->user->getState('node_id');
            $filteredData =$this->search($result['config']['hierarchy'],'id',$rootNode);
            $data =$this->parseHierarchy($filteredData);
            $this->render('exploreFacilities',array('data'=>$data,'sites'=>$sites));
        }
     
        public function search($array, $key, $value)
        {
            $results = array();

            if (is_array($array))
            {
                if (isset($array[$key]) && $array[$key] == $value)
                    $results[] = $array;

                foreach ($array as $subarray){
                       $results = array_merge($results, $this->search($subarray, $key, $value));
                 }
            }

            return $results;
        }
        
        
        public function parseHierarchy($hierarchy){
             $treeArray = array();
                if(is_array($hierarchy)){
                    foreach ($hierarchy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = $this->parseHierarchy($node['sub']);
                                $treeNodeArray = array('text'=>'<span style="color:#3AA1BF;">'.$node['name'].'</span>','children'=>$subNodes);
                            } else {
                                $treeNodeArray = array('text'=>'<span style="color:#3AA1BF;">'.$node['name'].'</span>');
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
       

	
}
