<?php

class CurationController extends Controller
{

	/**
	 *
	 * 
	 */
    
	public function actionViewFacility()
	{
		
		$this->render('facility');
	}
        
        public function actionFacilities(){
            
            $url= Yii::app()->params['api-domain']."/collections/777/fields/2512.json"; 
            $response =  $this->exec_curl($url);
            $result = json_decode($response,true);
           
            $data =$this->parseHierachy($result['config']['hierarchy']);
                
            
    
            $this->render('exploreFacilities',array('data'=>$data));
        }
     
        
        
        public function parseHierachy($hierachy){
             $treeArray = array();
                if(is_array($hierachy)){
                    foreach ($hierachy as $node){
                       if(is_array($node)){
                        if(array_key_exists('name', $node)){
                            if(array_key_exists('sub', $node)){
                                $subNodes = $this->parseHierachy($node['sub']);
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
