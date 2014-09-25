<!-- BEGIN TOP NAVIGATION MENU -->
	<?php $this->widget('application.components.TopNavigationMenu', array('navigationmenu' => array('menu'=>'data_tobe_render_in_menus'))); ?>
<!-- END TOP NAVIGATION MENU -->
</div>	
</div> <!-- #top-shadow  ENDS --->
<!-- END HEADER -->
<?php
//echo "<pre>";
//print_r($user_info);
//echo "</pre>";
//exit;
$user_name = $user->user_details_firstname." ".$user->user_details_lastname;
$user_gender = ($user->user_details_gender == 1) ? "M" : "F";
?>

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
<div class="page-content padd-quick">
<div class="row whitebg">
	<div class="martop container padd head-user">
		<div class="head-but">
		<ul class="buton-user pull-right">
			<?php
			if(($user_info['current_user'] != $this->user_guest)&&($user_info['current_user'] != $this->user_self)){
			?>
			<li id="user_follow">
				<button id="profile_<?php echo $user_info['follow'];?>" data-url="<?php echo Yii::app()->createUrl('/profile/'.$user_info['follow'].'friend');?>" class="btn white messege" type="button" href="#"  data-toggle="modal"><?php echo ucfirst($user_info['follow']);?></button>
			</li>
			<?php
			}			
			?>
			<li id="user_friend_status">
			<?php
			if($user_info['current_user'] == $this->user_logged_vistor){
			?>				
				<button style="display: block" id="request_add_friend"  data-url="<?php echo Yii::app()->createUrl('/profile/addfriend');?>" class="btn white messege" type="button" href="#"  data-toggle="modal">Add Friend</button>
			<?php
			}
			?>
			<?php
			if($user_info['current_user'] == $this->user_friend){
			?>				
				<button id="profile_friends"  class="btn white messege" type="button" href="#"  data-toggle="modal">Friends</button>
			<?php
			}
			?>
			<?php
			if($user_info['current_user'] == $this->user_request_send){
			?>				
				<button id="profile_friends_request_send"  class="btn white messege" type="button" href="#"  data-toggle="modal">Friend Request Sent</button>
			<?php
			}
			?>
			<?php
			if($user_info['current_user'] == $this->user_request_receive){
			?>				
				<button id="profile_friends_request_receive"  class="btn white messege" type="button" href="#"  data-toggle="modal">Respond to Friend Request</button>
			<?php
			}
			?>
			
			
			
<!--				<button style="display: none" id="request_remove_friend"  data-url="<?php echo Yii::app()->createUrl('/profile/removefriend');?>" class="btn white messege" type="button" href="#"  data-toggle="modal">Remove Friend</button>-->
			
			</li>		
		<?php
		if($user_info['current_user'] == $this->user_self){
		?>
			
			<li>
				<button class="btn white messege" type="button" href="#"  data-toggle="modal">Edit Profile</button>
			</li>
		<?php
		}
		?>
			<li class="dropdown"> <a data-close-others="true" data-toggle="dropdown" class="dropdown-toggle" href="#">
				<button class="btn white setting" type="button"><i class="icon-gear"></i></button>
			</a>
			<ul class="dropdown-menu setting-acc">
		<?php
		if($user_info['current_user'] == $this->user_logged_vistor){
		?>				
			<li><a class="gren" data-toggle="modal" href="#block-user"> Settings </a> </li>
		<?php
		}
		?>
		<?php
		if($user_info['current_user'] == $this->user_friend){
		?>				
			<li><a class="gren" data-toggle="modal" href="#" id="request_remove_friend"  data-url="<?php echo Yii::app()->createUrl('/profile/removefriend');?>" > Unfriend </a> </li>
		<?php
		}
		?>			
		<?php
		if($user_info['current_user'] == $this->user_self){
		?>
			<li><a class="gren" data-toggle="modal" href="#report-pin">Edit profile </a> </li>
			<li class="divider"></li>
		<?php
		}
		?>				
		<?php
		if($user_info['current_user'] == $this->user_self){
		?>			
			<li><a class="gren" data-toggle="modal" href="#report-pin">View As </a> </li>			
			<li class="buttcen">
				<button type="button" class="btn meoS">log out</button>
			</li>
		<?php
		}
		?>				
			</ul>
			</li>
	
		<!-- END USER LOGIN DROPDOWN --> 
		<!-- BEGIN SEARCH FROM --> 
		<!-- BEGIN SEARCH FROM -->
		</ul>
		</div>
	<div class="tilesp">
		<div class="tilep biggroup hidden-320 hidden-600">
		<div class="tilep imagechanh selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/aoki.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh selected ">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/masculina7.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh selected hidden-620">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/141.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh selected hidden-620">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/bearb.jpg" alt=""> </div>
		</div>
		</div>
		<div class="tilep imageny selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/man.jpg" alt=""> </div>
		</div>
		<div class="tilep biggroup hide-768 hidden-320 hidden-600 hidden-620">
		<div class="tilep imagechanh selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/76719.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh enma selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/050037.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/262.jpg" alt=""> </div>
		</div>
		<div class="tilep imagechanh enma selected">
		<div class="tile-body view-first"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/728.jpg" alt=""> </div>
		</div>
		</div>
	</div>	
	<!--user-->

	<div class="head-info"> 
		<a class="avatar" href="#">
		<img title="Will Hatefbook" src="<?php echo $user_info['avatar'];?>" class="img-responsive" alt="Will Hatefbook"></a>
		<div class="user-text">
		<div class="bguser">
		<h1> <a href="#"><?php echo $user_name;?> (<?php echo $user_gender;?>,<?php echo $user_info['age'];?>)</a> </h1>
		<p>From <?php echo $user_info['users_details']['user_location_country'];?> , <?php echo $user_info['users_details']['user_location_city'];?></p>
		</div>
		</div>
	</div>
	</div>
	<div class="container padd">
		<div class="mika">
		<ul class="user-tabs  tabs">
		<li class="menu ctr-left active">
			<a href="#tab_2_1" data-toggle="tab" class="eletab" onclick="showprofile('1','about');"> About</a>
		</li>
		<li class="menu ctr-left">
			<a href="#tab_2_2" data-toggle="tab" class="eletab" onclick="showprofile('2','catwalk');">catwalk</a>
		</li>
		<li class="menu ctr-left">
			<a href="#tab_2_3" data-toggle="tab" class="eletab" onclick="showprofile('3','ranks');">Stats</a>
		</li>
		<li class="menu ctr-left">
			<a href="#tab_2_4" data-toggle="tab" class="eletab" onclick="showprofile('4','hearts');"><b><?php echo $user_info['profile_hearts_count']; ?></b>
			<?php
			if($user_info['profile_hearts_count']>1){
			?>
				Hearts
			<?php
			}
			else{
			?>
				Heart
			<?php
			}
			?>				

			</a>
		</li>
		<li class="menu ctr-right">
			<a href="#tab_2_7" data-toggle="tab" class="eletab" onclick="showprofile('7','following');"><b><?php echo $user_info['profile_following_count']; ?></b>
				Following</a>
		</li>  
		<li class="menu ctr-right">
			<a href="#tab_2_6" data-toggle="tab" class="eletab" onclick="showprofile('6','followers');"><b><?php echo $user_info['profile_follower_count']; ?></b>
				
			<?php
			if($user_info['profile_follower_count']>1){
			?>
				Followers
			<?php
			}
			else{
			?>
				Follower
			<?php
			}
			?>	
				
			
			</a>
		</li>        
		<li class="menu ctr-right">
			<a href="#tab_2_5" data-toggle="tab" class="eletab" onclick="showprofile('5','friends');"><b><?php echo $user_info['profile_friends_count'];?></b>
				<?php
				if($user_info['profile_friends_count']>1){
				?>
				Friends
				<?php
				}
				else{
				?>
				Friend
				<?php
				}
				?>
			
			</a>
		</li>
		</ul>
		</div>
	</div>
</div>

<div class="row">
<div class="container padd head-tabhead">
<div class="portlet">
<div class="tab-content" data-url="<?php echo Yii::app()->createUrl('profile'); ?>"> 
	<!--tab1 ABOUT-->
	<div class="tab-pane box blue fade active in" id="tab_2_1">		
	</div>
	
	<!--tab2 CATWALK-->
	<div class="tab-pane fade " id="tab_2_2" style="display:block; height:0px; overflow:hidden;">
	</div>

	<!--tab3 STATS-->
	<div class="tab-pane fade" id="tab_2_3" style="display:block; height:0px; overflow:hidden;">		
	</div>

	<!--tab4 HEARTS-->
	<div class="tab-pane fade" id="tab_2_4" style="display:block; height:0px; overflow:hidden;">		
	</div>

	<!--tab5 FRIENDS-->
	<div class="tab-pane fade" id="tab_2_5">		
	</div>

	<!--tab6 Followers-->
	<div class="tab-pane fade" id="tab_2_6">		
	</div>

	<!--tab7 Following-->
	<div class="tab-pane fade" id="tab_2_7">		
	</div>
	<!--END TABS-->	
	
</div><!-- .tab-content  ENDS-->
</div><!-- portlet END -->
</div>
</div><!-- END .row -->

<div class="clearfix"></div>



<!-- Modals--> 
<!-- /.modal  block user-->
<div class="modal fade modal-dialog modal-block-user" id="block-user" data-focus-on="input:first" style="display: none;">
<div class="modal-content">
<div class="modal-body"> 
<!-- BEGIN Block FORM -->
<form class="block-user-form" action="#" method="post">
<h3 class="form-title">Block This User</h3>
<div class="form-group endform">
<div class="col-md-3"> <a href="/will_hatefbook" class="avatar"><img alt="Will Hatefbook" class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/avanta.jpg" title="Will Hatefbook"></a> </div>
<div class="col-md-9">
<p class="help-block-more">Block this User for Messages, Viewing your Content or Following you.</p>
</div>
</div>
</form>
<!-- END Block FORM --> 
</div>
<div class="modal-div">
<div class="divider"></div>
</div>
<div class="modal-footer">
<button type="button" class="btn blue active ok" >Block</button>
<button type="button" class="btn blue back"  data-dismiss="modal">Back</button>
</div>
</div>
<!-- /.modal-content --> 

<!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--modal report-->
<div class="modal fade modal-dialog modal-report-pin" id="report-pin" tabindex="-1" data-focus-on="input:first" aria-hidden="true">
<div class="modal-content">
<div class="modal-body"> 
<!-- BEGIN LOGIN FORM -->
<form class="report-pin-form" action="#" method="post">
<h3 class="form-title">REPORT PIN</h3>
<div class="form-group">
<label class="control-label">Why are you reporting this User?</label>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Spam </label>
</div>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Nudity or Pornography </label>
</div>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Graphic Violance </label>
</div>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Actively promotes self-harm </label>
</div>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Attacs a group or individual </label>
</div>
</div>
<div class="form-group">
<div class="checkbox-list">
<label>
<input type="checkbox">
Hateful speech or symbol</label>
</div>
</div>
<div class="form-group endform">
<div class="checkbox-list">
<label>
<input type="checkbox">
Other</label>
</div>
</div>
</form>
<!-- END LOGIN FORM --> 
</div>
<div class="modal-div">
<div class="divider"></div>
</div>
<div class="modal-footer">
<label>Is this your <strong>Intellectual Property?</strong> </label>
<button type="button" class="btn blue active ok"  >Report</button>
<button type="button" class="btn blue"  data-dismiss="modal">Back</button>
</div>
</div>
<!-- /.modal-content --> 

<!-- /.modal-dialog --> 
</div>
<!--end modal report--> 

<!--modal edit image-->
<div id="edit-image" class="modal modal-scroll fade modal-add-image" tabindex="-1" data-replace="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Edit an image</h4>
</div>
<div class="modal-body">
<div class="portlet-body edit">
<form class="form-horizontal" role="form" action="#">
<div class="row">
<div class="col-md-7 tag">
<div class="form-group">

<select id="form_2_select22" class="form-control select2me" name="options1">
<option value="Option 1">SLOT 1</option>
<option value="Option 2">SLOT 2</option>
<option value="Option 3">SLOT 3</option>
</select>

</div>
<h3>hashtags</h3>
<div class="divider"></div>
<div class="form-group">
<div class="col-md-12 nopaddleft nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" placeholder="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
</div>
<div class="col-md-5">
<div class="usepic boxshadown">
<div class="main-img-user"> 
	<img src="holder.js/260x250/text:Avatar">
	

<div class="mask">
<button class="btn white change" type="button">Upload an Image</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 tag">
<div class="modal-footer">
<button type="button" class="btn blue pull-left">Delete Image</button>
<button type="button" class="btn blue"  data-dismiss="modal">Cancel</button>
<button type="button" class="btn cyan active ok"  >Save Changes</button>
</div>
</div>
</div>
</form>
</div>

<!--part2--> 

</div>
</div>
<!--end modal edit image--> 

<!--modal add image-->
<div id="add-image" class="modal modal-scroll fade modal-add-image" tabindex="-1" data-replace="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Add an image or video</h4>
</div>
<div class="modal-body">
<div class="portlet-body edit">
<div class="row up-data">

<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 nopaddleft nopaddright">
<div class="pc-up">
<a href="#"><i class="fa fa-upload"></i></a>
</div>
</div>
<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 nopaddleft nopaddright">
<div class="fb-up">
<a href="#"><i class="fa fa-facebook"></i></a>
</div>
</div>

<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 nopaddleft nopaddright">
<div class="inst-up">
<a href="#"><i class="fa fa-instagram"></i></a>
</div>
</div>
</div>

</div>

<!--part2--> 

</div>
</div>
<!--end modal add image-->

<!-- long modals -->
<div id="edit-profile" class="modal modal-scroll acc-setting" tabindex="-1" data-replace="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Edit your Profile</h4>
</div>
<div class="modal-body">
<div class="portlet-body edit">
<div class="row">
<div class="col-md-4">
<div class="usepic">
<div class="main-img-user"> <img class="img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gallery/avanta2.jpg">
<div class="mask">
<button class="btn white change" type="button">Change</button>
</div>
</div>
</div>
</div>
<div class="col-md-8">
<div class="form-group maks">
<label class="col-md-3 control-label">SLOGAN</label>
<div class="col-md-9">
<textarea class="form-control" rows="2">I love hang out with Banana</textarea>
<div class="form-actions right">
<button type="submit" class="btn cyan accset">Save</button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 tag">
<form  id="form_sample_2" class="form-horizontal" action="#" role="form" novalidate>
<div class="divider"></div>
<h3>my interests</h3>
<div class="form-group">
<div class="col-md-3 nopaddleft nopaddright">
<label  class="control-label nopaddtop">magazines </label>
<span class="small">which fashion magazine are you reading?</span> </div>
<div class="col-md-9 nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" value="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
<div class="divider"></div>
<div class="form-group">
<div class="col-md-3 nopaddleft nopaddright">
<label  class="control-label nopaddtop">designers & Brands</label>
<span class="small">Who or what are your favorite fashion designers or bands?</span> </div>
<div class="col-md-9 nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" value="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
<div class="divider"></div>
<div class="form-group">
<div class="col-md-3 nopaddleft nopaddright">
<label  class="control-label nopaddtop">SHOPS</label>
<span class="small">where do you shops?</span> </div>
<div class="col-md-9 nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" value="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
<div class="divider"></div>
<div class="form-group">
<div class="col-md-3 nopaddleft nopaddright">
<label  class="control-label nopaddtop">style icons</label>
<span class="small">Who or what are your biggest fashion insporations?</span> </div>
<div class="col-md-9 nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" value="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
<div class="divider"></div>
<div class="form-group">
<div class="col-md-3 nopaddleft nopaddright">
<label  class="control-label nopaddtop">My style</label>
<span class="small">How would you describe your fashion style?</span> </div>
<div class="col-md-9 nopaddright">
<div class="input-group">
<input name="slogan" type="text" class="form-control text-italic" value="Glamour, H&M Magazine, S" >
<span class="input-group-btn">
<button class="btn green flat" type="submit"><i class="icon-plus-sign"></i></button>
</span> </div>
<div class="tagcloud"> <a href="#" class="novato"><i class="icon-remove-sign"></i>Gucci</a> <a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Gucci</a> <a href="#l"><i class="icon-remove-sign"></i>Love</a> <a href="#"><i class="icon-remove-sign"></i>MC</a> <a href="#"><i class="icon-remove-sign"></i>Prada  Maksita</a> <a href="#"><i class="icon-remove-sign"></i>D&amp;G</a><a href="#"><i class="icon-remove-sign"></i>Louis Vuitton</a></div>
</div>
</div>
</form>
</div>
</div>
</div>

<!--part2--> 

</div>
</div>

<!--end- Modals --> 
<!--end- Modals --> 

</div>

<div class="page-quick-sidebar-wrapper">
	<div class="page-sidebar-quick">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
	<li class="sidebar-search-wrapper">
	<form class="sidebar-search" action="extra_search.html" method="POST">
	<a href="javascript:;" class="remove">
	<i class="icon-close"></i>	</a>
	<div class="input-group">
	<input type="text" class="form-control" placeholder="search tag & user">
	<input type="button" class="submit" value="&#xe058;"/>
	</div>
	</form>
	<!-- END RESPONSIVE QUICK SEARCH FORM -->
	</li>
	<li  class="start ">
	<a href="javascript:;">
	<img class="avatar-user img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1.jpg" />
	<span class="name">Chanh Ny</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
	<li>
	<a href="#">
	My profile</a>
	</li>
	<li>
	<a href="#">
	setting</a>
	</li>
	<li>
	<a href="#">
	log out</a>
	</li>
	</ul>
	</li>
	<li>
	<a href="javascript:;">
	<span class="title">Catwalk</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
	<li>
	<a href="#">
	Top member</a>
	</li>
	<li>
	<a href="#">
	Going rival</a>
	</li>
	<li>
	<a href="#">
	New Member</a>
	</li>
	<li>
	<a href="#">
	Monaco</a>
	</li>
	</ul>
	</li>
	<li>
	<a href="#">
	<span class="title">news feed</span>
	</a>
	</li>
	<li class="last ">
	<a href="#">
	<span class="title">blog</span>
	</a>
	</li>
	</ul>
	<!-- END SIDEBAR MENU -->
	</div>
</div>
</div>
<input type="hdden" value="<?php echo $this->current_user_id;?>" id="prof_curr" />
<input type="hdden" value="<?php echo $this->current_profile_id;?>" id="prof_othr" />