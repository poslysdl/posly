<?php

class MessageController extends Controller
{
	public function actionIndex()
	{
		$this->layout='newsfeed_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0];		
		$this->render('index');				
	}
}

?>
