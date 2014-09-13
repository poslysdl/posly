<?php
/*
*Important One for developers. Do change in code here Only
*will get data for FB here itself from \extensions\widgets\hybridAuth\CHybridAuth.php
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
        if(!Yii::app()->hybridAuth->isAllowedProvider($provider))
            $this->redirect(Yii::app()->homeUrl); // isAllowedProvider() in CHybridAuth.php
		$flagemail = '';
		if(isset($_REQUEST['flagemail'])){
			$flagemail = $_REQUEST['flagemail'];
		} else{
			if(!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->homeUrl);
		}
        if($this->debugMode)
            Yii::app()->hybridAuth->showError=true;
 
        if(Yii::app()->hybridAuth->isAdapterUserConnected($provider))
		{
            $socialUser = Yii::app()->hybridAuth->getAdapterUserProfile($provider);						
            if(isset($socialUser))
			{	
				$this->authSocialIdentifier = $socialUser->identifier;
				//Check if Prior to FB SignUp, user is already registered with same FB emailId
				$user = Users::model()->findByFBmailId($socialUser->email);
				if($user)
				$flagemail='y';				
				unset($user);
				if($flagemail=='y')
					$this->actionAlreadyemail($provider,$socialUser); //Dual signUp with FB & EmailId
                // find user from db model with social user info, Both at timeof SignIn & SignUp process
                $user = Users::model()->findBySocial($provider,$this->authSocialIdentifier,$socialUser->email);	
echo "<pre>"; print_r($user); exit("dd");				
                if(empty($user))
				{	
					//..New, SignUp
					$FBusername = NULL; //$socialUser->profileURL;
					if(!empty($FBusername)){
						//$FBusername = explode("/",$FBusername);  
						//[profileURL] => https://www.facebook.com/app_scoped_user_id/616175085169516/  ...creates ambiguity with diffrent APPs
						//$FBusername = $FBusername[3];
					}
                	$user_socialmedia=new UsersSocialmedia;
                	$user_socialmedia->user_socialmedia_provider=$provider;
                	$user_socialmedia->user_socialmedia_identifier=$this->authSocialIdentifier;
                	if($user_socialmedia->save())
                	{
                		$users=new Users;
                		$users->user_socialmedia_id=$user_socialmedia->user_socialmedia_id;                		
						$user_details=new UsersDetails;
						$user_details->user_details_firstname=$socialUser->firstName.' '.$socialUser->lastName;
						$user_details->user_details_lastname=NULL;
						$user_details->user_details_email=$socialUser->email;
						$user_details->user_details_avatar=$socialUser->photoURL;
						$user_details->user_unique_url=$FBusername;
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
					//..Already Registerd with Posly by means of a Social Media
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

	/**
	* This function is a Dual signUp with FB & EmailId, comes from Step-#1 - Social Sharing
	* User first SignUp with Email, then if also want to connect with their FB Account
	* Update users details, Users with FB data and only Insert in social media table
	* Last Modified: 09-Sept-14
	*/	
    public function actionAlreadyemail($provider,$socialUser)
	{		echo "dfsdfsd";
		$userid = Yii::app()->user->id;
		$socialid = $socialUser->identifier;
		$FBusername = NULL; //$socialUser->profileURL;
		//if(!empty($FBusername)){
			//$FBusername = explode("/",$FBusername);
			//$FBusername = $FBusername[3];
		//}
		$FBgender = ($socialUser->gender=="male")?'1':'0';
		$FBDob = Null;
		if(isset($socialUser->birthYear) && isset($socialUser->birthMonth) && isset($socialUser->birthDay))
			$FBDob = $socialUser->birthYear.'-'.$socialUser->birthMonth.'-'.$socialUser->birthDay;
		if(Users::model()->findByEmailId($socialUser->email))
		{
			//FB emailId and Posly SignUp with emailId is same
			$criteria = new CDbCriteria();		
			$criteria->condition = "user_socialmedia_provider='Facebook' AND user_socialmedia_identifier=$socialid";		
			$usersocials=UsersSocialmedia::model()->findAll($criteria);
			if(!isset($usersocials) || count($usersocials)==0)
			{	//Insert Social Identifier into social media records
				$user_socialmedia=new UsersSocialmedia;
				$user_socialmedia->user_socialmedia_provider=$provider;
				$user_socialmedia->user_socialmedia_identifier=$this->authSocialIdentifier;
				if($user_socialmedia->save())
				{ 				
					//Update User Table data..					
					$condition = 'user_id = :userid';
					$params = array(':userid'=>$userid);
					$attributes = array('user_socialmedia_id'=>$user_socialmedia->user_socialmedia_id);
					$row = Users::model()->updateByPk($userid,$attributes,$condition,$params);
					//Update users details
					$condition = 'user_id = :userid';
					$params = array(':userid'=>$userid);
					$attributes = array('user_unique_url'=>$FBusername,'user_details_gender'=>$FBgender,
					'user_details_avatar'=>$socialUser->photoURL,'user_details_dob'=>$FBDob);
					$row = UsersDetails::model()->updateAll($attributes,$condition,$params);
				}
			}
		}
		unset($socialUser);		
		$this->redirect(Yii::app()->createUrl('/registration/settings'));
		Yii::app()->end();	
	}	
}

?>