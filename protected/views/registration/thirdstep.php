<?php
/* The Template page for Registration Step-3#  - Find Your Friends */
$FBfrndsInPosly = $fbfriends;
?>
<div class="page-content">
<div id="form_wizard_1">
<!--   <form action="#" class="form-horizontal" id="submit_form">-->
<div class="page-content-3step container padd">
<div class="row">
	<div class="col-md-12"> 
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class="portlet box blue boxshadown">
	<ul class="nav nav-pills steps">
	<li class="done"><a data-toggle="tab" class="step"><span class="number">Step 1</span><span class="desc">Update Account Details</span></a></li>
	<li class="done"><a data-toggle="tab" class="step"><span class="number">Step 2</span><span class="desc">Update your Profile</span></a></li>
	<li class="done"><a data-toggle="tab" class="step"><span class="number">Step 3</span><span class="desc">Find your Friends</span></a></li>
	<li><a data-toggle="tab" class="step"><span class="number">Step 4</span> <span class="desc">Getting Started</span></a></li>
	<li></li>
	</ul>
	</div>
	<!-- END PAGE TITLE & BREADCRUMB--> 
	</div>
</div>
<div class="row">
<div class="col-md-12 "> 
<!--card1-->
<div id="bluemain" class="portlet box blue boxshadown">
<div class="portlet-body form">
<div class="tab-content">
	<div class="alert alert-danger display-none">
	<button class="close" data-dismiss="alert"></button>
	You have some form errors. Please check below. 
	</div>
	<div class="alert alert-success display-none">
	<button class="close" data-dismiss="alert"></button>
	Your form validation is successful!
	</div>
<div class="tab-pane fade  active in" id="tab1">
<div class="panel-group accordion scrollable" id="accordion2">
	<div class="portlet-title">
	<h1>Are your friends already on Posly?</h1>
	<p>Many of your friends may already be here. Searching your email account is the fastest way to find your friends on Facebook. <a href="#"><strong>See how lt works.</strong></a> </p>
	</div>
	<!--FB-->
	<div class="panel panel-default">
		<div class="panel-heading fb">
		<h4 class="panel-title"> 
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1">
		<i class="icon-facebook"></i>YOUR FACEBOOK FRIENDS</a></h4>
		<span>FOLLOW YOUR FRIENDS<i class="icon-caret-up"></i></span> 
		</div>
		<div id="collapse_2_1" class="panel-collapse in">
		<div class="panel-body">
		<div class="padd">
		<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
		<div class="row-fluid">
		<?php 
		if(isset($FBfrndsInPosly) && count($FBfrndsInPosly)>0){
		foreach($FBfrndsInPosly as $l=>$vs)
		{
		?>
		<div class="col-md-6">
		<div class="caption-epic"><img class="avatar-user-step img-responsive" alt="" src="<?php echo $vs['photoURL']; ?>">
		<div class="cap1"><a href="#" class="username"><?php echo $vs['displayName']; ?></a><span class="button">
		<button type="button" class="btn white st3follow" data-tag="<?php echo $vs['identifier']; ?>" data-src="<?php echo $l;?>" data-id="">Follow</button>
		</span> 
		</div>
		</div>
		</div>
		<?php 
		} 
		}
		?>
		</div>
		</div>
		</div>
		<div class="panel-heading fb">
		<h4 class="panel-title"> <a > <i></i>Invite FACEBOOK FRIENDS</a> </h4>
		</div>
		<div class="padd">
			<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
				<div id="fbinvite" class="row-fluid">
				<?php 
				if(isset($list)){
				foreach($list as $l)
				{
				?>
				<div class="col-md-6">
				<div class="caption-epic">
				<input type="checkbox" value="<?php echo $l->identifier; ?>" class="facebook-invitation">
				<img class="avatar-user-step img-responsive" alt="" src="<?php echo $l->photoURL; ?>">
				<div class="cap1"><a href="#" class="username"><?php echo $l->displayName; ?></a>
				<!--<span class="button">Hewlett Packard</span>--> 
				</div>
				</div>
				</div>
				<?php 
				} } 
				?>
				</div>
			</div>			
			<div class="panel-heading-bot-con">
				<div style="float:left;">
				<h4 class="panel-title">Selected <strong>2</strong> of <strong>24</strong> maximum</h4>				
				</div>
				<div style="float:right;">
				<?php if(isset($list)){?>
				<span class="button">
				<button type="button" class="btn white st3invite">Invite</button>
				</span>
				<?php } ?>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>	
	<!--lnst-->
	<div class="panel panel-default">
		<div class="panel-heading inst">
		<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_5">
		<i class="icon-instagram"></i>Connect to instagram </a></h4>
		<span><a href="#"><strong>CONNECT NOW</strong></a></span>
		</div>
		<div id="collapse_2_5" class="panel-collapse collapse">
		<div class="panel-body">
		<div class="padd">
		<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
		<div class="row-fluid">
		<div class="col-md-6">
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white">Follow</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white">Follow</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white active">Following</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white">Follow</button>
		</span> </div>
		</div>
		</div>
		<div class="col-md-6">
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white active">Following</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn cyan active">Unfollow</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white">Follow</button>
		</span> </div>
		</div>
		<div class="caption-epic"> <img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">
		<button type="button" class="btn white">Follow</button>
		</span> </div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="panel-heading inst">
		<h4 class="panel-title"> <a > <i></i>Invite instagram FRIENDS</a> </h4>
		</div>
		<div class="padd">
		<div class="scrollercm" style="height: 220px;" data-always-visible="1" data-rail-visible1="1">
		<div class="row-fluid">
		<div class="col-md-6">
		<div class="caption-epic">
		<input checked type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		</div>
		<div class="col-md-6">
		<div class="caption-epic">
		<input checked type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		<div class="caption-epic">
		<input type="checkbox">
		<img class="avatar-user-step img-responsive" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar1_small.jpg">
		<div class="cap1"> <a href="#" class="username">Sara Pely </a><span class="button">Hewlett Packard</span> </div>
		</div>
		</div>
		</div>
		</div>
		<div class="panel-heading-bot-con">
		<h4 class="panel-title">Selected <strong>2</strong> of <strong>24</strong> maximum</h4>
		</div>
		</div>
		</div>
		</div>
	</div>	
	<!--email-->
	<div class="panel panel-default">
		<div class="panel-heading meo">
		<h4 class="panel-title"> 
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_7">
		<i class="icon-envelope"></i>Invite friends by mail </a> </h4>
		<span><a href="#"><strong>CONNECT NOW</strong></a></span> 
		</div>
		<div id="collapse_2_7" class="panel-collapse collapse">
		<div class="panel-body meo">
		<div class="form-group">
		<div class="col-md-3">
		<label class="control-label"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icloud.jpg" alt=""> <span>iCloud</span> </label>
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Apple ID" >
		</div>
		<div class="col-md-3">
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Password" >
		</div>
		<div class="col-md-2">
		<button type="button" class="btn white">Find Friends</button>
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		<label class="control-label"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/outlook.jpg" alt=""> <span>Outlook</span> </label>
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Your E-mail" >
		</div>
		<div class="col-md-2">
		<button type="button" class="btn white">Find Friends</button>
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		<label class="control-label"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/webde.jpg" alt=""> <span>Web.de</span> </label>
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Your E-mail" >
		</div>
		<div class="col-md-2">
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Your Email Password" >
		</div>
		<div class="col-md-2">
		<button type="button" class="btn white">Find Friends</button>
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-12">
		<div class="divider"></div>
		</div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		<label class="control-label"><i class="icon-envelope"></i>Another Email Client </label>
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Your E-mail" >
		</div>
		<div class="col-md-2">
		</div>
		<div style="clear: both;"></div>
		</div>
		<div class="form-group">
		<div class="col-md-3">
		</div>
		<div class="col-md-7">
		<input name="email" type="text" class="form-control" placeholder="Your Email Password" >
		</div>
		<div class="col-md-2">
		<button type="button" class="btn white">Find Friends</button>
		</div>
		<div style="clear: both;"></div>
		</div>
		</div>
		</div>
	</div>
	
</div><!-- #accordion2 Ends -->	
</div>
</div><!-- .tab-content Ends -->	
</div>
</div><!-- bluemain Ends -->
</div>
</div>
<div class="row">
	<div class="col-md-12">
	<div class="nhomnut pull-right"> 
	<?php 
	echo CHtml::link('Back', array('registration/secondstep'), array('class'=>'btn btn white buttonprevious'));
	echo CHtml::link('Skip this Step', array('registration/fourthstep'), array('class'=>'btn btn white skip'));
	echo CHtml::link('Next Step', array('registration/fourthstep'), array('class'=>'btn cyan active send-invite'));
	?>
	</div>
	</div>
</div>
</div>
<!--</form>-->
</div> 
</div>