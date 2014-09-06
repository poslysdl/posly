<?php
/* The Template page for Registration Step-2# */
?>
<div class="page-content">
<div id="form_wizard_1">
<!-- <form action="#" class="form-horizontal" id="submit_form">-->
<div class="page-content-3step container padd">
<div class="row">
	<div class="col-md-12"> 
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class="portlet box blue boxshadown">
	<ul class="nav nav-pills steps">
	<li class="done"><a data-toggle="tab" class="step"><span class="number"> Step 1 </span> <span class="desc"> Update Account Details </span></a></li>
	<li class="done"><a data-toggle="tab" class="step"><span class="number"> Step 2 </span> <span class="desc"> Update your Profile </span></a></li>
	<li><a data-toggle="tab" class="step"><span class="number"> Step 3 </span> <span class="desc"> Find your Friends </span></a></li>
	<li><a data-toggle="tab" class="step"> <span class="number"> Step 4 </span> <span class="desc">Getting Started </span></a></li>
	<li></li>
	</ul>
	</div>
	<!-- END PAGE TITLE & BREADCRUMB--> 
	</div>
	</div>
	<div class="row">
	<div class="col-md-12 "> 
	<!--card1-->
	<div class="portlet box blue boxshadown">
	<div class="portlet-body form">
	<div class="tab-content">
	<div class="alert alert-danger display-none">
	<button class="close" data-dismiss="alert"></button>
	You have some form errors. Please check below.</div>
	<div class="alert alert-success display-none">
	<button class="close" data-dismiss="alert"></button>
	Your form validation is successful! </div>
	<!--tab2-->
	<div class="tab-pane fade active in" id="tab2">
	<div class="upate-profile">
	<div class="row">
	<div class="col-md-12 main-head">
	<h1>UPDATE your profile</h1>
	<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr. </p>
	</div>
	</div>
	<div class="row">
	<div class="col-md-4">
	<div class="usepic">
	<div class="main-img-user thumbnail"> <img src="<?php 
	if(isset($user->userDetails->user_details_avatar))
	{
		$fromurl=strstr($user->userDetails->user_details_avatar, '://', true);
		if($fromurl=='http' || $fromurl=='https')
		echo $user->userDetails->user_details_avatar; 
		else
		echo Yii::app()->baseUrl.'/profiles/'.$user->userDetails->user_details_avatar;
	}
	?>" alt="" style="width: 100%; height: 260px;">
	<div class="mask">
	<button class="btn white change" type="button" data-toggle="modal" data-target="#myModal">Upload an Image</button>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel">Upload Profile Photo</h4>
	</div>
	<div class="modal-body">
	<?php 
	$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
	'id'=>'uploadFile',
	'config'=>array(
	'action'=>Yii::app()->createUrl('/registration/changephoto'),
	'allowedExtensions'=>array("jpg", "png", "gif", "jpeg"),//array("jpg","jpeg","gif","exe","mov" and etc...
	'sizeLimit'=>1*1024*1024,// maximum file size in bytes
	'minSizeLimit'=>1*1024,// minimum file size in bytes
	'onComplete'=>"js:function(id, fileName, responseJSON){ location.reload(); }",
	'messages'=>array(
	'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
	'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
	'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
	'emptyError'=>"{file} is empty, please select files again without it.",
	'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
	),
	'showMessage'=>"js:function(message){ alert(message); }"
	)
	)); ?>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-primary photo-update">Update</button>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<?php 
	//getting the solgan, remove comment to show Slogan Box
	/*$sloganf= new SloganForm;
	if(!Yii::app()->user->isGuest)
	{
	$id=Yii::app()->user->id;
	$m=UsersDetails::model()->find("user_id=$id");
	if(isset($m->user_details_slogan))
	$sloganf->slogan=$m->user_details_slogan;
	}
	$this->renderPartial('//registration/slogan', array('model'=>$sloganf));
	*/
	?>
</div>
<div class="row">
	<div class="col-md-12 tag">
	<div class="divider"></div>
	<div>
	<h3>my interests</h3>
	</div>
	<div class="form-group">
	<div class="col-md-3 nopaddleft nopaddright">
	<label  class="control-label nopaddtop">magazines </label>
	<span class="small">which fashion magazine are you reading?</span> </div>
	<div class="col-md-9 nopaddright">
	<div class="input-group">
	<input name="magazine" type="text" class="form-control text-italic addtag" data-tag="magazine" /> <!--addmagazine-->
	<span class="input-group-btn">
	<button class="btn green flat addtagbutton" type="submit" data-tag="magazine"><i class="icon-plus-sign"></i></button> <!-- addmagazinebutton -->
	</span> 
	</div>
	<div class="tagcloud taglists"> <!-- addmagazinetags -->
	<?php 
	$user = Yii::app()->user->id;
	$categoryId = HashtagsCategory::model()->find("hashtags_category_name='Magzine'");
	if(isset($categoryId)){
		$user1 = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtags.hashtags_category_id='$categoryId->hashtags_category_id' and t.user_id=$user");
		if(isset($user1)){
		foreach($user1 as $m) {
		echo "<a href='javascript:void(0);' class='novato' id=".$m->hashtags->hashtags_id." onclick=deleteM($(this).attr('id'));><i class='icon-remove-sign'></i>".$m->hashtags->hashtags_name."</a>";
		}
		}
	}
	?>
	</div>
	</div>
	</div>
	<div class="divider" style="clear: both;"></div>
	<div class="form-group">
	<div class="col-md-3 nopaddleft nopaddright">
	<label  class="control-label nopaddtop">designers & Brands</label>
	<span class="small">Who or what are your favorite fashion designers or bands?</span> </div>
	<div class="col-md-9 nopaddright">
	<div class="input-group">
	<input name="designer" type="text" class="form-control text-italic addtag" data-tag="designer" />
	<span class="input-group-btn">
	<button class="btn green flat addtagbutton" type="submit" data-tag="designer"><i class="icon-plus-sign"></i></button>
	</span> 
	</div>
	<div class="tagcloud taglists">
	<?php 
	$user = Yii::app()->user->id;
	$categoryId = HashtagsCategory::model()->find("hashtags_category_name='Design'");
	if(isset($categoryId)){ 
		$user1 = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtags.hashtags_category_id='$categoryId->hashtags_category_id' and t.user_id=$user");
		if(isset($user1)){
		foreach($user1 as $m){
		echo "<a href='javascript:void(0);' class='novato' id=".$m->hashtags->hashtags_id." onclick=deleteM($(this).attr('id'));><i class='icon-remove-sign'></i>".$m->hashtags->hashtags_name."</a>";
		}
		}
	}
	?>	
	</div>
	</div>
	</div>
	<div class="divider" style="clear: both;"></div>
	<div class="form-group">
	<div class="col-md-3 nopaddleft nopaddright">
	<label  class="control-label nopaddtop">SHOPS</label>
	<span class="small">where do you shops?</span> 
	</div>
	<div class="col-md-9 nopaddright">
	<div class="input-group">
	<input name="shops" type="text" class="form-control text-italic addtag" data-tag="shops"/> 
	<span class="input-group-btn">
	<button class="btn green flat addtagbutton" type="submit" data-tag="shops"><i class="icon-plus-sign"></i></button>
	</span> 
	</div>
	<div class="tagcloud taglists">
	<?php 
	$user = Yii::app()->user->id;
	$categoryId = HashtagsCategory::model()->find("hashtags_category_name='Shops'");
	if(isset($categoryId)){ 
		$user1 = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtags.hashtags_category_id='$categoryId->hashtags_category_id' and t.user_id=$user");
		if (isset($user1)) {
		foreach($user1 as $m) {
		echo "<a href='javascript:void(0);' class='novato' id=".$m->hashtags->hashtags_id ." onclick=deleteM($(this).attr('id'));><i class='icon-remove-sign'></i>".$m->hashtags->hashtags_name."</a>";
		}
		}
	}
	?>	
	</div>
	</div>
	</div>
	<div class="divider" style="clear: both;"></div>
	<div class="form-group">
	<div class="col-md-3 nopaddleft nopaddright">
	<label  class="control-label nopaddtop">style icons</label>
	<span class="small">Who or what are your biggest fashion insporations?</span> </div>
	<div class="col-md-9 nopaddright">
	<div class="input-group">
	<input name="styles" type="text" class="form-control text-italic addtag" data-tag="styles"/> 
	<span class="input-group-btn">
	<button class="btn green flat addtagbutton" type="submit" data-tag="styles"><i class="icon-plus-sign"></i></button>
	</span> 
	</div>
	<div class="tagcloud taglists">
	<?php 
	$user = Yii::app()->user->id;
	$categoryId = HashtagsCategory::model()->find("hashtags_category_name='StyleIcons'");
	if(isset($categoryId)){
		$user1 = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtags.hashtags_category_id='$categoryId->hashtags_category_id' and t.user_id=$user");								
		if(isset($user1)){
		foreach($user1 as $m){
		echo "<a href='javascript:void(0);' class='novato' id=".$m->hashtags->hashtags_id." onclick=deleteM($(this).attr('id'));><i class='icon-remove-sign'></i>".$m->hashtags->hashtags_name."</a>";
		}
		}
	}
	?>	
	</div>
	</div>
	</div>
	<div class="divider" style="clear: both;"></div>
	<div class="form-group">
	<div class="col-md-3 nopaddleft nopaddright">
	<label class="control-label nopaddtop">My style</label>
	<span class="small">How would you describe your fashion style?</span> </div>
	<div class="col-md-9 nopaddright">
	<div class="input-group">
	<input name="mystyle" type="text" class="form-control text-italic addtag" data-tag="mystyles" />
	<span class="input-group-btn">
	<button class="btn green flat addtagbutton" type="submit" data-tag="mystyles"><i class="icon-plus-sign"></i></button>
	</span> 
	</div>
	<div class="tagcloud taglists">
	<?php 
	$user = Yii::app()->user->id;
	$categoryId = HashtagsCategory::model()->find("hashtags_category_name='MyStyle'");
	if(isset($categoryId)){
		$user1 = UsersHashtags::model()->with('hashtags', 'hashtags.hashtagsCategory')->findAll("hashtags.hashtags_category_id='$categoryId->hashtags_category_id' and t.user_id=$user");								
		if(isset($user1)){
		foreach($user1 as $m) {
		echo "<a href='javascript:void(0);' class='novato' id=".$m->hashtags->hashtags_id." onclick=deleteM($(this).attr('id'));><i class='icon-remove-sign'></i>".$m->hashtags->hashtags_name."</a>";
		}
		}
	}
	?>	
	</div>
	</div>
	</div>
	</div>
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
<!--cvc-->
<!--sdas--> 
<!--end-->
<div class="row">
	<div class="col-md-12">
	<div class="nhomnut pull-right">
	<?php
	//echo CHtml::link('Back', array('registration/settings','stepflag'=>'y'), array('class'=>'btn btn white buttonprevious'));	
	echo '<a href="javascript:void(0);" class="btn btn white buttonprevious" id="step2bk">Back</a>';
	echo '<a href="javascript:void(0);" class="btn btn white skipmiddle step2skip">Skip this Step</a>';
	echo '<a href="javascript:void(0);" class="btn cyan active button-next step2skip">Next Step</a>';	
	?>
	</div>
	</div>
</div>
</div>
<!--</form>-->
</div> 
</div>