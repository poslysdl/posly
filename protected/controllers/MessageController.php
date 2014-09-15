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
		echo "Message Center";		
		$this->render('index');				
	}
}

?>
