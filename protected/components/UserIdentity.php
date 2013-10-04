<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const VALID_CREDENTIALS_HTTP_CODE = 200;
    
    
    
    public function authenticate() {
        
        $result = $this->resourceMapAuthenticate();
      
        if($result['status']==self::VALID_CREDENTIALS_HTTP_CODE){
            
                $this->errorCode = self::ERROR_NONE;
                $url= Yii::app()->params['api-domain']."/collections/777/fields/2512.json"; 
                $response =  $this->exec_curl($url);
                $result = json_decode($response,true);
                Yii::app()->user->setState('hierarchy',$result);
        }
        else{
                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
        
        
        return !$this->errorCode;

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
    
    private function resourceMapAuthenticate(){
        
            $login_data = $this->username .":". $this->password; 
            $login_url = Yii::app()->params['api-domain']."/users/validate_credentials?user=$this->username&password=$this->password";
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $login_url);             
            curl_setopt($ch, CURLOPT_USERPWD, $login_data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

            $result = array();
            $result['content'] = curl_exec($ch);
            $result['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
           
            curl_close($ch);
            
            return $result;
    }

}
