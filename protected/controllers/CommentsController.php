<?php

class CommentsController extends Controller
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
				'actions'=>array('addcomment'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * this method for add user comments for particular image
	 */
	 public function actionAddcomment()
	 {
	 	if(isset($_GET['id']) && isset($_GET['comment']))
	 	{
	 		$ph=Photos::model()->findByPk($_GET['id']);
	 		$c=new LogPhotosComment;
	 		$time=new CTimestamp;
			$value=$time->getDate();		
	 		$c->photos_id=$_GET['id'];
	 		$c->owner_id=$ph->user_id;
	 		$c->user_id = Yii::app()->user->id;
	 		$c->log_photos_comment_description=$_GET['comment'];
	 		$c->log_photos_comment_hide=0;
	 		$c->log_photos_comment_date=$value[0];
			if($c->save())
			{
				$p=$_GET['id'];
				$com=LogPhotosComment::model()->with('user.userDetails')->findByPk($c->log_photos_comment_id);
				$time=new CTimestamp;
                $inserted=$this->get_time_ago($c->log_photos_comment_date);
                
                $arr = array('avatar' => $com->user->userDetails->user_details_avatar, 'firstName' => $com->user->userDetails->user_details_firstname, 'lastName' => $com->user->userDetails->user_details_lastname, 'created_date' => $inserted, 'comment' => $com->log_photos_comment_description);

				echo json_encode($arr);

	 		}
	 	}
		Yii::app()->end();
	}
	
}