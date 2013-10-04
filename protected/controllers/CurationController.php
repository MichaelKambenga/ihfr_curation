<?php

class CurationController extends Controller
{
    
        public function accessRules() {
            
            return array(
                'allow',
                
                );
        }
    
	public function actionViewFacility($id)
	{
		$this->render('facility', 
                        array('model'=>$this->loadFacility($id)));
	}
        
        public function loadFacility($id){
            $url= Yii::app()->params['api-domain']."/collections/777/sites/$id.json"; 
            $response =  $this->exec_curl($url);
            $result = json_decode($response,true);
            
            return $result;
        }
        
        public function actionFacilities(){
           
            $url= Yii::app()->params['api-domain']."/collections/777/sites.json"; 
            $response =  $this->exec_curl($url);
            $result = json_decode($response,true);
            $sites = new CArrayDataProvider($result);
            
            $result = Yii::app()->user->getState('hierarchy');
            $filteredData =$this->search($result['config']['hierarchy'],'id','TZ.ET');
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
        
        function exec_curl($url){
            $username="mkambenga@gmail.com"; 
            $password="Michael"; 
            $postdata = $username .":". $password; 
            
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $url);             
            curl_setopt($ch, CURLOPT_USERPWD, $postdata);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

            if(!$result = curl_exec ($ch)){
                echo "An error has occured".curl_error($ch);
                echo curl_getinfo($ch);
                curl_close($ch);
            }
            else{
               curl_close($ch);
               return $result; 
            }
            
        }

	
}
