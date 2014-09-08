<?php

class FollowController extends Controller
{
	/**
	 * @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('adduser','unfollow','fbinvite'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/* To Ajax Function to add Follow, 
	LastModifed : 08-Sept-14
	*/
	public function actionAdduser()
	{
		$id=Yii::app()->user->id;
		$uid=$_REQUEST['id'];
		$msg='';
		$status='error';
		if(isset($id))
		{
			if($id==$uid)
				$status='error';
			else
			{				
				$check=UsersFollow::model()->find("user_id=$uid and follow_id=$id");
				if(isset($check)){
					$status='error';;
				}
				else
				{
					$likes= new UsersFollow;
					$likes->user_id= $uid;
					$likes->follow_id=$id;
					if($likes->save()){
						$status='success';
						$msg = $likes->user_follow_id;
					}
				}				
			}
		}
		echo CJSON::encode(array(
		'status'=>$status,
		'msg'=>$msg
		));
		Yii::app()->end();
	}
	
	/* To Ajax Function to Unfollow, 
		LastModifed : 08-Sept-14
	*/
	public function actionUnfollow()
	{
		$id=Yii::app()->user->id;
		$uid=$_REQUEST['id'];
		$fid=$_REQUEST['fid'];
		$msg='';
		$status='error';
		if(isset($id))
		{
			if($id==$uid)
				$status='error';
			else
			{				
				$check=UsersFollow::model()->find("user_id=$uid and follow_id=$id");
				if(isset($check)){
					$criteria = new CDbCriteria();
					$criteria->condition = "user_follow_id='".$fid."'";
					//$criteria->condition = "user_id='".$uid."' AND follow_id=$id";
					if($fid!="")
					UsersFollow::model()->deleteAll($criteria);
					$status='success';
				}						
			}
		}
		echo CJSON::encode(array(
		'status'=>$status,
		'msg'=>$msg
		));
		Yii::app()->end();
	}
	
	/* To Ajax Function to Invite your facebook frnd, 
		LastModifed : 08-Sept-14
	*/
	public function actionFbinvite()
	{
		$id=Yii::app()->user->id;
		$uid=$_REQUEST['id'];
		$idata = $_POST['idata'];
		if(!empty($idata))
		$fbinvited_identifier = json_decode($idata); 
		//$fbinvited_identifier is an PHP array contains FB identifier		
		$msg='';
		$status='error';
		if(isset($fbinvited_identifier) && count($fbinvited_identifier)>0)
		{
			
				$status='success';
			}		
		}
		echo CJSON::encode(array(
		'status'=>$status,
		'msg'=>$msg
		));
		Yii::app()->end();
	}	
}