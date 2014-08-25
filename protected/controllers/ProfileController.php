<?php
class ProfileController extends Controller
{ 
   public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
	public function accessRules() {
        return array(
            array('allow',
            	'actions'=>array('index', 'addhearts', 'following', 'followers', 'about', 'albums', 'hearts', 'ranks','catwalk','friends'),
                'users'=>array('*'),
            ),
            array('deny'),
        );
    }
	
	public function actionIndex($url) 
	{			
		//allow user profiles who has everyone		 
		if(Yii::app()->user->isGuest) 
		{
			$error = false;
			if(isset($url) && !empty($url)) 
			{				
				$profile_url = $url;
				Yii::app()->session['url'] = $profile_url;
				$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
				Yii::app()->session['user_id'] = $row['user_id'];				
				if (isset($row)) {
					$user_id = $row['user_id'];
					
					$sec_row = UsersSecurity::model()->find("user_id=$user_id");
					$privacy = $sec_row['whocansee'];
					
					if ($privacy == 1) {
							$this->layout='profile_layout';
							Yii::app()->clientScript->registerCoreScript('jquery'); 
							$this->render('index');

					} else /* if privacy is 2 or 3 */ {
						$error = true;
					}
					
				} else {
					//if the user with that profile name is not there redirect or sent error message
					$error = true;
				}
				
			} else {
				//redirect to the return url or get some error message
				$error = true;
			}
			if($error)
				$this->redirect(Yii::app()->homeUrl);
			
		} 					
		else 
		{
			//allow user profile accordingly everyone and followers
			$error = false;
			$id = Yii::app()->user->id;
			if(isset($url) && !empty($url)) 
			{
				$profile_url = $url;
				Yii::app()->session['url'] = $profile_url;
				$row = UsersDetails::model()->find("user_unique_url='$profile_url'");
				Yii::app()->session['user_id'] = $row['user_id'];
				if(isset($row)) {
					$user_id = $row['user_id'];					
					if($id == $user_id) {
						$this->layout='profile_layout';
						Yii::app()->clientScript->registerCoreScript('jquery'); 
						$this->render('index');
					} 
					else 
					{
						$sec_row = UsersSecurity::model()->find("user_id=$user_id");
						$privacy = $sec_row['whocansee'];						
						if($privacy == 1) {
								$this->layout='profile_layout';
								Yii::app()->clientScript->registerCoreScript('jquery'); 
								$this->render('index');

						} else if ($privacy == 2){							
						$row = UsersFollow::model()->find("follow_id=$user_id and user_id=$id");
								if (isset($row)) {
									$this->layout='profile_layout';
									Yii::app()->clientScript->registerCoreScript('jquery'); 
									$this->render('index');
								} else {
									//$this->redirect(Yii::app()->homeUrl);
									//$this->render("error");
									$error = true;
								}  
						} else {
							//$this->redirect(Yii::app()->homeUrl);
							//$this->render("error");
							$error = true;
						}
					}
				} else /* if the user is not there with that profile id */ {
					$error = true;
				}
			
			} else /* if the url is not set */{
				$error = true;
			}			
			if($error){
				$this->redirect(Yii::app()->homeUrl);
			}
		}		 
	}
	
	public function actionAbout() 
	{		   
		/*$url = Yii::app()->session['url'];		 
		if(isset($url)) {			 
		$user = Yii::app()->session['user_id'];		  
		$mag_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Magzine' and t.user_id=$user");		
		$design_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Design' and t.user_id=$user");
		$shops_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='Shops' and t.user_id=$user");
		$styles_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='StyleIcons' and t.user_id=$user");
		$mtstyle_tags = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtagsCategory.hashtags_category_name='MyStyle' and t.user_id=$user");			
		$this->renderPartial('about', array('mag_tags'=>$mag_tags, 'design_tags'=>$design_tags,
		'shops_tags'=>$shops_tags, 'styles_tags'=>$styles_tags, 'mtstyle_tags'=>$mtstyle_tags));			
		} else{			 
			 echo CJSON::encode(array('status'=>'failure','redirect'=>Yii::app()->homeUrl));
					// Yii::app()->end();
			//$this->redirect(Yii::app()->homeUrl);	
		} */		
		$this->renderPartial('about');
			
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
	
	 
	public function actionHearts()
	{		 
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

	public function actionFollowing(){
		$this->renderPartial('following');
	}

	public function actionFollowers(){
		$this->renderPartial('followers');
	}

	public function actionCatwalk(){
		$this->renderPartial('catwalk');
	}
	
	public function actionFriends(){
		$this->renderPartial('friends');
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
	
	