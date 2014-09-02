<div class="page-container">
<div class="page-content-3step container padd">
<div class="row">
	<div class="col-md-12"> 
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class="portlet box blue boxshadown">
	<ul class="nav nav-pills steps">
	<li class="done"> <a  data-toggle="tab" class="step" > <span class="number"> Step 1 </span> <span class="desc">Update Account Details</span> </a> </li>
	<li> <a  data-toggle="tab" class="step" ><span class="number"> Step 2 </span> <span class="desc"> Update your Profile </span> </a> </li>
	 <li> <a  data-toggle="tab" class="step" ><span class="number"> Step 3 </span> <span class="desc"> Find your Friends  </span> </a> </li>
	<li> <a  data-toggle="tab" class="step" > <span class="number"> Step 4 </span> <span class="desc">Getting Started </span> </a> </li>
	<li></li>
	</ul>
	</div>
	<!-- END PAGE TITLE & BREADCRUMB--> 
	</div>
</div>

<form class="form-horizontal" role="form" id="form_sample_2" action="#">
<div class="page-content-wrapper">
<div class="page-content-accs">
	<div class="row ">
		<div class="col-md-12">
		<!--card1-->
		<div class="portlet box blue boxshadown">
		<div class="portlet-title">
		<div class="caption">
		<div class="cap1">
		<h3>Basic Info</h3>
		</div>
		</div>
		</div>
		<div class="portlet-body form">
		<div class="form-body">
		<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		You have some form errors. Please check below. </div>
		<div class="alert alert-success display-hide">
		<button class="close" data-close="alert"></button>
		Your form validation is successful! </div>
		<?php //print_r($modelUserDetails	); ?>
		<?php //print_r($modelUserNotify); ?>
		<?php //print_r($modelUsersSecurity); ?>
		<div class="form-group">
		<label  class="col-md-3 control-label">First Name</label>
		<div class="col-md-9">
		<div class="input-icon right"> <i class="fa"></i>
		<input type="text" class="form-control" id="firstname" name="firstname" value="<?php 
		if(isset($model->userDetails)) 
		echo $model->userDetails->user_details_firstname; 
		?>" >
		</div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Last Name</label>
		<div class="col-md-9">
		<div class="input-icon right"> <i class="fa"></i>
		<input type="text" class="form-control" name="lastname" id="lastname" value="<?php 
		if (isset($model->userDetails))
		echo $model->userDetails->user_details_lastname; ?>" >
		</div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Email</label>
		<div class="col-md-9">
		<div class="input-icon right"> <i class="fa"></i>
		<input name="email" type="text" class="form-control" id="email" value="<?php 
		if (isset($model->userDetails))
		echo $model->userDetails->user_details_email; ?>" >
		</div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Password</label>
		<div class="col-md-9">
		<p class="form-control-static-green paddless"> <a href="#">Change your Password here</a></p>
		<input style="display:none" type="password" class="form-control"  placeholder="Password">
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">DOB</label>
		<div class="col-md-9">
		<div class="input-icon right"> <i class="fa"></i>
		<input name="dob" type="text" id="dob" class="form-control" value="<?php 
		if (isset($model->userDetails))
		echo $model->userDetails->user_details_dob; ?>" />
		</div>
		<span class="help-block-more">Date format: YYYY-MM-DD</span>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Gender</label>
		<div class="col-md-9">
		<div class="col-md-3">
		<div class="pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="radio"  value="1" <?php 
		if (isset($model->userDetails))
		if ($model->userDetails->user_details_gender == 1) echo 'checked' ?> class="toggle" name="gender"/>
		</div>
		<p class="help-block-more">Male</p>
		</div>
		<div class="col-md-3">
		<div class=" pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="radio"  value="2" <?php 
		if (isset($model->userDetails))
		if ($model->userDetails->user_details_gender == 2) echo 'checked' ?> class="toggle" name="gender"/>
		</div>
		<p class="help-block-more">Female</p>
		</div>
		<!--  <div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		< ? php 
		if ($modelUserDetails->user_details_gender == 1) {
		$gender = "checked";  
		} else {
		$gender = "unchecked";	
		}
		?>
		<input type="checkbox" name="gender" <?php //echo $gender;  ?> class="toggle" id="toggle-state-switch"  />
		</div>
		<p class="help-block-more">On for male and Off for female</p>-->
		</div>
		</div>

		<div class="form-group">
		<label  class="col-md-3 control-label">Language</label>
		<div class="col-md-9">
		<?php if (isset($model->userLanguage)) {$value = $model->userLanguage->users_language_name;} else $value=""; ?>
		<select id="form_2_select22" class="form-control custom-combify" name="language">
		<option><?php echo $value; ?></option>
		<option>English</option>
		<option>Chinese</option>
		<option>Kazumi</option>
		<option>Japan</option>
		</select>
		<p class="lan_error"></p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Country</label>
		<div class="col-md-9">
		<?php if (isset($model->userLocation->user_location_country)) {$cnty_val = $model->userLocation->user_location_country;} else $cnty_val=""; ?>
		<select  id="form_2_select2" name="country" class="form-control custom-combify">
		<option><?php echo $cnty_val; ?></option>
		<?php foreach ($country as $cnty) { ?>
		<option value="<?php echo $cnty->country_name; ?>"> <?php echo $cnty->country_name; ?></option>
		<?php } ?>
		</select>
		<p class="cnty_error"></p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Region</label>
		<div class="col-md-9">
		<?php if (isset($model->userLocation->user_location_region)) {$reg_val = $model->userLocation->user_location_region;} else $reg_val=""; ?>
		<select id="form_2_selectregion" class="form-control custom-combify" name="region">
		<option><?php echo $reg_val; ?></option>
		<option value="Option 1">Kasovo</option>
		<option value="Option 2">Mosota</option>
		<option value="Option 3">Kazumi</option>
		<option value="Option 4">Japan</option>
		</select>
		<p class="region_error"></p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">State</label>
		<div class="col-md-9">
		<?php if (isset($model->userLocation->user_location_state)) {$st_val = $model->userLocation->user_location_state;} else $st_val=""; ?>
		<select id="form_2_selectstate" class="form-control custom-combify" name="state">
		<option><?php echo $st_val; ?></option>
		<option value="Option 1">Kasovo</option>
		<option value="Option 2">Mosota</option>
		<option value="Option 3">Kazumi</option>
		<option value="Option 4">Japan</option>
		</select>
		<p class="state_error"></p>
		</div>
		</div>

		<div class="form-group">
		<label  class="col-md-3 control-label">City</label>
		<div class="col-md-9">
		<?php if (isset($model->userLocation->user_location_city)) {$city_val = $model->userLocation->user_location_city;} else $city_val=""; ?>
		<select id="form_2_select222" class="form-control custom-combify" name="city">
		<option><?php echo $city_val; ?></option>
		<option value="Option 1">Kasovo</option>
		<option value="Option 2">Mosota</option>
		<option value="Option 3">Kazumi</option>
		<option value="Option 4">Japan</option>
		</select>
		<p class="city_error"></p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Etnicity</label>
		<div class="col-md-9">
		<?php if (isset($model->userEthnicity->users_ethnicity_name)) {$et_val = $model->userEthnicity->users_ethnicity_name;} else $et_val=""; ?>
		<select id="form_2_select2222" class="form-control custom-combify" name="etnicity">
		<option><?php echo $et_val; ?></option>
		<option value="Option 1">-</option>
		<option value="Option 2">-</option>
		<option value="Option 3">Kazumi</option>
		<option value="Option 4">Japan</option>
		</select>
		<p class="ethi_error"></p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Search Privacy</label>
		<div class="col-md-9">
		<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" <?php 

		if (isset($model->userDetails->searchprivacy))
		if ($model->userDetails->searchprivacy == 1) echo 'checked'; ?> id="search_privacy" name="privacy"  class="toggle" />
		</div>
		<p class="help-block-more">Keep search engines (e.g. Google) from showing your 2Pretty profile in search results</p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Unique URL</label>
		<div class="col-md-2">
		<span class="help-block-more">http://www.2pretty.com/</span>
		</div>
		<div class="col-md-7">
		<div class="input-icon right"> <i class="fa"></i>
		<input type="text" class="form-control" id="url" value="<?php  
		if (isset($model->userDetails->user_unique_url))
		echo $model->userDetails->user_unique_url ?>" name="url"/>
		</div>

		<span class="help-block-more">e.g: <strong>SimonKing25</strong>, <strong>Rosejane25</strong>, <strong>king-25</strong></span> </div>
		<div class="url_msg"></div>
		</div>
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>	
	<!--dfd-->
	<div class="row ">
		<div class="col-md-12"> 
		<!--card1-->
		<div class="portlet box blue boxshadown">
		<div class="portlet-title">
		<div class="caption">
		<div class="cap1">
		<h3>Privacy</h3>
		</div>
		</div>
		<button  class="btn white pull-right" >Show blocked Users</button>
		</div>
		<div class="portlet-body form">
		<div class="form-body">
		<!-- <div class="form-group">
		<label  class="col-md-3 control-label">Hide Profile on the search</label>
		<div class="col-md-9">
		<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" checked class="toggle"/>
		</div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Activate Autotagging</label>
		<div class="col-md-9">
		<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox"  class="toggle"/>
		</div>
		<p class="help-block-more">Ethnicity</p>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Can be tagged by other user</label>
		<div class="col-md-9">
		<div class="make-switch" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" checked class="toggle"/>
		</div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>-->
		<div class="form-group">
		<label  class="col-md-3 control-label">Who can message me</label>
		<div class="col-md-9">
		<ul class="checkbox-list">
		<li>
		<div class="pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="radio"  class="toggle" value="1" <?php 

		if (isset($model->userSecurity->whocansee)) {
		if ($model->userSecurity->whocansee == 1)
		echo 'checked';

		} else { echo 'checked';}
		?> name="messageme"/>
		</div>
		<p class="help-block-more">Everybody</p>
		</li>
		<li>
		<div class=" pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="radio"  class="toggle" value="2" <?php
		if (isset($model->userSecurity->whocansee)) {
		if ($model->userSecurity->whocansee == 2)
		echo 'checked';
		} 
		?> name="messageme"/>
		</div>
		<p class="help-block-more">Follower</p>
		</li>
		<li>
		<div class=" pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="radio"  class="toggle" value="3" <?php 
		if (isset($model->userSecurity->whocansee)) {
		if ($model->userSecurity->whocansee == 3)
		echo 'checked';
		} 
		?> name="messageme"/>
		</div>
		<p class="help-block-more">Nobody</p>
		</li>
		</ul>
		</div>
		</div>
		</div>
		</div>
		<!--sadas--> 
		</div>
		</div>
	</div>	
	<!--cvc-->
	<div class="row ">
		<div class="col-md-12"> 
		<!--card1-->
		<div class="portlet box blue boxshadown">
		<div class="portlet-title">
		<div class="caption">
		<div class="cap1">
		<h3>Email Notifications</h3>
		</div>
		</div>
		</div>
		<div class="portlet-body form">
		<div class="form-body">
		<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		You have some form errors. Please check below. </div>
		<div class="alert alert-success display-hide">
		<button class="close" data-close="alert"></button>
		Your form validation is successful! </div>
		<div class="form-group">
		<label  class="col-md-3 control-label">Email Notifications</label>
		<div class="col-md-9">
		<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="email_notify" 
		<?php if (isset($model->userNotification->user_notification_on)){
		if ($model->userNotification->user_notification_on == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-12 control-label">Recieve an Email when someone</label>
		</div>
		<div class="form-group">
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="like_pic" <?php if (isset($model->userNotification->user_like_pic)){
		if ($model->userNotification->user_like_pic == 1) echo 'checked';
		} ?>   class="toggle"/>
		</div>
		<p class="help-block-more2">Likes a Picture</p>
		</div>
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox"  id="follow_you" <?php if (isset($model->userNotification->user_follow_pic)){
		if ($model->userNotification->user_follow_pic == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		<p class="help-block-more2">Follows you</p>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox"  id="cmt_pic" <?php if (isset($model->userNotification->user_comment_pic)){
		if ($model->userNotification->user_comment_pic == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		<p class="help-block-more2">Comments on a Picture</p>
		</div>
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox"  id="sent_msg" <?php if (isset($model->userNotification->user_sent_msg)){
		if ($model->userNotification->user_sent_msg == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		<p class="help-block-more2">Sends a message</p>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<label  class="col-md-12 control-label">Recieve an Email when someone</label>
		</div>
		<div class="form-group">
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="week_newsletter" <?php if (isset($model->userNotification->user_week_newsletter)){
		if ($model->userNotification->user_week_newsletter == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		<p class="help-block-more2">Weekly Newsletter</p>
		</div>
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="fea_ann_upd"  <?php if (isset($model->userNotification->user_feature_announce)){
		if ($model->userNotification->user_feature_announce == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		<p class="help-block-more2">Feature announcements ans updates</p>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="week_inspiration"  <?php if (isset($model->userNotification->user_week_inspiration)){
		if ($model->userNotification->user_week_inspiration == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		<p class="help-block-more2">Weekly Inspiration</p>
		</div>
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="invi_feed" <?php if (isset($model->userNotification->user_invitation_fb)){
		if ($model->userNotification->user_invitation_fb == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		<p class="help-block-more2">Invitation to give us feedback</p>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="pic_of_week" <?php if (isset($model->userNotification->user_weekly_pic)){
		if ($model->userNotification->user_weekly_pic == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		<p class="help-block-more2">Picture of the week</p>
		</div>
		<div class="col-md-6">
		<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="someon_on_fb" <?php if (isset($model->userNotification->user_someone_fb)){
		if ($model->userNotification->user_someone_fb == 1) echo 'checked';
		} ?>  class="toggle"/>
		</div>
		<p class="help-block-more2">Someone of you FB friends join 2Pretty</p>
		</div>
		</div>
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>
	<!--sdas-->
	<div class="row ">
		<div class="col-md-12"> 
		<!--card1-->
		<div class="portlet box blue boxshadown">
		<div class="portlet-title">
		<div class="caption">
		<div class="cap1">
		<h3>Social Sharing</h3>
		</div>
		</div>
		</div>
		<div class="portlet-body form">
		<div class="form-body">
		<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		You have some form errors. Please check below. </div>
		<div class="alert alert-success display-hide">
		<button class="close" data-close="alert"></button>
		Your form validation is successful! </div>
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-facebook-sign"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		Facebook
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white active pull-left needmar fix130" href="#">Connected</button>
		</div>
		</div>
		<div class="form-group nhommang1">
		<label  class="col-md-2 control-label hidden-320 hidden-480 hidden-600 hidden-620" ></label>
		<div class="do-mobile">
		<div class="col-md-2">
		<div class="make-switch pull-left" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="fb_like" <?php if (isset($model->userSocialPrivacy->user_i_like)){
		if ($model->userSocialPrivacy->user_i_like == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		</div>
		<div class="col-md-3">
		<label class="control-label">
		Photos I Like
		</label>
		</div>
		</div>
		<div class="do-mobile">
		<div class="col-md-2">
		<div class="make-switch pull-left" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="fb_upload" <?php if (isset($model->userSocialPrivacy->user_i_upload)){
		if ($model->userSocialPrivacy->user_i_upload == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		</div>

		<div class="col-md-3">
		<label class="control-label">
		Photos I Upload
		</label>
		</div> 
		</div> 
		</div>
		<div class="form-group nhommang1">
		<label  class="col-md-2 control-label hidden-320 hidden-480 hidden-600 hidden-620" ></label>
		<div class="do-mobile">
		<div class="col-md-2">
		<div class="make-switch pull-left" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="fb_comment" <?php if (isset($model->userSocialPrivacy->user_comment)){
		if ($model->userSocialPrivacy->user_comment == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		</div>
		<div class="col-md-3">
		<label class="control-label">
		Comments I make
		</label>
		</div>
		</div>
		<div class="do-mobile">
		<div class="col-md-2">
		<div class="make-switch pull-left" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="fb_favour" <?php if (isset($model->userSocialPrivacy->user_albums_fav)){
		if ($model->userSocialPrivacy->user_albums_fav == 1) echo 'checked';
		} ?> class="toggle"/>
		</div>
		</div>
		<div class="col-md-3">
		<label class="control-label">
		Albums I favourite
		</label>
		</div> 
		</div>
		</div>
		
		<!--   <div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<!--diver--
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-twitter-sign"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		Twitter
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white pull-left needmar fix130" href="#">Connect</button>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-2">
		<label class="control-label">
		Profile Link
		</label>
		</div>
		<div class="col-md-8">
		<input type="text" class="form-control" value="http://" name="url"/>
		</div>
		</div>
		<!--df--
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<!--diver--
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-google-plus-sign"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		Google +
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white pull-left needmar fix130" href="#">Connect</button>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-2">
		<label class="control-label">
		Profile Link
		</label>
		</div>
		<div class="col-md-8">
		<input type="text" class="form-control" value="http://" name="url"/>
		</div>
		</div>
		<!--df--
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<!--diver--
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-instagram"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		Instagram
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white pull-left needmar fix130" href="#">Connect</button>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-2">
		<label class="control-label">
		Profile Link
		</label>
		</div>
		<div class="col-md-8">
		<input type="text" class="form-control" value="http://" name="url"/>
		</div>
		</div>
		<!--sdf--
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<!--diver--
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-pinterest-sign"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		Pinterest
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white pull-left needmar fix130" href="#">Connect</button>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-2">
		<label class="control-label">
		Profile Link
		</label>
		</div>
		<div class="col-md-8">
		<input type="text" class="form-control" value="http://" name="url"/>
		</div>
		</div>
		<!--sdf--
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<!--diver--
		<div class="form-group nhommang">
		<label  class="col-md-2 control-label"><i class="icon-vk"></i></label>
		<div class="col-md-2 ctlmbile">
		<label class="control-label">
		VK
		</label>
		</div>
		<div class="col-md-8 ctlmbile2">
		<button class="btn white pull-left needmar fix130" href="#">Connect</button>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-2">
		<label class="control-label">
		Profile Link
		</label>
		</div>
		<div class="col-md-8">
		<input type="text" class="form-control" value="http://" name="url"/>
		</div>
		</div>
		<!--sdf-->
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>
	<!--end-->
	<!--  <div class="row ">
	<div class="col-md-12"> 
	<div class="portlet botedit">
	<div class="portlet-title">
	<button href="#"  class="btn white pull-right" >Deactivate Account</button>
	</div>
	</div>
	</div>
	</div>-->
</div>
</div> <!-- page-content-wrapper ENDS -->
	
<div class="page-sidebar-wrapper">     
	<div class="page-sidebar-button">
	<div class="btton-fix">
	<ul class="page-sidebar-menu marktop">
	<li>
	<button type="submit"  class="btn cyan accset accset_save" >Save</button> 
	</li>
	<li> <!--/registration/secondstep-->
	<button type="button" class="btn white accset" onclick="window.location='<?php echo Yii::app()->createAbsoluteUrl('/site/logout'); ?>'" >Cancel</button>
	</li>
	</ul>
	</div>
	</div>
</div>
</form>

</div>
</div>