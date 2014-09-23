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
				'actions'=>array('addcomment','commentlike'),
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
	
	/**
	* This user define Ajax function Comment Like & Dislike 
	* When User Clicks on LIKE link of a comment in Card
	* Last Modified:22-Sep-14
	*/
	public function actionCommentlike()
	{
		$cnt=0;
		$status='error';
		$uid = Yii::app()->user->id;
		if(isset($_POST['pdata']))
		{	
			$comment_id = $_POST['pdata'];
			$flag = $_POST['pflag'];
			if($flag=="Like"){
				$cnt=LogPhotosComment::model()->UpdateLikeCount($uid,$comment_id,$flag);
			} else{
				$cnt=LogPhotosComment::model()->UpdateLikeCount($uid,$comment_id,$flag);
			}
			$status='success';
		}
		echo CJSON::encode(array(
			  'status'=>$status,
			  'values'=>$cnt
		));
		Yii::app()->end();		
	}
	
}