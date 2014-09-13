<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title>Posly</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/2prettyicon/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/select2/select2_metro.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css"/>
<!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" type="text/css" media="all" />-->
<!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-combify/jquery.ui.combify.css" />-->
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-2pretty.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pages/user-profile.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-boxed">
<!-- BEGIN HEADER -->

<div id="top-shadow" class="header navbar navbar-inverse navbar-fixed-top"> 
<!-- BEGIN TOP NAVIGATION BAR -->
<div class="header-inner container paddmore"> 
<!-- BEGIN RESPONSIVE MENU TOGGLER --> 
<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/menu-toggler.png" alt="" /> </a> 
<!-- END RESPONSIVE MENU TOGGLER --> 

<!-- BEGIN LOGO -->
<?php echo CHtml::link('<div class="fs1" aria-hidden="true" data-icon="&#xe18d;"></div>',array('site/index'), array('class'=>'navbar-brand')); ?>  
<!-- END LOGO --> 
<!--TOP MENU-->
<ul class="nav navbar-nav pull-left hidden-xs hidden-small">
<li><?php echo CHtml::link('Catwalk',array('site/index'), array('class'=>'menu')); ?></li>
<li><?php echo CHtml::link('News Feed',array('news/index'), array('class'=>'menu')); ?></li>
<li><?php echo CHtml::link('Blog',array('blog/index'), array('class'=>'menu')); ?></li>
</ul>
<!--END TOP MENU--> 
    
<!-- BEGIN TOP NAVIGATION MENU -->

<?php $this->widget('application.components.TopNavigationMenu', array(
	'navigationmenu' => array('menu'=>'data_tobe_render_in_menus'))); ?>

<!-- END TOP NAVIGATION MENU --> 
</div>
<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER --> 

<!--SUB HEADER--> 

<!--end sub header-->

<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->

<div class="page-container">

 <?php echo $content; ?> 
  
</div>
<div class="clearfix"></div>

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
</div>
</div>   
<!--end- Modals --> 

<!-- END CONTAINER --> 
<!-- BEGIN FOOTER --> 
<!-- END FOOTER --> 
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) --> 
<!-- BEGIN CORE PLUGINS --> 
<!--[if lt IE 9]>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/respond.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/excanvas.min.js"></script>   
<![endif]--> 

<!--[if IE]>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/customie.css" rel="stylesheet" type="text/css"/>
<![endif]--> 
<!-- BEGIN CORE PLUGINS --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-1.11.0.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery.cookie.min.js" type="text/javascript"></script> 

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/form-validation.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/app.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/ui-extended-modals.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/poslyfunctions.js"></script> 
<!---Important JS Functions mainly for PHP developers --->
<script>
var posWas; 
$(window).bind('scroll', function(){ //when the user is scrolling...
	var pos = $(window).scrollTop(); //position of the scrollbar	
	if(pos > posWas){ 
		//do something
		 $(".page-sidebar-menu.marktop").addClass("lentren2");
	}
	else if(pos < posWas){ 
		//do something						
	} 	
	if(pos == 0 ){ 
	$("#top-shadow").removeClass("topsha");  
	$(".page-sidebar-menu.marktop").removeClass("lentren2");
	}	
	else {$("#top-shadow").addClass("topsha");  }
	posWas = pos;	
})
 
</script>

<script>

/*$(function() {
  var txt = $("#url");
  var exist = '';  
  var button = $('.accset_save');
  var func = function() {
	if(txt.val().length >= 8) {	 
    txt.val(txt.val().replace(/\s/g, ''));
	val = txt.val();
	$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createUrl('/registration/geturlname'); ?>",
		data : {value : val},
		success: function(data) {
			if (data) {				
				$('.url_msg').text("Already Taken");
				txt.closest('.form-group').removeClass('has-success').addClass('has-error');
				$('.accset_save').attr('disabled', 'disabled');				
				exist = true;				 
			}
			else {				
				$('.url_msg').text("");
				$('.accset_save').removeAttr('disabled');
				txt.closest('.form-group').removeClass('has-error').addClass('has-success');				
				exist = false;				 
			}
		}
	});
	
	}//if the text box value is greater than eight characters
	 else {
		$('.url_msg').text("");
	}
  } 	
  txt.keyup(func).blur(func);
}); */

//key enter for the magazine add -- .addmagazine
$('.addtag').keypress(function(e){
	code= (e.keyCode ? e.keyCode : e.which);
	var d=$(this).val();
	var tagstyle = $(this).attr('data-tag');
	var elmn = $(this);
	if(code == 13 && d!="")
	{
		$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createUrl('/registration/addmagazines'); ?>",
		async: false,
		data: { name: d,cat: tagstyle}
		})
		.done(function( msg ) {			 
			var obj = JSON.parse(msg);
			if(obj.status != 'false'){
			var html="<a  href='#' class='novato' id="+obj.hashtags_id+" onclick=deleteM($(this).attr('id'));>";		
			html=html+"<i class='icon-remove-sign'></i>"+obj.hashtags_name+"</a>";						
			$(elmn).parent('.input-group').parent('.nopaddright').children('.taglists').append(html);		
			}
		});
		$(elmn).val('');
		return false;
	}
});
		 
		 
//button event for the magazine add
$('.addtagbutton').click(function(e){
	var elmn = $(this);
	var d=$(this).parent('span').parent('.input-group').children('.addtag').val();
	var tagstyle = $(this).attr('data-tag');
	if(d!="")
	{
		$.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createUrl('/registration/addmagazines'); ?>",
		async: false,
		data: { name: d,cat: tagstyle}
		})
		.done(function( msg ) {
			var obj = JSON.parse(msg);		
			if(obj.status != 'false') {
			var html="<a href='#' class='novato' id="+obj.hashtags_id+" onclick=deleteM($(this).attr('id'));>";
			html=html+"<i class='icon-remove-sign'></i>"+obj.hashtags_name+"</a>";							
			$(elmn).parent('span').parent('.input-group').parent('.nopaddright').children('.taglists').append(html);				
			}
		});
		$(this).parent('span').parent('.input-group').children('.addtag').val('');
		return false;
	}
});


jQuery(document).ready(function() {    
	App.init(); // initlayout and core plugins    
	//FormValidation.init();
	//$(".custom-combify").combify();
});

$(document).on('click', '#step2bk', function(){
	var url = "<?php echo Yii::app()->createUrl('/registration/settings'); ?>";
	window.location=url+'/?stepflag=y';
});

$(document).on('click', '.step2skip', function(){
	var url = "<?php echo Yii::app()->createUrl('/registration/thirdstep'); ?>";
	window.location=url;
});

$(document).on('click', '.step1skip', function(){
	var url = "<?php echo Yii::app()->createUrl('/registration/secondstep'); ?>";
	window.location=url;
});

$(document).on('click', '.step1cancel', function(){
	var url = "<?php echo Yii::app()->createAbsoluteUrl('/site/logout'); ?>";
	window.location=url;
});

$(document).on('focus', '.form-control', function(){
	$('.errorMessage').hide();
});

$(document).on('click', '#connectfb', function(){
	//var url = "<?php echo Yii::app()->createAbsoluteUrl('/registration/dualfbsignup'); ?>";
	var url = "<?php echo Yii::app()->createUrl('/user/hybridauth/authenticate'); ?>";
	url=url+'?flagemail=y';		
	window.location=url;
	return false;
});

//Click event of Follow, unfollow in Step-3
$(document).on('click', '.st3follow', function(){
	var btntxt = $(this).text();
	var elmn = $(this);
	var uid = $(this).attr('data-src');	
	var fid = $(this).attr('data-id');
	var f1 = "<?php echo Yii::app()->createUrl('/follow/adduser'); ?>";
	var f2 = "<?php echo Yii::app()->createUrl('/follow/unfollow'); ?>";
	var url='';
	if(fid=="")
		url = f1;		
	else
		url = f2;	
	//Ajax Call
	$.ajax({
	type: "POST",
	url: url,
	async: false,
	data: { id: uid,fid: fid}
	})
	.done(function(data) {			 
		var obj = JSON.parse(data); 
		if(obj.status=='success'){
			if(fid=="")
				btntxt = "UnFollow";
			else
				btntxt = "Follow";
			$(elmn).attr('data-id',obj.msg);
		}
	});	
	$(elmn).text(btntxt);
	return false;	
});

//Click event of Invite in Step-3
$(document).on('click', '.st3invite', function(){
		FacebookInviteFriends();
	/*var invite = new Array();
	var i=0;
	$('#fbinvite input:checked').each(function() {
		//invite[i] = $(this).val();
		invite.push($(this).val());
		//i++;
	});
	var myJsonString = JSON.stringify(invite);
	//Ajax Call
	$.ajax({
	type: "POST",
	url: "<?php echo Yii::app()->createUrl('/follow/fbinvite'); ?>",
	async: false,
	data: { id: '',idata: myJsonString}
	})
	.done(function(data) {			 
		var obj = JSON.parse(data); 
		if(obj.status=='success'){			
			//$(elmn).attr('data-id',obj.msg);
		}
	});	 */
	return false;	
});

function deleteM(id)
{
	$.ajax({
	type: "POST",
	url: "<?php echo Yii::app()->createUrl('/registration/deletemagazines'); ?>",
	data: { id: id}
	})
	.done(function( msg ) {
	if(msg=='ok')
	$( "#"+id ).remove();
	});
	return false;
}
				
//Page Name Validation at Step-1#
$(document).on('keyup', '#userurl', function(e){
	code= (e.keyCode ? e.keyCode : e.which);	
	if(code != 13)
	{
		var d=$(this).val();	
		var elmn = $(this);
		$('.username_preview .urlc strong').text(d);
		$('#username-check').show(); 
		$('#maxchar').hide();
		if(d.length>3)
		{					
			setTimeout(validateusername(d), 2000); //timer
		}
	}
	
});

//Page Name Validation at Step-1#
$(document).on('focus', '#userurl', function(){
	$('.username_preview .urlc strong').text('');
	$('#username-check').removeClass('valid');
	$('#username-check').removeClass('error');
	$('#username-check').removeClass('success');
	$('#username-check span').html('');
});

function validateusername(d){
	var name = new Array();
	name[0] = d;
	var mystring = JSON.stringify(name);
	//Ajax Call
	$.ajax({
	type: "POST",
	url: "<?php echo Yii::app()->createUrl('/registration/validatepagename'); ?>",
	async: false,
	data: { id: '0',idata: mystring}
	})
	.done(function(data) {			 
		var obj = JSON.parse(data); 
		if(obj.status=='success'){			
		$('#username-check').removeClass('valid');
		$('#username-check').removeClass('error');
		$('#username-check').addClass('success');
		$('#username-check span').html('valid');
		} else{
		$('#username-check').removeClass('success');
		$('#username-check').removeClass('valid');
		$('#username-check').addClass('error');
		$('#username-check span').html('already taken');
		}
	});		
}
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>