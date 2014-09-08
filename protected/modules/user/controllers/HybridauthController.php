<?php
/*
*Important One for developers. Do change in code here Only
*will get data for FB here itself from \extensions\widgets\hybridAuth
*Will Save FB profileImage, Email, Name to Users record in Posly
*Will be Useing Widgets/HybridAuth (Yii::app()->hybridAuth) No need to CHANGE any code there..
*Last Modified - 08-Sept-14
*/
class HybridauthController extends Controller{
 
    public $defaultAction='authenticate';
    public $debugMode=true;
	public $authSocialIdentifier='';
    
	// important! all providers will access this action, is the route of 'base_url' in config
    public function actionEndpoint(){
        Yii::app()->hybridAuth->endPoint();
    }
	
	/* * Sole Function to Authenticate with FB and Register the User
	 * To Posly at SignIn & SignUp Process
	*/
    public function actionAuthenticate($provider='Facebook')
	{
        if(!Yii::app()->user->isGuest || !Yii::app()->hybridAuth->isAllowedProvider($provider))
            $this->redirect(Yii::app()->homeUrl);
 
        if($this->debugMode)
            Yii::app()->hybridAuth->showError=true;
 
        if(Yii::app()->hybridAuth->isAdapterUserConnected($provider))
		{
            $socialUser = Yii::app()->hybridAuth->getAdapterUserProfile($provider);
			$this->authSocialIdentifier = $socialUser->identifier;
            if(isset($socialUser))
			{
                // find user from db model with social user info, Both at timeof SignIn & SignUp process
                $user = Users::model()->findBySocial($provider,$this->authSocialIdentifier,$socialUser->email);				
                if(empty($user))
				{	
					// New, SignUp
                	$user_socialmedia=new UsersSocialmedia;
                	$user_socialmedia->user_socialmedia_provider=$provider;
                	$user_socialmedia->user_socialmedia_identifier=$this->authSocialIdentifier;
                	if($user_socialmedia->save())
                	{
                		$users=new Users;
                		$users->user_socialmedia_id=$user_socialmedia->user_socialmedia_id;                		
						$user_details=new UsersDetails;
						$user_details->user_details_firstname=$socialUser->firstName;
						$user_details->user_details_lastname=$socialUser->lastName;
						$user_details->user_details_email=$socialUser->email;
						$user_details->user_details_avatar=$socialUser->photoURL;
						$time=new CTimestamp;
						$value=$time->getDate();
						$user_details->user_details_created_date=$value[0];
						if($socialUser->gender=='male')
							$user_details->user_details_gender=1;
                    	else
							$user_details->user_details_gender=2;
                    	$bday = strtotime($socialUser->birthYear.'-'.$socialUser->birthMonth.'-'.$socialUser->birthDay);
						$user_details->user_details_dob = date( "Y-m-d", $bday);						
						$user_locations=new UsersLocation;
						$user_locations->user_location_city=$socialUser->city;
						$user_locations->user_location_country=$socialUser->country;
						$user_locations->save();
						$users->user_location_id=$user_locations->user_location_id;						
						$users->save();
						$user_details->user_id=$users->user_id;						
						if($user_details->save())
						{
							$updateusers=Users::model()->findByPk($users->user_id);
							$updateusers->user_details_id=$user_details->user_details_id;
							$updateusers->save();
						}						
					}                   	
                     $user=$users; 
                } else{
					//Already Registerd with Posly by means of a Social Media
					$this->authSocialIdentifier = $user->userSocialmedia->user_socialmedia_identifier;					
				}
                if($user)
				{
                	$identity = new UserIdentity($provider, $socialUser->identifier); 
					$identity->setsocialdata($provider,$this->authSocialIdentifier);
                    $identity->authenticate('social');
                    switch($identity->errorCode)
					{
						case UserIdentity::ERROR_NONE:
						Yii::app()->user->login($identity);
						$redirect_url = $identity->getusereturnurl($socialUser->email);
						$path=$this->createAbsoluteUrl($redirect_url); //'/registration/settings'
						$this->redirect($path);
						break;
                    }
                }
            }
        }		
        $this->redirect(Yii::app()->homeUrl);
    }
    
   public function actionLogout()
   { 
        if(Yii::app()->hybridAuth->getConnectedProviders()){
            Yii::app()->hybridAuth->logoutAllProviders();
        } 
        Yii::app()->user->logout();    
    } 
}

?>