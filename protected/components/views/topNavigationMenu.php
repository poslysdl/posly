<!--<div id="breadCrumb">   
<div>
<?php //$array = $this->navigationmenu; //By SDL developer
	//echo $array['menu'];
?></div>
</div>-->

<!-- BEGIN TOP NAVIGATION MENU -->
<ul class="nav navbar-nav pull-right">
<?php
if(Yii::app()->user->isGuest)
{ ?>
	<!-- BEGIN SIGNIN DROPDOWN -->
	<li class="dropdown" > 
	<a href="#" class="dropdown-toggle sign-inhead" data-toggle="dropdown" data-hover="dropdown"
	data-close-others="true"> Sign in</a>
	<ul class="dropdown-menu signup">
	<li><span>Sign in with</span></li>
	<li>
	<?php //echo CHtml::link('Facebook',array('#','provider'=>'Facebook'), array('class'=>'btn faceS')); ?>
	<a class="btn faceS" href="javascript:void(0);">Facebook</a>
	</li>
	<li>
	<a class="btn insta instaS" href="javascript:void(0);">Instagram</a>
	</li>	
	<li>
	<button type="button" class="btn meoS checkmsg" data-toggle="modal" href="#loginModal">Email</button>
	</li>
	</ul>
	</li>
	<!-- END SIGNIN DROPDOWN --> 
	<!-- BEGIN SIGN UP DROPDOWN -->
	<li class="dropdown"> 
	<a href="#" class="dropdown-toggle sign-inhead" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">Sign Up	
	</a>
	<ul class="dropdown-menu signup">
	<li><span>Sign Up with</span></li>
	<li>
	<a class="btn faceS" href="javascript:void();">Facebook</a>
	</li>
	<li>
	<a class="btn insta instaS" href="javascript:void(0);">Instagram</a>
	</li>
	<li>
	<button type="button" class="btn meoS checkmsg" data-toggle="modal" href="#sign-up">Email</button>
	</li>
	</ul>		
	</li>
	<!-- END SIGN UP DROPDOWN --> 
<?php 
}
else 
{ ?>     
	<!-- BEGIN INBOX DROPDOWN -->
	<?php
		$id=Yii::app()->user->id; 
		$userDetailId = Yii::app()->user->detailid;
		$user_regstep = Users::model()->getRegistrationStep($id);
		if($user_regstep<6){
			$msglist = array(); //If user didn't complete Reg steps, don't Show Icons
			$msgHideclass = 'style="display:none;"';
		} else{
			$msglist=UsersMessages::model()->getLatestmsg($id,$userDetailId);
			$msgHideclass = '';
		}
		$unreadcnt = '';
		if(!empty($msglist) && count($msglist)>0){
		foreach($msglist as $k1=>$v1){
			if($v1['reply_detailid']!=$userDetailId && $v1['rplystatus']==0)
			$unreadcnt++;
		}
		}
	?>
	<li class="dropdown" id="header_inbox_bar" <?php echo $msgHideclass; ?>>	
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">		
	<i class="icon-envelope"></i><span class="badge"><?php echo $unreadcnt; ?></span>
	</a>	
		<?php if(isset($msglist) && count($msglist)>0){ ?>
		<ul class="dropdown-menu extended inbox">
		<li>
			<ul class="dropdown-menu-list scroller" style="height: 205px;">
			<?php foreach($msglist as $keys=>$values){
				$avatar='';
				$name='';
				$replyico='<img src="'.Yii::app()->theme->baseUrl.'/img/replyico.gif">';
				$unreadclass = '';
				if($values['from_detailid']!=$userDetailId)
				{
					$name=$values['from_uname'];
					$avatar=$values['from_avatar'];
					$fromurl=strstr($avatar, '://', true);
					if($fromurl=='http' || $fromurl=='https')
						$avatar = $values['from_avatar']; 
					else
						$avatar = Yii::app()->baseUrl.'/profiles/'.$values['from_avatar'];
				}
				if($values['to_detailid']!=$userDetailId)
				{
					$name=$values['to_uname'];
					$avatar=$values['to_avatar'];
					$fromurl=strstr($avatar, '://', true);
					if($fromurl=='http' || $fromurl=='https')
						$avatar = $values['to_avatar']; 
					else
						$avatar = Yii::app()->baseUrl.'/profiles/'.$values['to_avatar'];
				}
				if($values['reply_detailid']!=$userDetailId){
					//reply By Others sent to Me
					$replyico='';
					if($values['rplystatus']==0)
					$unreadclass = 'unreadmsg';
				}
				$msgtxt=$values['reply'];
				$temp = explode(" ",$msgtxt);
				if(count($temp)>6)
					$msgtxt = $temp[0].' '.$temp[1].' '.$temp[2].' '.$temp[3].' '.$temp[4].' '.$temp[5].'...';
				$datetime=$this->get_msgtime($values['replydate']);
				$msgtxt = $replyico.' '.$msgtxt;
				
			?>
			<li> 
			<a href="<?php echo Yii::app()->createUrl('/message/index/?id=2'); ?>" class="<?php echo $unreadclass;?>"> <!-- inbox.html?a=view -->
			<span class="photo">
				<img class="avatar-user-l img-responsive" src="<?php echo $avatar; ?>" alt=""/>
			</span> 
			<span class="subject">
				<span class="from"><?php echo $name;?></span> 
			</span> 
			<span class="message"><?php echo $msgtxt; ?></span>
			<span class="newtime"><?php echo $datetime;?></span><!--style.css 4479-->			
			</a> 
			</li>
			<?php } ?>
			</ul>
		</li>
		<li class="external canhtop">
		<a href="<?php echo Yii::app()->createUrl('/message/index'); ?>">See all messages
		<i class="icon-arrow-right-light"></i>
		</a>
		</li>
		</ul>
		<?php } else{ ?>
		<ul class="dropdown-menu extended inbox">
		<li><ul class="dropdown-menu-list scroller" style="height: 50px;">
		<li style="margin:2px 0px 0px 6px;">No Messages Yet !</li>
		</ul></li>
		</ul>
		<?php } ?>
	</li>
	<!-- END INBOX DROPDOWN --> 
      
	<!-- BEGIN NOTIFICATION DROPDOWN -->
	<li class="dropdown" id="header_notification_bar" <?php echo $msgHideclass; ?>>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"  data-close-others="true"> 
	<i class="icon-megaphone"></i><span class="badge"><!--notify count(6)--></span>
	</a>
	<ul class="dropdown-menu extended notifi">
	<li>
	<ul class="dropdown-menu-list scroller" style="height: 205px;">			
	<!-- Notification List Shown Here -->
	</ul>
	</li>
	<li class="external canhtop"> <a href="#">See all notifications <i class="icon-arrow-right-light"></i></a> </li>
	</ul>
	</li>
	<!-- END NOTIFICATION DROPDOWN --> 
	
	<!-- BEGIN USER LOGIN DROPDOWN -->
	<li class="dropdown user hidden-mobi">
	<?php 
	$id=Yii::app()->user->id;
	$a=UsersDetails::model()->find("user_id=$id");
	$user_avtar = '';
	if(isset($a))
	{
		$fromurl=strstr($a->user_details_avatar, '://', true);
		if($fromurl=='http' || $fromurl=='https')
			$user_avtar = $a->user_details_avatar; 
		else
			$user_avtar = Yii::app()->baseUrl.'/profiles/'.$a->user_details_avatar;	
	}
	?>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 
	<img class="avatar-user img-responsive"  alt="" src="<?php echo $user_avtar;?>"/> 
	<span class="username"></span><i class="icon-caret-down"></i> 
	</a>
	<ul class="dropdown-menu">		
		<li><?php echo CHtml::link('My profile',array('profile/index', 'url'=>$a->user_unique_url), array('class'=>'gren  first')); ?> </li>		
		<li><a class="gren" href="<?php echo Yii::app()->createUrl('/profile/profilesettings'); ?>">settings</a></li>
		<li class="divider"></li>		
		<li> 
		<?php echo CHtml::link('Logout',array('site/logout'), array('class'=>'gren  first')); ?>
		</li>
		
	</ul>	
	</li>
   <!-- END USER LOGIN DROPDOWN --> 
     
	<!-- BEGIN SEARCH FROM -->
	<li class="searchbox hidden-mobi"> 
	<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
	<form class="sidebar-search" action="<?php echo Yii::app()->createUrl('/search'); ?>" method="POST">
	<div class="form-container">
	<input type="text" name="search" placeholder="Search for tag and user"/>
	<input type="button" class="submit" value="&#xe058;"/>
	</div>
	</form>
	<!-- END RESPONSIVE QUICK SEARCH FORM --> 
	</li>
    <!-- END SEARCH FROM -->
 <?php } ?>	
</ul>

<!-- END TOP NAVIGATION MENU -->

<?php if(!Yii::app()->user->isGuest)
{
//Yii::app()->params is in /protected/config/main.php, secret key is in application components in main.php
?>
<?php //FB JS code was here, in this condition, removed 13-Sep-14
 } 
?>