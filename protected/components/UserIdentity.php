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
      
        if($result['status'] == self::VALID_CREDENTIALS_HTTP_CODE){
            
                $this->errorCode = self::ERROR_NONE;
                $url= Yii::app()->params['api-domain']."/collections/777/fields/2512.json";
                $response = RestUtility::execCurl($url);
                $result = json_decode($response,true);
                $user = User::model()->find('email=:email',array(':email'=>$this->username));
                Yii::app()->user->setState('hierarchy',$result);
                Yii::app()->user->setState('node_id',$user->node_id);
                Yii::app()->user->setState('layers',  Layer::loadLayers());
        }
        else{
                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
        
        
        return !$this->errorCode;

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
