<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpenIDUserIdentity
 *
 * @author robert
 */
class OpenIDUserIdentity extends CUserIdentity{
    
    private $_id;
    public function authenticate() {
        
        $user = User::model()->find('email=:email',
                array(':email'=>$this->username)
                );
      
        if($user == null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif(strlen($user->openid_identity)== 0){
                
               $this->errorCode = self::ERROR_PASSWORD_INVALID;  
        }
        else{
               
                Yii::app()->user->setState('node_id',$user->node_id);
                Yii::app()->user->setState('user_id',$user->id);
                $this->_id = $user->id;
                Yii::app()->user->setState('active',$user->active);
                $this->errorCode = self::ERROR_NONE;
        }
          
        return !$this->errorCode;

    }
    
    public function getId() {
        return $this->_id;
    }
}

?>
