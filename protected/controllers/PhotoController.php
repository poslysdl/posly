<?php

class PhotoController extends Controller
{
	public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
    public function accessRules()
    {
        return array(
        	array('allow',
            	'actions'=>array('changetags', 'changecomments', 'changelikes', 'wholiked'),
                'users'=>array('*'),
            ),
            array('allow',
            	'actions'=>array('upload', 'uploadform', 'album', 'share', 'sharecount'),
                'users'=>array('@'),
            ),
            array('deny'),
        );
    }
    /**
	* who liked the passed photo id before details
	* 
	* @return
	*/
	public function actionWholiked()
	{
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$criteria = new CDbCriteria();
			$criteria->group = 'photos.user_id';
			$criteria->condition = "logPhotosHearts.photos_id=$id and photos.photos_id <> $id";
			$allusersphotos=Users::model()->with('photos','userDetails', 'logPhotosHearts')->findAll($criteria);  
			$this->renderPartial('wholikes', array('photos'=>$allusersphotos));
		}
		Yii::app()->end();
	}
    public function actionUpload()
    {
		$upload_handler = new UploadHandler();
		Yii::app()->end();
	}
	public function actionUploadform()
	{
		$this->renderPartial('upload');
	}
	public function actionAlbum()
    {
    	if($_GET['name'])
    	{
			$a= new UserAlbums;
			$a->user_id=Yii::app()->user->id;
			$a->album_name=$_GET['name'];
			$time=new CTimestamp;
			$value=$time->getDate();
			$a->created_date=$value[0];
			$a->save();
			echo CJSON::encode($a);
		}

		Yii::app()->end();
	}
	public function actionShare()
	{
		$url=Yii::app()->request->cookies['purl']->value;
		$pdata=array('url'=>'http://i2pretty.com/files/50/medium/Jellyfish.jpg', 'message'=>'Shared from posly.com');
		if(Yii::app()->hybridAuth->isAdapterUserConnected('Facebook'))
		$socialUser = Yii::app()->hybridAuth->postImg('Facebook', $pdata );
		print_r($socialUser);
		
		Yii::app()->end();
	}
	public function actionSharecount()
	{
		$p=Photos::model()->findByPk($_POST['id']);
		if(isset($p))
		{
			
			$share= new LogPhotosShare;
			$share->log_photos_share_media_id=$_POST['shareid'];
			$share->photos_id=$p->photos_id;
			$share->user_id=Yii::app()->user->id;
			$share->owner_id=$p->user_id;
			$time=new CTimestamp;
			$value=$time->getDate();
			$share->log_photos_share_date=$value[0];
			if($share->save())
			echo 'ok';
		}
		Yii::app()->end();
	}
	public function actionChangetags()
	{
		if(isset($_GET['photoid']))
		{
			$id=$_GET['photoid'];
			$tags=PhotosHashtags::model()->with('hashtags')->findAll("photos_id=$id");
			$temp=array();
			$temptotal=array();
			foreach($tags as $t)
			{
				$temp['tag']=$t->hashtags->hashtags_name;
				$temp['url']=Yii::app()->createAbsoluteUrl('site/hashtags', array('hid'=>$t->hashtags->hashtags_id));
				$temptotal[]=$temp;
			}
			echo CJSON::encode($temptotal);
			
		}
		Yii::app()->end();
	}
	public function actionChangecomments()
	{
		if(isset($_GET['photoid']))
		{
			$id=$_GET['photoid'];
			$temp=array();
			$temptotal=array();
			$comments=LogPhotosComment::model()->with('user.userDetails')->findAll("photos_id=$id");
			if(isset($comments))
			{
				foreach($comments as $com)
				{
					$temp['firstname']=$com->user->userDetails->user_details_firstname;
					$temp['lastname']=$com->user->userDetails->user_details_lastname;
					$temp['photo']=$com->user->userDetails->user_details_avatar;
					$temp['comment']=$com->log_photos_comment_description;
					$time=new CTimestamp;
                    $temp['created_date']= $this->get_time_ago($com->log_photos_comment_date);
                    $temptotal[]=$temp;
				}
			}
			echo CJSON::encode($temptotal);
			
		}
		Yii::app()->end();
	}
	public function actionChangelikes()
	{
		if(isset($_GET['photoid']))
		{
			$id=$_GET['photoid'];
			$l=Photos::model()->findByPk($id);
			echo $l->photos_hearts_count;
			
		}
		Yii::app()->end();
	}
	
	
	public function get_time_ago($time_stamp)
	{
	    $time_difference = strtotime('now') - $time_stamp;

	    if ($time_difference >= 60 * 60 * 24 * 365.242199)
	    {
	        /*
	         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
	         * This means that the time difference is 1 year or more
	         */
	        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
	    }
	    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
	    {
	        /*
	         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
	         * This means that the time difference is 1 month or more
	         */
	        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
	    }
	    elseif ($time_difference >= 60 * 60 * 24 * 7)
	    {
	        /*
	         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
	         * This means that the time difference is 1 week or more
	         */
	        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
	    }
	    elseif ($time_difference >= 60 * 60 * 24)
	    {
	        /*
	         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
	         * This means that the time difference is 1 day or more
	         */
	        return $this->get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
	    }
	    elseif ($time_difference >= 60 * 60)
	    {
	        /*
	         * 60 seconds/minute * 60 minutes/hour
	         * This means that the time difference is 1 hour or more
	         */
	        return $this->get_time_ago_string($time_stamp, 60 * 60, 'hour');
	    }
	    else
	    {
	        /*
	         * 60 seconds/minute
	         * This means that the time difference is a matter of minutes
	         */
	        return $this->get_time_ago_string($time_stamp, 60, 'minute');
	    }
	}

	public function get_time_ago_string($time_stamp, $divisor, $time_unit)
	{
	    $time_difference = strtotime("now") - $time_stamp;
	    $time_units      = floor($time_difference / $divisor);

	    settype($time_units, 'string');

	    if ($time_units === '0')
	    {
	        return 'less than 1 ' . $time_unit . ' ago';
	    }
	    elseif ($time_units === '1')
	    {
	        return '1 ' . $time_unit . ' ago';
	    }
	    else
	    {
	        /*
	         * More than "1" $time_unit. This is the "plural" message.
	         */
	        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
	        return $time_units . ' ' . $time_unit . 's ago';
	    }
	}

	
	
}