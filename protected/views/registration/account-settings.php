<?php
/* The Template page for Registration Step-1# 
** Last Modified: 11-Sept-14
*/
?>
<div class="page-container">
<div class="page-content-3step container padd">
<div class="row">
	<div class="col-md-12"> 
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class="portlet box blue boxshadown">
	<ul class="nav nav-pills steps">
		<li class="done">
			<a data-toggle="tab" class="step" ><span class="number"> Step 1 </span><span class="desc">Update Account Details</span></a>
		</li>
		<li>
			<a data-toggle="tab" class="step" ><span class="number"> Step 2 </span><span class="desc"> Update your Profile</span></a>
		</li>
		<li>
			<a data-toggle="tab" class="step" ><span class="number"> Step 3 </span><span class="desc"> Find your Friends</span></a>
		</li>
		<li>
			<a data-toggle="tab" class="step" ><span class="number"> Step 4 </span><span class="desc">Getting Started</span></a>
		</li>
		<li></li>
	</ul>
	</div>
	<!-- END PAGE TITLE & BREADCRUMB--> 
	</div>
</div>

<div class="errorMessage" align="center"><?php echo $errmsg;?></div>
<form class="form-horizontal" role="form" id="formregstep1" action="<?php echo Yii::app()->createUrl('registration/settings'); ?>" method="POST">
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
		
		<div class="form-group">
			<label  class="col-md-3 control-label">Name <font color="red">*</font></label>
			<div class="col-md-9">
			<div class="input-icon right"> <i class="fa"></i>
			<input type="text" class="form-control" id="firstname" name="firstname" value="<?php 
			if(isset($model->userDetails)) 
			echo $model->userDetails->user_details_firstname; 
			?>" >
			</div>
			<div class="errorMessage myhide"></div>
			</div>
		</div>
		<!--<div class="form-group">
			<label  class="col-md-3 control-label">Last Name</label>
			<div class="col-md-9">
			<div class="input-icon right"> <i class="fa"></i>
			<input type="text" class="form-control" name="lastname" id="lastname" value="<?php 
			//if (isset($model->userDetails))
			//echo $model->userDetails->user_details_lastname; ?>" >
			</div>
			<div class="errorMessage myhide"></div>
			</div>
		</div>-->
		<div class="form-group">
			<label  class="col-md-3 control-label">Email <font color="red">*</font></label>
			<div class="col-md-9">
			<div class="input-icon right"> <i class="fa"></i>
			<input name="email" type="text" class="form-control" id="email" value="<?php 
			if (isset($model->userDetails))
			echo $model->userDetails->user_details_email; ?>" >
			</div>
			<div class="errorMessage myhide"></div>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">Password <font color="red">*</font></label>
			<div class="col-md-9">
			<?php if(empty($model->userDetails->user_details_password)){?>
			<input type="password" name="password" class="form-control" data-flag="y" id="password" maxlength="20">
			<?php } else{?>
			<p class="form-control-static-green paddless"> <a href="#">Change your Password here</a></p>
			<input style="display:none" name="password" type="password" class="form-control"  placeholder="Password" data-flag="n" id="password" maxlength="20">
			<?php } ?>
			<div id="passerr" class="errorMessage myhide"></div>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">DOB <font color="red">*</font></label>
			<div class="col-md-9">
			<div class="input-icon right"> <i class="fa"></i>
			<input name="dob" type="text" id="dob" class="form-control" value="<?php 
			if (isset($model->userDetails))
			echo $model->userDetails->user_details_dob; ?>" />
			</div>
			<div class="errorMessage myhide"></div>
			<span class="help-block-more">Date format: YYYY-MM-DD</span>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">Gender <font color="red">*</font></label>
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
			<div class="errorMessage myhide" id="gendererr"></div>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">Language</label>
			<div class="col-md-9">			
			<?php $value = (isset($model->user_language_id))?$model->user_language_id:''; ?>			
			<select id="form_2_select22" class="form-control custom-combify" name="language">
			<option value="">-</option>
			<?php 
			if(isset($languages)){
			foreach($languages as $et){	
				$selected = ($value==$et->users_language_id)?'selected':'';
			?>			
			<option value="<?php echo $et->users_language_id; ?>" <?php echo $selected;?> ><?php echo $et->users_language_name; ?></option>		
			<?php } } ?>
			</select>
			<p class="lan_error"></p>
			</div>			
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">Country <font color="red">*</font></label>
			<div class="col-md-9">			
			<?php $cnty_val = (isset($model->userLocation->user_location_country))?$model->userLocation->user_location_country:''; ?>			
			<select id="formreg_country" name="country" class="form-control custom-combify">
			<option value="">-</option>
			<?php foreach($country as $cnty) {
				$selected = ($cnty_val==$cnty->country_name)?'selected':'';
			?>
			<option value="<?php echo $cnty->country_name; ?>" data-id="<?php echo $cnty->id; ?>" <?php echo $selected;?>> <?php echo $cnty->country_name; ?></option>
			<?php } ?>
			</select>
			<p class="cnty_error errorMessage" data-url="<?php echo Yii::app()->createUrl('registration/getcity'); ?>"></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Region</label>
			<div class="col-md-9">
			<?php if(isset($model->userLocation->user_location_region)) {$reg_val = $model->userLocation->user_location_region;} else $reg_val="-"; ?>
			<select id="formreg_region" class="form-control custom-combify" name="region">
			<option value="<?php echo $reg_val; ?>"><?php echo $reg_val; ?></option>
			</select>
			<p class="region_error" data-url="<?php echo Yii::app()->createUrl('registration/getcity'); ?>"></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">State</label>
			<div class="col-md-9">
			<?php if(isset($model->userLocation->user_location_state)) {$st_val = $model->userLocation->user_location_state;} else $st_val="-"; ?>
			<select id="formreg_state" class="form-control custom-combify" name="state">
			<option value="<?php echo $st_val; ?>"><?php echo $st_val; ?></option>
			</select>
			<p class="state_error" data-url="<?php echo Yii::app()->createUrl('registration/getcity'); ?>"></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">City <font color="red">*</font></label>
			<div class="col-md-9">
			<?php if(isset($model->userLocation->user_location_city)) {$city_val = $model->userLocation->user_location_city;} else $city_val="-"; ?>
			<select id="formreg_city" class="form-control custom-combify" name="city">
			<option value="<?php echo $city_val; ?>"><?php echo $city_val; ?></option>
			</select>
			<p class="city_error errorMessage" data-url="<?php echo Yii::app()->createUrl('registration/getcity'); ?>"></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Etnicity <font color="red">*</font></label>
			<div class="col-md-9">	
			<?php $et_val =(isset($model->user_ethnicity_id))?$model->user_ethnicity_id:''; ?>		
			<select id="form_2_select2222" class="form-control custom-combify" name="etnicity">
			<option value="">-</option>
			<?php 
			if(isset($ethnicity)){
			foreach($ethnicity as $et){	
				$selected = ($et_val==$et->users_ethnicity_id)?'selected':'';
			?>			
			<option value="<?php echo $et->users_ethnicity_id; ?>" <?php echo $selected;?> ><?php echo $et->users_ethnicity_name; ?></option>		
			<?php } } ?>
			</select>		
			<p class="ethi_error errorMessage"></p>
			</div>
		</div>		
		<div class="form-group">
			<label  class="col-md-3 control-label">Page Name <font color="red">*</font></label>
			<!--<div class="col-md-2">
			<span class="help-block-more">http://www.Posly.com/</span> SimonKing25
			</div>-->
			<div class="col-md-7">
			<div class="input-icon right"> <i class="fa"></i>
			<?php 
			$checked = '';
			$checked = (isset($model->userDetails->user_unique_url))?$model->userDetails->user_unique_url:'';			
			?>
			<input type="text" id="userurl" class="form-control" id="url" value="<?php echo $checked;?>" name="url" maxlength="40"/>
			</div>
			<p id="urlerror" class="errorMessage"></p>
			<div class="username_preview">
				<span class="help-block-more urlc">http://www.Posly.com/<strong>SimonKing25</strong></span>
				<small class="field-check valid" id="username-check" style="display:none;"><span>verifying..</span></small>
				<small class="field-check" id="maxchar" style="display:block;"><span>Max 40 Chars.</span></small>
			</div>
			</div>						
			</div>
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>	
	
	<!--dfd-->
	<div class="row">
		<div class="col-md-12"> 
		<!--card1-->
		<div class="portlet box blue boxshadown">
		<div class="portlet-title">
		<div class="caption">
		<div class="cap1">
		<h3>Privacy</h3>
		</div>
		</div>
		<button class="btn white pull-right">Show blocked Users</button>
		</div>
		<div class="portlet-body form">
		<div class="form-body">				
		<div class="form-group">
			<label  class="col-md-3 control-label">Who can message me</label>
			<div class="col-md-9">
			<ul class="checkbox-list">
			<li>
			<div class="pull-left needmar" data-on="danger" data-off="default" data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userSecurity->whocansee) && $model->userSecurity->whocansee == 1)?'checked':'';			
			?>
			<input type="radio"  class="toggle" value="1" name="messageme" <?php echo $checked; ?> />
			</div>
			<p class="help-block-more">Everybody</p>
			</li>
			<li>
			<div class=" pull-left needmar" data-on="danger" data-off="default" data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userSecurity->whocansee) && $model->userSecurity->whocansee == 2)?'checked':'';			
			?>
			<input type="radio" class="toggle" value="2" name="messageme" <?php echo $checked; ?> />
			</div>
			<p class="help-block-more">Follower</p>
			</li>
			<li>
			<?php 
			$checked = '';
			$checked = (isset($model->userSecurity->whocansee) && $model->userSecurity->whocansee == 3)?'checked':'';			
			?>
			<div class=" pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<input type="radio" class="toggle" value="3" name="messageme" <?php echo $checked; ?>/>
			</div>
			<p class="help-block-more">Nobody</p>
			</li>
			</ul>
			</div>
		</div>
		<div class="form-group">
			<label  class="col-md-3 control-label">Search Privacy</label>
			<div class="col-md-9">
			<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userDetails->searchprivacy) && $model->userDetails->searchprivacy == 1)?'checked':'';			
			?>
			<input type="checkbox" name="search" id="search_privacy" value="1" class="toggle" <?php echo $checked; ?> />
			</div>
			<p class="help-block-more">Keep search engines (e.g. Google) from showing your Posly profile in search results</p>
			</div>
		</div>
		</div>
		</div>
		<!--sadas--> 
		</div>
		</div>
	</div>	
	
	<!--cvc-->
	<div class="row">
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
		<?php 
		$checked = '';
		$checked = (isset($model->userNotification->user_notification_on) && $model->userNotification->user_notification_on == 1)?'checked':'';		
		?>
		<div class="make-switch pull-left needmar" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
		<input type="checkbox" id="email_notify" name="email_notify" value="1" class="toggle" <?php echo $checked;?> />
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
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_like_pic) && $model->userNotification->user_like_pic == 1)?'checked':'';		
			?>
			<input type="checkbox" id="like_pic" value="1" name="like_pic" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Likes a Picture</p>
			</div>
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_follow_pic) && $model->userNotification->user_follow_pic == 1)?'checked':'';		
			?>
			<input type="checkbox" name="follow_you" value="1" id="follow_you" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Follows you</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_comment_pic) && $model->userNotification->user_comment_pic == 1)?'checked':'';		
			?>
			<input type="checkbox" name="comment_pic" value="1" id="cmt_pic" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Comments on a Picture</p>
			</div>
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_sent_msg) && $model->userNotification->user_sent_msg == 1)?'checked':'';		
			?>
			<input type="checkbox" name="sent_msg" id="sent_msg" value="1" class="toggle" <?php echo $checked;?> />
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
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_week_newsletter) && $model->userNotification->user_week_newsletter == 1)?'checked':'';		
			?>
			<input type="checkbox" name="week_newsletter" id="week_newsletter" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Weekly Newsletter</p>
			</div>
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_feature_announce) && $model->userNotification->user_feature_announce == 1)?'checked':'';		
			?>
			<input type="checkbox" name="featannounce" id="fea_ann_upd" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Feature announcements ans updates</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_week_inspiration) && $model->userNotification->user_week_inspiration == 1)?'checked':'';		
			?>
			<input type="checkbox" name="week_inspiration" id="week_inspiration" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Weekly Inspiration</p>
			</div>
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_invitation_fb) && $model->userNotification->user_invitation_fb == 1)?'checked':'';		
			?>
			<input type="checkbox" name="invi_feed" id="invi_feed" value="1" class="toggle" <?php echo $checked;?>/>
			</div>
			<p class="help-block-more2">Invitation to give us feedback</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_weekly_pic) && $model->userNotification->user_weekly_pic == 1)?'checked':'';		
			?>
			<input type="checkbox" name="pic_of_week" id="pic_of_week" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Picture of the week</p>
			</div>
			<div class="col-md-6">
			<div class="make-switch pull-left needmar2" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userNotification->user_someone_fb) && $model->userNotification->user_someone_fb == 1)?'checked':'';		
			?>
			<input type="checkbox" name="someone_fb" id="someon_on_fb" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			<p class="help-block-more2">Someone of you FB friends join Posly</p>
			</div>
		</div>
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>
	<!--sdas-->	
	<div class="row">
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
			<div class="col-md-3 ctlmbile">
			<label class="control-label">
			Facebook User Name
			</label>
			</div>
			<div class="col-md-3 ctlmbile2">
			<?php 
			$checked = '';
			$checked = (isset($model->userDetails->user_unique_url))?$model->userDetails->user_unique_url:'';			
			?>
			<input type="text" class="form-control" name="fbusername" id="fbusername" value="<?php echo $checked;?>">
			</div>
			<div class="col-md-2 ctlmbile2">
			<?php if(empty($model->user_socialmedia_id)){ ?>
			<button id="connectfb" class="btn white active pull-left needmar fix80" href="javascript:void(0);">Connected</button>
			<?php } ?>
			</div>
		</div>
		<div class="clearboth"></div>
		<div class="form-group nhommang1">
			<label  class="col-md-2 control-label hidden-320 hidden-480 hidden-600 hidden-620" ></label>
			<div class="do-mobile">
			<div class="col-md-2">
			<div class="make-switch pull-left" data-on="danger" data-off="default"  data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userSocialPrivacy->user_i_like) && $model->userSocialPrivacy->user_i_like == 1)?'checked':'';		
			?>
			<input type="checkbox" name="fb_like" id="fb_like" value="1" class="toggle" <?php echo $checked;?> />
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
			<?php 
			$checked = '';
			$checked = (isset($model->userSocialPrivacy->user_i_upload) && $model->userSocialPrivacy->user_i_upload == 1)?'checked':'';		
			?>
			<input type="checkbox" name="fb_upload" id="fb_upload" value="1" class="toggle" <?php echo $checked;?> />
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
			<?php 
			$checked = '';
			$checked = (isset($model->userSocialPrivacy->user_comment) && $model->userSocialPrivacy->user_comment == 1)?'checked':'';		
			?>
			<input type="checkbox" name="fb_comment" id="fb_comment" value="1" class="toggle" <?php echo $checked;?> />
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
			<div class="make-switch pull-left" data-on="danger" data-off="default" data-label-icon="icon-reorder">
			<?php 
			$checked = '';
			$checked = (isset($model->userSocialPrivacy->user_albums_fav) && $model->userSocialPrivacy->user_albums_fav == 1)?'checked':'';		
			?>
			<input type="checkbox" name="fb_favour" id="fb_favour" value="1" class="toggle" <?php echo $checked;?> />
			</div>
			</div>
			<div class="col-md-3">
			<label class="control-label">
			Albums I favourite
			</label>
			</div> 
			</div>
		</div>		
		<!-- comented code  -->
		<!--sdf-->
		</div>
		<!--sds--> 
		</div>
		</div>
		</div>
	</div>	
	<!--end-->	
</div>
</div> <!-- page-content-wrapper ENDS -->
	
<div class="page-sidebar-wrapper"> 
	<div class="page-sidebar-button">
	<div class="btton-fix">
	<ul class="page-sidebar-menu marktop">
	<li>
	<Input type="button" value="Save" class="btn cyan accset accset_save" >
	</li>
	<li> <!--/registration/secondstep-->
	<button type="button" class="btn white accset step1cancel" >Cancel</button>
	</li>
	<?php if($stepflag=='y'){ ?>
	<li>
	<button type="button" class="btn white accset step1skip" >Next Step</button>	
	</li>
	<?php } ?>
	</ul>
	</div>
	</div>
</div>
</form>

</div>
</div>