<div class="modal fade modal-sign-in" id="forgetpasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">
<div class="modal-body">
	<form method="POST" action="#" id="forgetpassword-form" onsubmit="return false;" class="reg-form">
	<h3 class="form-title">Forget Password</h3>
	<div class="form-group">
		<label for="ForgetpasswordForm_email" class="control-label visible-ie8 visible-ie9 required">Email <span class="required">*</span></label>		
		<div class="input-icon"> <i class="icon-user"></i>
		<input type="text" id="ForgetpasswordForm_email" name="ForgetpasswordForm[email]" placeholder="Email" class="form-control placeholder-no-fix" >		
		</div>
		<div id ="forgot_password_loader" class="loader" style="display:none"></div>
		<div style="display:none" id="ForgetpasswordForm_email_em_" class="errorMessage">
		</div>	
	</div>
	<div class="modal-div">
		<div class="divider"></div>
	</div>
	<div class="modal-footer">
		<input type="button" id="forgetmail" value="SUBMIT" name="yt0" data-url="<?php echo Yii::app()->createUrl('/site/forgetpassword');?>" data-dismiss="model" class="btn blue">          
	</div>
	</form>
</div>
</div>
</div><!-- form -->