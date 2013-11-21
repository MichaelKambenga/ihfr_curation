<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestUtility
 *
 * @author robert
 */
class RestUtility {
    //put your code here
    
    public static function execCurl($url){
        
            $username = Yii::app()->params['resourceMapConfig']['api-username'];
            $password = Yii::app()->params['resourceMapConfig']['api-password'];
            $postdata = $username .":". $password; 
            
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $url);             
            curl_setopt($ch, CURLOPT_USERPWD, $postdata);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

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
        
        
        public static function execCurlPost($url,$params){
            
            $username = Yii::app()->params['resourceMapConfig']['api-username'];
            $password = Yii::app()->params['resourceMapConfig']['api-password'];
            $login_data = $username .":". $password;  
            
            
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $url);             
            curl_setopt($ch, CURLOPT_USERPWD, $login_data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
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
        
         public static function execCurlDelete($url){
        
            $username = Yii::app()->params['resourceMapConfig']['api-username'];
            $password = Yii::app()->params['resourceMapConfig']['api-password'];
            $postdata = $username .":". $password; 
            
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $url);             
            curl_setopt($ch, CURLOPT_USERPWD, $postdata);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
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

?>
