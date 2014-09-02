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
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-combify/jquery.ui.combify.css" />
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
<li><?php echo CHtml::link('News Feed',array('newsfeed/index'), array('class'=>'menu')); ?></li>
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
          
          <!--part2-->
          
          
          
          
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
	
	 
	
	if (pos == 0 ) { $("#top-shadow").removeClass("topsha");   $(".page-sidebar-menu.marktop").removeClass("lentren2");}
	
	else {$("#top-shadow").addClass("topsha");  }

	posWas = pos; 
	
	
})
 
</script>

<script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins        
		 FormValidation.init();
		  	 $(".custom-combify").combify();
      });
   </script> 

 

<script>

 

$('.accset_save').click(function(e){
	 	
		var verify = 0;
		
		/* user details data (first form) Table: users_details */
	 	var fn = $('#firstname').val();
		var ln = $('#lastname').val();
		var email = $('#email').val();
		var dob = $('#dob').val();
		var gender = $("input:radio[name='gender']:checked").val();
		
		//Table : users_language
		var lan = $('#form_2_select22').val();
		if (lan == "") { 
			$('.lan_error').text('Please Enter Language');
		} else {
 			$('.lan_error').text('');
			verify = verify + 1;
			 
		}
		
		
		//Table : users_location
		var cnty = $('#form_2_select2').val();
		if (cnty == "") {
			$('.cnty_error').text('Please Enter Country');
		} else {
			$('.cnty_error').text('');		
			verify = verify + 1;
		}
		
		var region = $('#form_2_selectregion').val();
		if (region == "") {
			$('.region_error').text('Please Enter Region');
		} else {
			$('.region_error').text('');
			verify = verify + 1;
		}
		
		var state = $('#form_2_selectstate').val();
		if (state == "") {
			$('.state_error').text('Please Enter State');	
		} else {
			$('.state_error').text('');
			verify = verify + 1;
		}
		
		var city = $('#form_2_select222').val();
		if (city == "") {
			$('.city_error').text('Please Enter City');	
		} else {
			$('.city_error').text('');
			verify = verify + 1;
		}
		
		//Table : users_ethnicity
		var ethinicity = $('#form_2_select2222').val(); 
		if (ethinicity == "") {
			$('.ethi_error').text('Please Enter Ethinicity');	
		} else {
			$('.ethi_error').text('');
			verify = verify + 1;
		}
		
		 
		
		//Table : users_details
		var search_pri = $('#search_privacy').bootstrapSwitch('status');  // (added this field and modified in the model)
		if (search_pri == true) 
			search_pri = 1;
		else 
			search_pri = 0;
		
		
		var url = $('#url').val(); // (added new field and modified in the model)
		
		/* privacy on/off (second form) Table : users_security*/
		var privacy = $("input:radio[name='messageme']:checked").val(); //added new field and modified in model
		
		/* email notification (third form) Table : users_notification (added new fields and generated the model) */
		var email_notify = $('#email_notify').bootstrapSwitch('status');
		if (email_notify) email_notify = 1; else email_notify = 0;
			
		 
		var like_pic = $('#like_pic').bootstrapSwitch('status');
		if (like_pic) like_pic = 1; else like_pic = 0;
		
		var follow = $('#follow_you').bootstrapSwitch('status');
		if (follow) follow = 1; else follow = 0;
		
		var comment_pic = $('#cmt_pic').bootstrapSwitch('status');
		if (comment_pic) comment_pic = 1; else comment_pic = 0;
		
		var sent_msg = $('#sent_msg').bootstrapSwitch('status');
		if (sent_msg) sent_msg = 1; else sent_msg = 0;
		
		var week_newsletter = $('#week_newsletter').bootstrapSwitch('status');
		if (week_newsletter) week_newsletter = 1; else week_newsletter = 0;
		
		var feature_announce = $('#fea_ann_upd').bootstrapSwitch('status');
		if (feature_announce) feature_announce = 1; else feature_announce = 0;
		
		var week_inspiration = $('#week_inspiration').bootstrapSwitch('status');
		if (week_inspiration) week_inspiration = 1; else week_inspiration = 0;
		
		var invi_feed = $('#invi_feed').bootstrapSwitch('status');
		if (invi_feed) invi_feed = 1; else invi_feed = 0;
		
		var pic_of_week = $('#pic_of_week').bootstrapSwitch('status');
		if (pic_of_week) pic_of_week = 1; else pic_of_week = 0;
		
		var someone_fb = $('#someon_on_fb').bootstrapSwitch('status');
		if (someone_fb) someone_fb = 1; else someone_fb = 0;
		
		/* social sharing privacy Table : user_social_privacy (added new table and generated the model) */
		
		
		var fb_like = $('#fb_like').bootstrapSwitch('status');
		if (fb_like) fb_like = 1; else fb_like = 0;
		
		var fb_upload = $('#fb_upload').bootstrapSwitch('status');
		if (fb_upload) fb_upload = 1; else fb_upload = 0;
		
		var fb_comment = $('#fb_comment').bootstrapSwitch('status');
		if (fb_comment) fb_comment = 1; else fb_comment = 0;
		
		var fb_favour = $('#fb_favour').bootstrapSwitch('status');
		if (fb_favour) fb_favour = 1; else fb_favour = 0;
		
		data = 'firstname='+ fn  + '&lastname='+ ln + '&email=' + email + '&gender=' + gender + '&dob=' + dob + '&language=' + lan;
		data = data + '&country=' + cnty + '&region=' + region + '&state=' + state + '&city=' + city + '&ethinicity=' + ethinicity + '&search=' + search_pri + '&url=' + url;
		data = data + '&privacy=' + privacy;
		data = data + '&email_notify=' + email_notify + '&like_pic=' + like_pic + '&follow=' + follow + '&comment_pic=' + comment_pic + '&sent_msg=' + sent_msg + '&week_newsletter=' + week_newsletter + '&feature_announce=' + feature_announce + '&week_inspiration=' + week_inspiration + '&invi_feed=' + invi_feed + '&pic_of_week=' + pic_of_week + '&someone_fb=' + someone_fb;
		data = data + '&fb_like=' + fb_like + '&fb_upload=' + fb_upload + '&fb_comment=' + fb_comment + '&fb_favour=' + fb_favour;
		
		//console.log(data);
	 	//value = $('#form_sample_2').serialize();
		
		
 
		if (verify == 6) {
		 
		var form = $( "#form_sample_2" );
		form.validate();
		 
		  if( form.valid() ) {
		  	 
			  $.ajax({
					type: "POST",
					url:"<?php echo Yii::app()->createUrl('/registration/settings'); ?>",
					data: data,	
					success: function (msg1) {
						 
						 console.log(msg1);
					}
					 
				}).done(function (msg) {
					//alert(msg);
					});
		  
		} 
		  
		} else {
			 
			
		}
});



$(function() {
  var txt = $("#url");
  var exist = '';
  
  var button = $('.accset_save');
  var func = function() {
	 if (txt.val().length >= 8) { 
	 
	 
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
 });


</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>