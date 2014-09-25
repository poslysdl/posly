<?php
class ProfileController extends Controller {	
	public $user_additional_info;
	public $user_guest = "guest";
	public $user_self = "self";
	public $user_logged_vistor = "logged_vistor";
	public $user_friend = "friend";
	public $lang = 'en';
	public $user_request_send = "request_send";
	public $user_request_receive = "request_receive";
	public $user_follow = "follow";
	public $user_following  = "following";
	public $current_user_id;
	public $current_profile_id;
	public $profile_hearts_count;
	public $profile_friends_count;
	public $profile_follower_count;
	public $profile_following_count;
	public $profile_details;
	public $avatar;
	public $gender;
	public $user_magzine_hashtag;
	public $user_design_hashtag;
	public $user_shops_hashtag;
	public $user_styleIcons_hashtag;
	public $user_myStyle_hashtag;
	public $users_following;
	public $users_folllower;
	public $profile_follow_userdetails;
	public $profile_follower_userdetails;
	public $profile_follow_location;
	
   public function filters() {
      return array( 'accessControl' ); // perform access control for CRUD operations
	}
 
	public function accessRules() {
        return array(
            array('allow',
            	'actions'=>array('index', 'addhearts', 'following', 'followers', 'about', 'albums', 'hearts', 'ranks','catwalk','friends','userAge','profilesettings','addfriend','removefriend','followfriend','followingfriend'),
                'users'=>array('*'),
            ),
            array('deny'),
        );
    }
	
	public function actionIndex($url) {
		$user_additional_info['follow'] = $this->user_follow;
		$error = false;
		if(isset($url) && !empty($url)) {
			$profile_url = $url;
			Yii::app()->session['url'] = $profile_url;
			$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
			Yii::app()->session['user_id'] = $row['user_id'];
			if(isset($row)) {			
				//Guest profile	 
				if(Yii::app()->user->isGuest) {
					$user_additional_info['current_user'] = $this->user_guest;
				}
				else{
					//Logged in profile
					$id = Yii::app()->user->id;
					$this->current_user_id = $id;					
					$check_friend = UsersFriends::model()->check_friend($id,$row['user_id']);					
					$check_follow = UsersFollow::model()->check_follow($id,$row['user_id']);										
					if($check_follow){
						$user_additional_info['follow'] = $this->user_following;
					}
					//logged in user (own profile)
					if($id == $row['user_id']) {
						$user_additional_info['current_user'] = $this->user_self;
					}
					//loggedin user friend profile
					elseif($check_friend){
						$user_additional_info['current_user'] = $this->user_friend;
					}
					//logged in user (others profile)
					else {						
						$check_invitation = UsersFriends::model()->find_user_send_receive_request($id,$row['user_id'],$this->user_request_send,$this->user_request_receive );
						if($check_invitation){
							$user_additional_info['current_user'] = $check_invitation;
						}
						else{
							$user_additional_info['current_user'] = $this->user_logged_vistor;
						}
					}
				}
				$userAge = Users::model()->getUserAge($row['user_id']);
				$age = ($userAge) ? $userAge : "";
            $user_additional_info['age'] = $userAge;				
				$this->profile_hearts_count = Users::model()->get_profile_hearts_count($row['user_id']);
				$this->profile_friends_count = Users::model()->get_profile_friends_count($row['user_id']);
				$this->profile_follower_count = Users::model()->get_profile_follower_count($row['user_id']);					
				$this->profile_following_count = Users::model()->get_profile_following_count($row['user_id']);				
				$user_additional_info['profile_hearts_count'] = $this->profile_hearts_count;
				$user_additional_info['profile_friends_count'] = $this->profile_friends_count;
				$user_additional_info['profile_follower_count'] = $this->profile_follower_count;
				$user_additional_info['profile_following_count'] = $this->profile_following_count;
				$this->profile_details = Users::model()->getUserInfo($row['user_id']);
				$user_additional_info['users_details'] = $this->profile_details;					
				$this->current_profile_id = $row['user_id'];
				$this->layout='profile_layout';
				Yii::app()->clientScript->registerCoreScript('jquery');
				$this->avatar = $this->profile_details['user_details_avatar'];
				$fromurl = strstr($this->avatar, '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$user_additional_info['avatar'] = $this->avatar; 
				elseif(!empty($this->avatar))
					$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
				else	
					$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/noimage.jpg';
					
				$this->render('index',array('user'=>$row,'user_info'=>$user_additional_info));	
			}
			else /* if the user is not there with that profile id */ {
				$error = true;
			}		
		}
		else /* if the url is not set */{
			$error = true;
		}			
		if($error){
			$this->redirect(Yii::app()->homeUrl);
		}
	}		 
	
	public function actionAbout(){
		$profile_url = $_REQUEST['param'];
		$id = Yii::app()->user->id;
		$user_about_info = array();
		$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
		$this->profile_details = Users::model()->getUserInfo($row['user_id']);
		$user_additional_info['users_details'] = $this->profile_details;			
		if(Yii::app()->user->isGuest) {
			$user_additional_info['current_user'] = $this->user_guest;
		}		
		elseif($id == $row['user_id']){
			$user_additional_info['current_user'] = $this->user_self;
		}
		else{
			$user_additional_info['current_user'] = $this->user_logged_vistor;
		}
		$userAge = Users::model()->getUserAge($row['user_id']);
		$user_additional_info['age'] = $userAge;
		$this->avatar = $this->profile_details['user_details_avatar'];
		$fromurl = strstr($this->avatar, '://', true);
		if($fromurl=='http' || $fromurl=='https')
			$user_additional_info['avatar'] = $this->avatar; 
		elseif(!empty($this->avatar))
			$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
		else	
			$user_additional_info['avatar'] = Yii::app()->baseUrl.'/profiles/noimage.jpg';
			
		if($this->profile_details['user_details_gender'] == 1){
			$this->gender = "Male";			
		}
		else{
			$this->gender = "female";
		}
		//get magazine hash tag
		$this->user_magzine_hashtag = Users::model()->get_user_hashtag("6",$row['user_id']);
		$user_additional_info['user_magzine_hashtag'] = $this->user_magzine_hashtag;
		
		//get Design hash tag
		$this->user_design_hashtag = Users::model()->get_user_hashtag("7",$row['user_id']);
		$user_additional_info['user_design_hashtag'] = $this->user_design_hashtag;
		
		//get Shops hash tag
		$this->user_shops_hashtag = Users::model()->get_user_hashtag("8",$row['user_id']);
		$user_additional_info['user_shops_hashtag'] = $this->user_shops_hashtag;
		
		//get StyleIcons hash tag
		$this->user_styleIcons_hashtag = Users::model()->get_user_hashtag("9",$row['user_id']);
		$user_additional_info['user_styleIcons_hashtag'] = $this->user_styleIcons_hashtag;
		
		//get MyStyle hash tag
		$this->user_myStyle_hashtag = Users::model()->get_user_hashtag("10",$row['user_id']);
		$user_additional_info['user_myStyle_hashtag'] = $this->user_myStyle_hashtag;	

		
		$user_additional_info['gender'] = $this->gender; 
		$this->renderPartial('about', array('user_info' => $user_additional_info));
			
	}	  
	
	public function actionError() {
		$this->render('error');
	}
	
	public function actionAlbums() {
		$this->renderPartial('albums');
	}
	
	public function actionRanks() 
	{
	  /*$url = Yii::app()->session['url'];			 
		if (isset($url)) {
			$access_user_id = Yii::app()->session['user_id'];			 
			$criteria = new CDbCriteria();				 
			$criteria->condition = 't.user_id = '.$access_user_id;				 
			$hearts = Photos::model()->with('logPhotosCount')->findAll($criteria);
			$ranks = UsersDetails::model()->find("user_id=$access_user_id");				 
			$this->renderPartial('rankings',array('model'=>$hearts, 'ranks'=>$ranks)); 			 
		} else {
			//$this->redirect(Yii::app()->homeUrl);
			echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
		} */		
		$this->renderPartial('rankings');	
		  
	}
	
	 
	public function actionHearts(){		 
		/*$url = Yii::app()->session['url'];		 
		if (isset($url)) {			 
			$access_user_id = Yii::app()->session['user_id'];			 
			$criteria = new CDbCriteria();
			$criteria->offset = 0;
			$criteria->limit = 2;
			$criteria->condition = 't.user_id ='.$access_user_id;			 
			$hearts = LogPhotosHearts::model()->with('user.userDetails','photos', 'photos.logPhotosComments', 'photos.logPhotosCount')->findAll($criteria);	
			if(isset($hearts) && !empty($hearts)){
				$this->renderPartial('hearts',array('model'=>$hearts));
			}
			else {
				 echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->createUrl('profile/error')));
			}		 
		} else {
			echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
		}*/
		$this->renderPartial('hearts');		
	}
//done
	public function actionFollowing(){
		$folllow_users =array();
		$folllow_users_odd = array();
		$folllow_users_even = array();
		$profile_url = $_REQUEST['param'];
		$id = Yii::app()->user->id;
		$user_about_info = array();
		$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
		$this->profile_details = Users::model()->getUserInfo($row['user_id']);
		$user_additional_info['users_details'] = $this->profile_details;			
		if(Yii::app()->user->isGuest) {
			$user_additional_info['current_user'] = $this->user_guest;
		}		
		elseif($id == $row['user_id']){
			$user_additional_info['current_user'] = $this->user_self;
		}
		else{
			$user_additional_info['current_user'] = $this->user_logged_vistor;
		}
		$this->users_following = Users::model()->get_profile_following_users($row['user_id']);
		if($this->users_following){
			foreach($this->users_following as $user_follow){
				$this->profile_follow_userdetails = Users::model()->getUserInfo($user_follow['follow_id']);
				$this->profile_follower_count = Users::model()->get_profile_follower_count($user_follow['follow_id']);
				$this->profile_follow_userdetails['followerCount'] = $this->profile_follower_count;
				$this->avatar = $this->profile_follow_userdetails['user_details_avatar'];
				$fromurl = strstr($this->avatar, '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$user_follow_avatar = $this->avatar; 
				elseif(!empty($this->avatar))
					$user_follow_avatar = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
				else	
					$user_follow_avatar = Yii::app()->baseUrl.'/profiles/noimage.jpg';				
				$this->profile_follow_userdetails['avatar'] = $user_follow_avatar;
				$folllow_users[] = $this->profile_follow_userdetails;				
			}
		}
		// seprate odd, even users
		foreach( $folllow_users as $key => $value ) {
			if( 0 === $key%2) { //Even
				$folllow_users_even[] = $value;
			}
			else {
				$folllow_users_odd[] = $value;
			}
		}		
		$user_additional_info['users_following_odd'] = $folllow_users_odd;
		$user_additional_info['users_following_even'] = $folllow_users_even;
		$this->renderPartial('following', array('user_info' => $user_additional_info));
	}

	public function actionFollowers(){
		$folllower_users =array();
		$folllower_users_odd = array();
		$folllower_users_even = array();
		$profile_url = $_REQUEST['param'];
		$id = Yii::app()->user->id;
		$user_about_info = array();
		$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
		$this->profile_details = Users::model()->getUserInfo($row['user_id']);
		$user_additional_info['users_details'] = $this->profile_details;			
		if(Yii::app()->user->isGuest) {
			$user_additional_info['current_user'] = $this->user_guest;
		}		
		elseif($id == $row['user_id']){
			$user_additional_info['current_user'] = $this->user_self;
		}
		else{
			$user_additional_info['current_user'] = $this->user_logged_vistor;
		}
		$this->users_folllower = Users::model()->get_profile_follower_users($row['user_id']);

		if($this->users_folllower){
			foreach($this->users_folllower as $user_follower){		
				$this->profile_follower_userdetails = Users::model()->getUserInfo($user_follower['user_id']);
				$this->profile_follower_count = Users::model()->get_profile_follower_count($user_follower['user_id']);
				$this->profile_follower_userdetails['followerCount'] = $this->profile_follower_count;
				$this->avatar = $this->profile_follower_userdetails['user_details_avatar'];
				$fromurl = strstr($this->avatar, '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$user_follower_avatar = $this->avatar; 
				elseif(!empty($this->avatar))
					$user_follower_avatar = Yii::app()->baseUrl.'/profiles/'.$this->avatar;
				else	
					$user_follower_avatar = Yii::app()->baseUrl.'/profiles/noimage.jpg';				
				$this->profile_follower_userdetails['avatar'] = $user_follower_avatar;
				$folllower_users[] = $this->profile_follower_userdetails;				
			}
		}
		// seprate odd, even users
		foreach( $folllower_users as $key => $value ) {
			if( 0 === $key%2) { //Even
				$folllower_users_even[] = $value;
			}
			else {
				$folllower_users_odd[] = $value;
			}
		}		
		$user_additional_info['users_follower_odd'] = $folllower_users_odd;
		$user_additional_info['users_follower_even'] = $folllower_users_even;

		$this->renderPartial('followers', array('user_info' => $user_additional_info));
	}

	public function actionCatwalk(){
		$this->renderPartial('catwalk');
	}
	
	public function actionFriends(){
		$this->renderPartial('friends');
	}
	
	/**
	* Displays the settings page for user
	* Last Modified:17-Oct-14
	*/	
	public function actionProfilesettings(){
		$this->layout='profile_layout';
		$this->render('index');
	}
	
		/**
	* Request friend request to the user
	* Last Modified:19-Oct-14
	*/	
	public function actionAddfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		//$countries = Countries::model()->get_current_nearbycountries($ip);		
		$response = UsersFriends::model()->send_friend_request($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();
	}
	
	public function actionRemovefriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFriends::model()->delete_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();
	}
	
	public function actionFollowfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFollow::model()->follow_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();		
	}
	
	public function actionFollowingfriend(){
		$profile_current = json_decode($_POST['profile_current']);
		$profile_other = json_decode($_POST['profile_other']);
		$response = UsersFollow::model()->following_friend($profile_current,$profile_other);
		if($response){
			echo CJSON::encode(array(
				'status'=>'success',
			));
		}
		else{
			echo CJSON::encode(array(
				'status'=>'error',
			));			
		}
		Yii::app()->end();		
	}	
	

	public function actionAddHearts() {
		
		$url = Yii::app()->session['url'];
		
		if(isset($_GET['action'])) {
			
			$action = $_GET['action'];
			
			if ($action == "heart") {
				if (isset($url)) {				
					$access_user_id = Yii::app()->session['user_id'];				 
					 
					$criteria = new CDbCriteria();
					$criteria->offset = $_GET['limit']-2;
					$criteria->limit = 2;
					$criteria->condition = 't.user_id ='.$access_user_id;
					 
					$hearts = LogPhotosHearts::model()->with('user.userDetails','photos', 'photos.logPhotosComments', 'photos.logPhotosCount')->findAll($criteria);							
					if (isset($hearts) && !empty($hearts)) 
						$this->renderPartial('addhearts',array('model'=>$hearts));
		 
				}  
			}
		 
		}
	}
}
?>
	
	