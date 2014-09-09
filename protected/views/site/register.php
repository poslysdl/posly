<!--modal sign up-->
<div class="modal fade modal-dialog modal-sign-up" id="sign-up" tabindex="-1" data-focus-on="input:first" aria-hidden="true">
<div class="modal-content">	
<form method="POST" id="register-form" action="#" data-url="<?php echo Yii::app()->createUrl('site/register');?>" class="reg-form">	
	<div class="modal-body"> 
	<!-- BEGIN LOGIN FORM -->
	<h3 class="form-title">SIGN UP WITH EMAILs</h3>
	<div class="form-group">
	<label for="RegisterForm_firstname" class="control-label visible-ie8 visible-ie9 required">First Name <span class="required">*</span></label>	
	<div class="input-icon"> <i class="icon-user"></i>
	<input type="text" id="RegisterForm_firstname" name="RegisterForm[firstname]" tabindex="1" placeholder="First Name" class="form-control placeholder-no-fix" maxlength="200">	
	</div>
	<div style="display:none" id="RegisterForm_firstname_em" class="errorMessage"></div>	
	</div>
	<div class="form-group">
	<label for="RegisterForm_lastname" class="control-label visible-ie8 visible-ie9 required">Last Name <span class="required">*</span></label>	
	<div class="input-icon"> <i class="icon-user"></i>
	<input type="text" id="RegisterForm_lastname" name="RegisterForm[lastname]" tabindex="2" placeholder="Last Name" class="form-control placeholder-no-fix"maxlength="200">	
	</div>
	<div style="display:none" id="RegisterForm_lastname_em" class="errorMessage"></div>	
	</div>
	<div class="form-group">
	<label for="RegisterForm_email" class="control-label visible-ie8 visible-ie9 required">Email <span class="required">*</span></label>	
	<div class="input-icon"> 
	<i class="icon-user"></i>
	<input type="text" id="RegisterForm_email" name="RegisterForm[email]" tabindex="3" placeholder="Email" class="form-control placeholder-no-fix" maxlength="60">	
	</div>
	<div style="display:none" id="RegisterForm_email_em" class="errorMessage"></div>	
	</div>	
	<div class="form-group">
	<label for="RegisterForm_username" class="control-label visible-ie8 visible-ie9 required">User Name <span class="required">*</span></label>	
	<div class="input-icon"> 
	<i class="icon-user"></i>
	<input type="text" maxlength="20" id="RegisterForm_username" name="RegisterForm[username]" tabindex="4" placeholder="User Name" class="form-control placeholder-no-fix"></div>
	<div style="display:none" id="RegisterForm_username_em" class="errorMessage"></div>	
	</div>	
	<div class="form-group">
	<label for="RegisterForm_password" class="control-label visible-ie8 visible-ie9 required">Password <span class="required">*</span></label>	
	<div class="input-icon"> 
	<i class="icon-user"></i>
	<input type="password" maxlength="20" id="RegisterForm_password" name="RegisterForm[password]" tabindex="4" placeholder="Password" class="form-control placeholder-no-fix">	</div>
	<div style="display:none" id="RegisterForm_password_em" class="errorMessage"></div>	
	</div>
	<div class="form-group endform">
	<label for="RegisterForm_re_password" class="control-label visible-ie8 visible-ie9 required">Confirm Password <span class="required">*</span></label>	<div class="input-icon"> <i class="icon-user"></i>
	<input type="password" maxlength="20" id="RegisterForm_re_password" name="RegisterForm[re_password]" tabindex="5" placeholder="Confirm Password" class="form-control placeholder-no-fix">	
	</div>
	<div style="display:none" id="RegisterForm_re_password_em" class="errorMessage"></div>	
	</div>
	<!-- END LOGIN FORM -->
	</div>
	<div class="modal-div">
	<div class="divider"></div>
	</div>
	<div class="modal-footer">
	<label> By creating an account, you confirm that you have read and 
	agree with the <a href="<?php echo Yii::app()->createUrl('site/termsofservice');?>"> Terms of Service </a> 
	</label>
	<input type="button" value="Sign Up" name="yt1" tabindex="6" data-dismiss="model" data-url="<?php echo Yii::app()->createUrl('/site/emailunique');?>" class="btn blue signupbuttondisable" id="signupmail">
	</div>
</form>	
</div>
</div>