<?php
/** Cart is used to Render main cart with Heart in this site
 * Contains, Main image, image-carousel, comments and likes
 * /components/views/cart.php contains the html
*/
class Cart extends CWidget {
 
    public $cartinfo = array();   
 
    public function run() {
        $this->render('cart');
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
	
	function get_time_ago_string($time_stamp, $divisor, $time_unit)
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
	
	public function get_commenttime($time_stamp) 
	{
		$time_difference = strtotime('now') - $time_stamp;
		if($time_difference >= 60 * 60 * 24 * 365.242199)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
			 * This means that the time difference is 1 year or more
			*/
			if($time_difference >60 * 60 * 24 * 365.242199)
				return date('F j y',$time_stamp).' at '.date('g:i a',$time_stamp);
			else
				return date('F j',$time_stamp).' at '.date('g:i a',$time_stamp);
		}
		elseif($time_difference >= 60 * 60 * 24 * 30.4368499)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
			 * This means that the time difference is 1 month or more
			 */
			return date('F j',$time_stamp).' at '.date('g:i a',$time_stamp);
		}
		elseif($time_difference >= 60 * 60 * 24 * 7)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
			 * This means that the time difference is 1 week or more
			 */
			return date('F j',$time_stamp).' at '.date('g:i a',$time_stamp);
		}
		elseif($time_difference >= 60 * 60 * 24)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day
			 * This means that the time difference is 1 day or more
			 */
			return date('F j',$time_stamp).' at '.date('g:i a',$time_stamp);
		}
		elseif($time_difference >= 60 * 60)
		{
			/* 60 seconds/minute * 60 minutes/hour
			 * This means that the time difference is 1 hour or more
			 */	
			$temp = ceil($time_difference/3600);
			$temp = ($time_difference==3600)?'1 hr ago':$temp.' hrs ago';
			return $temp;
		}
		else
		{
			/* 60 seconds/minute
			 * This means that the time difference is a matter of minutes
			 */
			$temp = ceil($time_difference/60);
			$temp = ($time_difference==60)?'1 min ago':$temp.' mins ago';
			return $temp;			
		}		
	}
 
}

/*
public function run() {
	$models = Category::model()->findAll();

	$this->render('category', array(
		'models'=>$models   
	));
}
*/
?>