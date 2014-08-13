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