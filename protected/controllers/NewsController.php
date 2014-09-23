<?php

class NewsController extends Controller
{
	public $cartlimit = 2; //Display No of Card
	public function actionIndex()
	{
		$this->layout='newsfeed_layout';
		Yii::app()->clientScript->registerCoreScript('jquery'); 
		$time=new CTimestamp;
		$value=$time->getDate();
		$end= $value[0];
		$start= $end-86400000;
		$criteria = new CDbCriteria();
		$criteria->select = 't.* , (SELECT COUNT( * )*(0.3) FROM log_photos_comment a WHERE a.owner_id = t.user_id AND a.log_photos_comment_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1) FROM log_photos_hearts b WHERE b.owner_id = t.user_id AND b.log_photos_hearts_date BETWEEN '.$start.' AND '.$end.' ) + (SELECT COUNT( * )*(1.1) FROM log_photos_share c WHERE c.owner_id = t.user_id AND c.log_photos_share_date BETWEEN '.$start.' AND '.$end.' ) AS totalcount';
		$criteria->condition = 'userDetails.user_unique_url = "poslyadmin" OR t.photos_share_count>0';
		$criteria->group = 't.user_id';
		$criteria->order = 'totalcount DESC';
		$criteria->limit=$this->cartlimit;
		$allusersphotos=Photos::model()->with('user', 'user.userDetails')->findAll($criteria);
	//echo "<pre>"; print_r($allusersphotos); exit;
		unset($criteria);
		//Get Hash Tags Listings for sidebar, this action define in Controller class
		$limit = (Yii::app()->user->isGuest)?9:6; //HashTag Limit		
		$hash_tags = $this->actionHashtaglist($limit);		
		//Inside views/site/index.php ** widget are there to Include SubHeader, TopMenu & SideBar..
		$this->render('index', array('photos'=>$allusersphotos,'hash_tags'=>$hash_tags,'pageflag'=>'newsfeed'));				
	}
}

?>
