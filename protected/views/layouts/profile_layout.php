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
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome-4/css/font-awesome-4.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/2prettyicon/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/select2/select2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/select2/select2_metro.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate2.css">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />

<!--loading image-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pages/component.css" />
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pages/user-profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-2pretty.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/default.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/modernizr.custom.js"></script>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed page-boxed page-quick-sidebar-push-content page-quick-sidebar-full-height">
<!-- BEGIN HEADER -->
<div id="top-shadow" class="header navbar navbar-inverse navbar-fixed-top"> 
<!-- BEGIN TOP NAVIGATION BAR -->
<div class="header-inner container paddmore">   
	<!-- BEGIN RESPONSIVE MENU TOGGLER --> 
	<a href="javascript:;" class="navbar-toggle"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/menu-toggler.png" alt="" /> </a> 
	<!-- END RESPONSIVE MENU TOGGLER -->    
	<!-- BEGIN LOGO --> 
	<?php echo CHtml::link('<div class="fs1" aria-hidden="true" data-icon="&#xe18d;"></div>',array('site/index'), array('class'=>'navbar-brand')); ?>
	<!-- END LOGO --> 
	<!--TOP MENU-->
	<ul class="nav navbar-nav pull-left hidden-xs hidden-small">
	<li><?php echo CHtml::link('Catwalk',array('site/index'), array('class'=>'menu')); ?></li>
	<li><a class="menu" href="#">News Feed</a></li>
	<li><a class="menu" href="#">Blog</a></li>
	</ul>
	<!--END TOP MENU-->

<?php echo $content; ?>

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
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-1.11.0.min.js" type="text/javascript"></script> 
<!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> -->
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 

<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery.cookie.min.js" type="text/javascript"></script> 
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 
<!--<script type="text/javascript" src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-validation/dist/additional-methods.min.js"></script> 
<script type="text/javascript" src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/select2/select2.min.js"></script> 
<script src="<?php//echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script> 
-->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/ui-extended-modals.js"></script> 
<!-- END PAGE LEVEL PLUGINS --> 

<!--it makes chart-->
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/flot/jquery.flot.min.js" type="text/javascript"></script> 
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script> 
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>--> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/quick-sidebar.js" type="text/javascript"></script>  
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/chart.js" type="text/javascript"></script> 
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/form-validation.js"></script>-->
<!-- END PAGE LEVEL SCRIPTS --> 

<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script> 
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/holder.js" type="text/javascript"></script> -->

<!-- Display image in Catwalk, Stats Page as in masonry effect -->
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/masonry.pkgd.js"></script>
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/imagesloaded.js"></script> 
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/classie.js"></script> 
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/AnimOnScroll.js"></script> -->
<!-- END masonry effect -->

<!-- The basic File Upload plugin --> 
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/jquery.fileupload.js"></script> -->
<!-- END basic File Upload plugin -->

<!-- Display image in Catwalk, Stats,Followers, Following, Hearts Page as in masonry effect ** Important -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/masonry.pkgd.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/imagesloaded.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/classie.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/AnimOnScroll.js"></script> 
<!-- END masonry effect -->

<script>
function initAnimscroll() {		
	new AnimOnScroll( document.getElementById( 'grid' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	});
	new AnimOnScroll( document.getElementById( 'grid-stats' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	});

	new AnimOnScroll( document.getElementById( 'grid-heart' ), {
		minDuration : 0.4,
		maxDuration : 0.7,
		viewportFactor : 0.2
	});		
}
	
/*function show1(){
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0';
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';
	
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';

	
}

function show5(){
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0';
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';
	
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';

	
}	

function show6(){
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0';
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';
	
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';

	
}

function show7(){
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0';
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';
	
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';

	
}

function show2(){
	
	
	document.getElementById( 'tab_2_2' ).style.display='';
	document.getElementById( 'tab_2_2' ).style.overflow='';
	document.getElementById( 'tab_2_2' ).style.height=''
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';
	
	
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';

	
}	


function show3(){
	
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0'
	
	document.getElementById( 'tab_2_4' ).style.display='block';
	document.getElementById( 'tab_2_4' ).style.overflow='hidden';
	document.getElementById( 'tab_2_4' ).style.height='0';
	
	
	document.getElementById( 'tab_2_3' ).style.display='';
	document.getElementById( 'tab_2_3' ).style.overflow='';
	document.getElementById( 'tab_2_3' ).style.height='';

	
}

function show4(){
	
	
	document.getElementById( 'tab_2_2' ).style.display='block';
	document.getElementById( 'tab_2_2' ).style.overflow='hidden';
	document.getElementById( 'tab_2_2' ).style.height='0'
	
	document.getElementById( 'tab_2_4' ).style.display='';
	document.getElementById( 'tab_2_4' ).style.overflow='';
	document.getElementById( 'tab_2_4' ).style.height='';
	
	
	document.getElementById( 'tab_2_3' ).style.display='block';
	document.getElementById( 'tab_2_3' ).style.overflow='hidden';
	document.getElementById( 'tab_2_3' ).style.height='0';

	
}
*/

/*
* This function is used to hide, unhide & render data in
* user profile index page - Status,Catwalk,aboutus, followers etc options
*/
function showprofile(divid,methodname){
	$('.tab-content > .tab-pane').hide(); 
	$('.tab-content > .tab-pane').height('0');
	$('.tab-content > .tab-pane').removeClass('active in');
	$('.tab-content > .tab-pane').css('overflow', 'hidden');
	var url = $('.tab-content').attr('data-url');
	url = url+'/'+methodname; //methodname are the controller action name
	$.get(url,function(data,status){
		$('#tab_2_'+divid).html(data);	
	});
	document.getElementById('tab_2_'+divid).style.display='block';
	document.getElementById('tab_2_'+divid).style.overflow='';
	document.getElementById('tab_2_'+divid).style.height='';
	$('#tab_2_'+divid).addClass('active in');
	
	//if(divid!='1')
	setTimeout(initAnimscroll, 500);
}

showprofile('1','about');	
</script> 

<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/scripts/poslyfunctions.js"></script> -->
<!---Important JS Functions mainly for PHP developers --->
<script>
 jQuery(document).ready(function() {    
	App.init(); // initlayout and core plugins
	Chart.initCharts(); 
	QuickSidebar.init()
  });
</script> 
<!-- END JAVASCRIPTS -->

<?php
if(Yii::app()->user->isGuest)
{
	$model=new LoginForm;
$this->renderPartial('//site/login', array('model'=>$model)); //to display SignIn Email Modal window
	$model=new RegisterForm;
$this->renderPartial('//site/register', array('model'=>$model));
}

?>

</body>
<!-- END BODY -->
</html>