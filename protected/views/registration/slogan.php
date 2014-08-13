<div class="col-md-8">
<div style="text-align: center; font-weight: blod; " class="server-msg"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slogan-form',
	'enableClientValidation'=>true,
	//'action'=>Yii::app()->createUrl('site/login'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=> array('class'=>'reg-form', 'onsubmit'=>"return false;")
)); ?>


	<div class="form-group  maks">
		<?php echo $form->labelEx($model,'slogan', array('class'=>'col-md-3 control-label')); ?>
		 <div class="col-md-9">
		<?php
		echo CHtml::textArea('SloganForm[slogan]', $model->slogan, array('rows'=>2, 'class'=>'form-control'));
		//echo $form->textArea($model,'slogan',array('rows'=>2, 'class'=>'form-control', "value"=>$model->slogan)); ?>
		</div>
		<?php echo $form->error($model,'slogan'); ?>
	</div>
	 <div class="form-actions right" >
            <?php 
             //print_r($hastag = Hashtags::model()->find("hashtags_name='hai'"));        
            echo CHtml::ajaxSubmitButton('Save', $this->createUrl("/registration/slogan"), array('success'=>'function(data){
                          if(data=="ok")
                          {
						  	$(".server-msg").text("SLOGAN updated successfully.");
						  	$(".server-msg").css("color", "green");
						  }
						  else
						  {
						  	$(".server-msg").text("SLOGAN updated failed.");
						  	$(".server-msg").css("color", "red");
						  }
                   }'), array('class'=>'btn cyan accset', 'data-dismiss'=>'model')); ?>
          </div>

<?php $this->endWidget(); ?>
</div>
