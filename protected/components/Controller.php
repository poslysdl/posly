<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
	
	/* added on 22-Aug-14 -- By Posly Developers
		get_time_ago() & get_time_ago_string() are user define function 
		so that , they can be accessed to others controllers and can be used as coomon function
		and method under Controller Class can be accessed to other child controllers
	*/
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