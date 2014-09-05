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
	<li class="dropdown" > <a href="#" class="dropdown-toggle sign-inhead" data-toggle="dropdown" data-hover="dropdown"
	data-close-others="true"> Sign in</a>
	<ul class="dropdown-menu signup">
	<li><span>Sign in with</span></li>
	<li>
	<?php echo CHtml::link('Facebook',array('user/hybridauth/authenticate','provider'=>'Facebook'), array('class'=>'btn faceS')); ?>
	</li>
	<li>
	<?php echo CHtml::link('Instagram',array('#','provider'=>'Instagram'), array('class'=>'btn insta')); ?>
	</li>
	<li>
	<button type="button" class="btn meoS checkmsg" data-toggle="modal" href="#loginModal">Email</button>
	</li>
	</ul>
	</li>
	<!-- END SIGNIN DROPDOWN --> 
	<!-- BEGIN SIGN UP DROPDOWN -->
	<li class="dropdown user"> 
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	<button type="button" class="btn meoS" data-toggle="modal" href="#sign-up">Sign Up</button>		
	</a>
	<ul class="dropdown-menu signup">
	<li><span>Sign Up with</span></li>
	<li>
	<?php echo CHtml::link('Facebook',array('user/hybridauth/authenticate','provider'=>'Facebook'), array('class'=>'btn faceS')); ?>
	</li>
	<li>
	<?php echo CHtml::link('Instagram',array('#','provider'=>'Instagram'), array('class'=>'btn insta')); ?>
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
	<li class="dropdown" id="header_inbox_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
	  data-close-others="true"> <i class="icon-envelope"></i> <span class="badge">5</span> </a>
	<ul class="dropdown-menu extended inbox">
	<li>
	<ul class="dropdown-menu-list scroller" style="height: 205px;">
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" alt=""/></span> <span class="subject"> <span class="from">Lisa Wong</span> <span class="time">Just Now</span> </span> <span class="message"> Coming from TopNavigation widget </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar3.jpg" alt=""/></span> <span class="subject"> <span class="from">Richard Doe</span> <span class="time">16 mins</span> </span> <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" alt=""/></span> <span class="subject"> <span class="from">NY Nilson</span> <span class="time">2 hrs</span> </span> <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" alt=""/></span> <span class="subject"> <span class="from">NY Nilson</span> <span class="time">2 hrs</span> </span> <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
	</ul>
	</li>
	<li class="external canhtop"> <a href="inbox.html">See all messages <i class="icon-arrow-right-light"></i></a> </li>
	</ul>
	</li>
	<!-- END INBOX DROPDOWN --> 
      
	<!-- BEGIN NOTIFICATION DROPDOWN -->
	<li class="dropdown" id="header_notification_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
	  data-close-others="true"> <i class="icon-megaphone"></i> <span class="badge">6</span> </a>
	<ul class="dropdown-menu extended inbox">
	<li>
	<ul class="dropdown-menu-list scroller" style="height: 205px;">
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" alt=""/></span> <span class="subject"> <span class="from">Lisa Wong</span> <span class="time">Just Now</span> </span> <span class="message"> Vivamus sed auctor nibh nibh auctor nibh congue </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar3.jpg" alt=""/></span> <span class="subject"> <span class="from">Richard Doe</span> <span class="time">16 mins</span> </span> <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" alt=""/></span> <span class="subject"> <span class="from">NY Nilson</span> <span class="time">2 hrs</span> </span> <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
	<li> <a href="inbox.html?a=view"> <span class="photo"><img class="avatar-user-l img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar2.jpg" alt=""/></span> <span class="subject"> <span class="from">NY Nilson</span> <span class="time">2 hrs</span> </span> <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh
	auctor nibh... </span> </a> </li>
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
		<!--<li><a class="gren first" href="#">Your rank</a></li>
		<li><a class="gren" href="#">your albums</a></li>
		<li><a class="gren" href="#">your like</a></li>-->
		<!--<li class="divider"></li>
		<li><a class="gren" href="#">find friends</a></li>
		<li><a class="gren" href="#">language</a></li>-->
		<li><a class="gren" href="#">settings</a></li>
		<li class="divider"></li>
		<!--<li><a class="gren center" href="#">report a problem</a> </li>-->
		<li class="buttcen">
		<?php echo CHtml::link('Logout',array('site/logout'), array('class'=>'btn meoS')); ?>
		</li>
	</ul>	
	</li>
   <!-- END USER LOGIN DROPDOWN --> 
     
	<!-- BEGIN SEARCH FROM -->

	<li class="searchbox hidden-mobi"> 
	<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
	<form class="sidebar-search" action="extra_search.html" method="POST">
	<div class="form-container">
	<input type="text" placeholder="Search for tag and user"/>
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

<script src='http://connect.facebook.net/en_US/all.js' type="text/javascript"></script>
 
<script type="text/javascript"> 
      FB.init({appId: "<?php echo Yii::app()->params['fbid']; ?>", status: true, cookie: true});
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
      function postToFeed(url) {
      	var auth="<?php if(Yii::app()->user->isGuest) echo '0'; else echo '1'; ?>";
      	if(parseInt(auth)==1)
      	{
		var u=readCookie('purl');
	 	$("body").find('.close').click();
        // calling the API ...
        var obj = {
          method: 'feed',
         // redirect_uri: 'YOUR URL HERE',
          link: 'https://api.facebook.com/me/photos',
          picture: u,
          name: 'Posly.com',
          //caption: '',
          description: 'Posly is the largest social network.'
        };

        function callback(response) {
    if (response && response['post_id']) {
    	var id=readCookie('pid');
    	var shareid=response['post_id'];
    			$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createUrl('/photo/sharecount'); ?>",
					data: { id: id, shareid: shareid}
					})
					.done(function( msg ) {
						if(msg=='ok')
						 alert('Photo was shared successfully.');
					});
     
    } else {
      alert('Photo was not shared.');
    }
        }

        FB.ui(obj, callback);
        }
        else
        {
			$('#share-pic').modal('hide');
			$('#loginModal').modal('show');
		}

      }

</script>

<?php } ?>