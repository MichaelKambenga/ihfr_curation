<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    
    
    public function authenticate() {
        
        $exists = $this->resourceMapAuthenticate();
        $exists = CJSON::decode($exists);
        
        if(array_key_exists('error', $exists)){
            
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
        else{
            
            $this->errorCode = self::ERROR_NONE;
        }
        
        return !$this->errorCode;
    }
    
    private function resourceMapAuthenticate(){
         
            $login_data = $this->username .":". $this->password; 
            //To be changed to another login end-point at resourceMap
            $login_url = "http://resourcemap.instedd.org/collections.json";
            
            $ch = curl_init(); 
            curl_setopt ($ch, CURLOPT_URL, $login_url);             
            curl_setopt($ch, CURLOPT_USERPWD, $login_data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

            $result = curl_exec($ch);
            curl_close($ch);
            
            return $result;
    }

}