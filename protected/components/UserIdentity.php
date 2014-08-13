<?php

class UserIdentity extends CUserIdentity {
  private $_id;
 
      public function authenticate($type=null) {
 
        switch(strtolower($type)){
            case 'social': // for social user login - use in HybridauthController.php
                $user=Users::model()->findByAuthSocial($this->username, $this->password);
                break;
            case 'user':
            default: 
                // for normal registered user login - use in your user login controller
                $user=Users::model()->findByAuthUser($this->username, $this->password);
                break;
        }//end switch
 
        if (empty($user)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }else {
            $this->_id = $user->user_id;
            if(isset($user->userDetails->user_details_firstname) || isset($user->userDetails->user_details_lastname))
            $this->setState('name', $user->userDetails->user_details_firstname." ".$user->userDetails->user_details_lastname);
            else
            $this->setState('name', $user->userDetails->user_details_email);
            //$this->setState('language', $user->preferredLanguage);
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }
 
  public function getId() {
        return $this->_id;
  }
}