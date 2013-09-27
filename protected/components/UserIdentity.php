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
        }
        else{
                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
        
        
        return !$this->errorCode;

    }
    
    
    
    private function resourceMapAuthenticate(){
         
            $login_data = $this->username .":". $this->password; 
            $login_url = "http://resmap-stg.instedd.org/users/validate_credentials?user=$this->username&password=$this->password";
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
