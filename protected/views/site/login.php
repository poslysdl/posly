<div class="modal fade modal-sign-in" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">
<div class="modal-body">
	<form method="POST" action="#" id="login-form" onsubmit="return false;" class="reg-form">
	<h3 class="form-title">SIGN IN WITH YOUR EMAILID</h3>
	<div class="form-group">
		<label for="LoginForm_email" class="control-label visible-ie8 visible-ie9 required">Email <span class="required">*</span></label>		
		<div class="input-icon"> <i class="icon-user"></i>
		<input type="text" id="LoginForm_email" name="LoginForm[email]" placeholder="Email" class="form-control placeholder-no-fix" >		
		</div>
		<div style="display:none" id="LoginForm_email_em_" class="errorMessage">
		</div>	
	</div>
	<div class="form-group">
		<label for="LoginForm_password" class="control-label visible-ie8 visible-ie9 required">Password <span class="required">*</span>
		</label>		
		<div class="input-icon"> <i class="icon-key"></i>
		<input type="password" id="LoginForm_password" name="LoginForm[password]" placeholder="Password" class="form-control placeholder-no-fix">		
		</div>
		<div class="errorMessage" id="lerrormsg" style="display:block;color:red;margin-top:3px;"></div>
	</div>
	<div class="form-group endform">
		<div class="checkbox-list">
		<input type="hidden" name="LoginForm[rememberMe]" value="0" id="ytLoginForm_rememberMe">
		<div class="checker" id="uniform-LoginForm_rememberMe"><span>
		<input type="checkbox" value="1" id="LoginForm_rememberMe" name="LoginForm[rememberMe]">
		</span>
		</div>		
		<label for="LoginForm_rememberMe">Remember me next time</label>		
		<div style="display:none" id="LoginForm_rememberMe_em_" class="errorMessage"></div>		
		<span class="text-right"> <a href="#">Forgot Password</a></span>
		</div>
	</div>
	<div class="modal-div">
		<div class="divider"></div>
	</div>
	<div class="modal-footer">
		<label> Need an account? <a href="#sign-up" data-toggle="modal"> Sign Up</a> </label>
		<input type="button" value="SUBMIT" name="yt0" data-url="<?php echo Yii::app()->createUrl('/site/login');?>" data-dismiss="model" class="btn blue" onclick="signInByEmail();">          
	</div>
	</form>
</div>
</div>
</div><!-- form -->