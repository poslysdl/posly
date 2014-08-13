<?php
/*
	* photo likes counts actions
*/
class LikesController extends Controller
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
				'actions'=>array('cincrease','cdecrease'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

		//this is the action for increase the like count.
	public function actionCincrease()
	{
		$id= $_GET['id'];
		$uid=Yii::app()->user->id;
		$count=Photos::model()->findByPk($id);
		$count->photos_hearts_count+=1;
		$count->save();
		
		$likes= new LogPhotosHearts;
		$likes->user_id= $uid;
		$likes->owner_id=$count->user_id;
		$likes->photos_id=$id;
		$time=new CTimestamp;
		$value=$time->getDate();
		$likes->log_photos_hearts_date=$value[0];
		$likes->save();
		echo $count->photos_hearts_count;
		Yii::app()->end();
	}
	//this is the action for decrease the like count.
	public function actionCdecrease()
	{
		$id= $_GET['id'];
		$uid=Yii::app()->user->id;
		$count=Photos::model()->findByPk($id);
		if($count->photos_hearts_count>0)
		{
				$count->photos_hearts_count-=1;
				$count->save();
		}

		$dlike=LogPhotosHearts::model()->find("user_id=$uid and photos_id=$id");
		$dlike->delete();
		echo $count->photos_hearts_count;
		Yii::app()->end();
	}
	

}