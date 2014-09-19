<?php
//** Last Modified On : 19-Sept-14

class MessageController extends Controller
{

	public function filters() {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
	public function accessRules() {
        return array(
            array('allow',
            	'actions'=>array('index','ajaxchatfriends'),
                'users'=>array('*'),
            ),
            array('deny'),
        );
    }
	
	/**
	* This is the default 'index' action that is invoked
	* when an action is not explicitly requested by users.
	* Last Modified On: 19-Sep-14
	*/
	public function actionIndex()
	{
		$this->layout='newsfeed_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0]; 
		echo "Message Center";		
		$this->render('index');				
	}
	
	/**
	* This is a User_define Ajax function used to Display 
	* loggedIn user's Message Friends List at Side-bar,
	* Last Modified On: 19-Sep-14 
	*/
	public function actionAjaxchatfriends()
	{
		$limit = 6;
		$str='';
		$uid = Yii::app()->user->id;
		$friendslist=UsersFriends::model()->getOnlineFriends($uid,$limit); 
		if(!empty($friendslist))
		{			
			foreach($friendslist as $keys=>$values)
			{
				if($uid==$values['userid']){
					$name=$values['frndname'];
					$avatar=$values['frndavatar'];
					$device=$values['frnddevice'];
					$online=$values['frndonline'];
				} else{
					$name=$values['username'];
					$avatar=$values['useravatar'];
					$device=$values['userdevice'];
					$online=$values['useronline'];
				}
				if($online=='0'){
					$dev='';
					$status='status offline';
				} else{
					$status='status online';
					if($device=='0')
					$dev='Web<i class="icon-globe"></i>';
					else
					$dev='Mobile<i class="icon-mobile-phone"></i>';
				}
				$fromurl=strstr($avatar, '://', true);
				if($fromurl=='http' || $fromurl=='https')
					$avatar = $avatar; 
				else
					$avatar = Yii::app()->baseUrl.'/profiles/'.$avatar;
				$name = (strlen($name) > 13)?ucwords(substr($name,0,10)).'..': ucwords($name);
				$str.='
				<li>
				<div class="col1"> 
				<img class="avatar img-responsive" alt="" src="'.$avatar.'" />
				<div class="message"> 
				<span class="name">'.$name.'</span> </div>
				</div>			
				<div class="col2">
				<div class="'.$status.'">'.$dev.'</div>				
				</div>
				</li>	
				';
			}
		}
		echo CJSON::encode($str); 
		Yii::app()->end();
	}
	
	
//END
}

?>
