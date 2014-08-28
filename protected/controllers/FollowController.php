<?php
/*
	* photo likes counts actions
*/
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
				'actions'=>array('adduser'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

		//this is the action for increase the like count.
	public function actionAdduser()
	{
		$id= $_GET['id'];
		$uid=Yii::app()->user->id;
		if(isset($id))
		{
			if($id==$uid)
				echo 'no';
			else
			{
				
				$check=UsersFollow::model()->find("user_id=$uid and follow_id=$id");
				if(isset($check))
				{
					echo 'already';
				}
				else
				{
				$likes= new UsersFollow;
				$likes->user_id= $uid;
				$likes->follow_id=$id;
				if($likes->save())
					echo 'ok';
				}
				
			}
		}
		Yii::app()->end();
	}
	

}