<?php
/** TopNavigationMenu is used to Render Header menus
 * Such as notification, message icon, search box at the page Header
 * is Called at view files
*/
class TopNavigationMenu extends CWidget {
 
    public $navigationmenu = array(); //to Pass values to the view file  
 
    public function run() {		
        $this->render('topNavigationMenu');
    }
	
	public function get_msgtime($time_stamp) 
	{
		$time_difference = strtotime('now') - $time_stamp;
		if ($time_difference >= 60 * 60 * 24 * 365.242199)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
			 * This means that the time difference is 1 year or more
			*/
			return date('M j y',$time_stamp);
		}
		elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
			 * This means that the time difference is 1 month or more
			 */
			return date('M j',$time_stamp);
		}
		elseif ($time_difference >= 60 * 60 * 24 * 7)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
			 * This means that the time difference is 1 week or more
			 */
			return date('M j',$time_stamp);
		}
		elseif ($time_difference >= 60 * 60 * 24)
		{
			/* 60 seconds/minute * 60 minutes/hour * 24 hours/day
			 * This means that the time difference is 1 day or more
			 */
			return date('M j',$time_stamp);
		}
		elseif ($time_difference >= 60 * 60)
		{
			/* 60 seconds/minute * 60 minutes/hour
			 * This means that the time difference is 1 hour or more
			 */
			return date('g:ia',$time_stamp);
		}
		else
		{
			/* 60 seconds/minute
			 * This means that the time difference is a matter of minutes
			 */
			return date('g:ia',$time_stamp);
		}		
	}	
 
}

?>