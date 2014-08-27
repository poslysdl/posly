<!--modal sign up-->
<div class="modal fade modal-dialog modal-sign-up" id="sign-up" tabindex="-1" data-focus-on="input:first" aria-hidden="true">
	<div class="modal-content">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'action'=>Yii::app()->createUrl('site/register'),
	'enableAjaxValidation'=>true,
	/*'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),*/
	'htmlOptions'=> array('class'=>'reg-form')
	)); ?>
	<div class="modal-body"> 
		<!-- BEGIN LOGIN FORM -->
		<h3 class="form-title">SIGN UP WITH EMAIL...</h3>
		<div class="form-group">
		<?php echo $form->labelEx($model,'firstname', array('class'=>'control-label visible-ie8 visible-ie9')); ?>
		<div class="input-icon"> <i class="icon-user"></i>
		<?php echo $form->textField($model,'firstname', 
		array('class'=>'form-control placeholder-no-fix', 'placeholder'=>'First Name', 'tabindex'=>1)); 
		?>
		</div>
		<?php echo $form->error($model,'firstname'); ?>
		</div>
		<div class="form-group">
		<?php echo $form->labelEx($model,'lastname', 
		array('class'=>'control-label visible-ie8 visible-ie9')); 
		?>
		<div class="input-icon"> <i class="icon-user"></i>
		<?php echo $form->textField($model,'lastname', 
		array('class'=>'form-control placeholder-no-fix', 'placeholder'=>'Last Name', 'tabindex'=>2)); 
		?>
		</div>
		<?php echo $form->error($model,'lastname'); ?>
		</div>
		<div class="form-group">
		<?php echo $form->labelEx($model,'email', 
		array('class'=>'control-label visible-ie8 visible-ie9')); 
		?>
		<div class="input-icon"> 
		<i class="icon-user"></i>
		<?php echo $form->textField($model,'email', 
		array('class'=>'form-control placeholder-no-fix', 'placeholder'=>'Email', 'tabindex'=>3)); 
		?>
		</div>
		<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="form-group">
		<?php echo $form->labelEx($model,'password', 
		array('class'=>'control-label visible-ie8 visible-ie9')); 
		?>
		<div class="input-icon"> 
		<i class="icon-user"></i>
		<?php echo $form->passwordField($model,'password', 
		array('class'=>'form-control placeholder-no-fix', 'placeholder'=>'Password', 'tabindex'=>4)); 
		?>
		</div>
		<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="form-group endform">
		<?php echo $form->labelEx($model,'re_password', array('class'=>'control-label visible-ie8 visible-ie9')); ?>
		<div class="input-icon"> <i class="icon-user"></i>
		<?php echo $form->passwordField($model,'re_password', 
		array('class'=>'form-control placeholder-no-fix', 'placeholder'=>'Confirm Password', 'tabindex'=>5)); 
		?>
		</div>
		<?php echo $form->error($model,'re_password'); ?>
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
		<?php 
		echo CHtml::ajaxSubmitButton('Sign Up', $this->createUrl("/site/register"),
		array(
		'dataType'=>'json',
		'type'=>'post',
		'beforeSend'=>'function(){$(".signupbuttondisable").attr("disabled","disabled"); }',
		'complete'=>'function(){$(".signupbuttondisable").removeAttr("disabled"); }',
		'success'=>'function(data) {
		if(data.status=="success"){
		window.location=data.returnUrl;
		}
		else{
		$.each(data, function(key, val) {
		$("#register-form #"+key+"_em_").text(val);                                                    
		$("#register-form #"+key+"_em_").show();
		});
		}       
		}'), 
		array('class'=>'btn blue signupbuttondisable', 'data-dismiss'=>'model', 'tabindex'=>6)); 
		?>
	</div>
	<?php $this->endWidget(); ?>
	</div>
</div>
