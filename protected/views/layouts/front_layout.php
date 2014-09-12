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
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/2prettyicon/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-2pretty.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/owl-carousel/assets/owl.theme.default.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!-- Flexslider is used in Sidebar for Guest Login to Show slider images -->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/flexislider/flexslider.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-push-content page-quick-sidebar-full-height">
<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top"> 
<!-- BEGIN TOP NAVIGATION BAR -->
<div class="header-inner"> 

<!-- BEGIN RESPONSIVE MENU TOGGLER --> 
<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/menu-toggler.png" alt="" /> 
</a> 
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
	
<!--CONTENT AREA -->

<?php echo $content; ?>

<!-- END CONTENT AREA -->

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
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip --> 
<!--animation -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery.cookie.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/app.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/quick-sidebar.js" type="text/javascript"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/ui-extended-modals.js"></script>
<!-- END PAGE LEVEL SCRIPTS --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/poslyfunctions.js"></script> <!---Important JS Functions mainly for PHP developers --->

<!-- Flexslider is used in Sidebar for Guest Login to Show slider images -->
<?php if(Yii::app()->user->isGuest){ ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/flexislider/jquery.flexslider.js" type="text/javascript" ></script> 
<?php }?>
<script>
var posWas; 
$(window).bind('scroll', function(){ //when the user is scrolling...
	var pos = $(window).scrollTop(); //position of the scrollbar	
	if(pos > posWas){ 
		//do something
		 $("#top-shadow").addClass("lentren");
			   $("#right-slide").addClass("addin");
	}
	else if(pos < posWas){ 
		//do something
		$("#top-shadow").removeClass("lentren");
		$("#right-slide").removeClass("addin");
	}	
	if (pos == 0 ) { $("#top-shadow").removeClass("topsha");  $(".mosota").removeClass("rightsha"); $("#top-shadow").removeClass("lentren");}	
	else {$("#top-shadow").addClass("topsha");  $(".mosota").addClass("rightsha");}
	posWas = pos;	
});

//*** When user Scroll down, append more cart " more images "
var present=2;
$(window).scroll(function(){
if($(document).height()==$(window).scrollTop()+$(window).height()){
	present+=2;
	if($('.nomore').html()!=undefined)
	$('.page-content-wrapper > .page-content > .nomore').remove();
	if($('.page-content-wrapper > .page-content > .loader').html()==undefined)
	$('.page-content-wrapper > .page-content').append('<div class="row loader"></div>');
	var url="<?php echo Yii::app()->createUrl('/site/somemore'); ?>?act=<?php echo Yii::app()->controller->action->id; ?>&l="+present;
   $.get(url, function( data ) {
		ind=$.trim(data);
		var html = $.parseHTML(ind);
		$('body').append(html);
		var left=$('#leftside').css('display', 'none').html();
		var right=$('#rightside').css('display', 'none').html();
		var zoomimg=$('#zoomimagediv').css('display', 'none').html(); //zoomimagediv in somemore.php
		if($.trim(left)=='')
		{
			if($('.nomore').html()==undefined)
				$('.page-content-wrapper > .page-content').append('<div class="row nomore">No more images</div>');
			$('.page-content-wrapper > .page-content > .loader').remove();
			$('#leftside').remove();
			$('#rightside').remove();
			$('#zoomimagediv').remove();
		}
		else
		{	
			$('.page-content-wrapper > .page-content > .loader').remove();
			$('#leftside').remove();
			$('#rightside').remove();
			$('#zoomimagediv').remove();
			$('.page-content-wrapper > .page-content > .container > .row > .col-md-6:first-child').append(left);
			$('.page-content-wrapper > .page-content > .container > .row > .col-md-6:last-child').append(right);
			$('#share-pic').append(zoomimg);	
			
			//$(".owl-carousel").owlCarousel();
			App.init(); // initlayout and core plugins
			App.initOWL();
			QuickSidebar.init();
			
		}
	});	
}
else
{
	if($('.nomore').html()!=undefined)
	$('.page-content-wrapper > .page-content > .nomore').remove();
	if($('.page-content-wrapper > .page-content > .loader').html()!=undefined)
	$('.page-content-wrapper > .page-content > .loader').remove();
}
});


/* Heart Likes
	When User Clicks on Heart on a Cart Image following function gets called..
*/
$(document).on('click', '.like', function(){	
	<?php if(Yii::app()->user->isGuest){ ?>
		return false;  
		/*No login, then show SignIn Popup window, by return false as it will stop further execution
		 and #loginModal in href, will show the Modal window for signIn
		*/
	<?php } ?>
	var temp=$(this).find('i').attr('class');
	var n = temp.indexOf("checkAuth");
	if(n!=-1)
	{
		$('.userAuthCheck').click();
	}
	else
	{
		var u = $(this).attr('data-url');
		temp=$.trim(temp);
		var foo = u.split('/');
		var last = foo.length - 1;
		var id=foo[last];
		var ajaxurl = '<?php echo $this->createUrl("/likes/getlikehtml"); ?>';
		var likehtml;		
		if(temp=='icon-heart-empty')
		{
			$.get(u,function(data,status){ 
				var data = parseInt(data);					
				poslyAjaxLikecalls(ajaxurl,id,data);				
			});
			$(this).find('i').removeAttr('class').attr('class', 'icon-heart');
		}
		else if(temp =='icon-heart')
		{
			u= u.replace('cincrease', 'cdecrease');
			$.get(u,function(data,status){
				var data = parseInt(data);					
				poslyAjaxLikecalls(ajaxurl,id,data);				
			});
			$(this).find('i').removeAttr('class').attr('class', 'icon-heart-empty');
		} 
	}
	return false;
});

/* showUsersActivities function
	will add users activity, at sideBar through ajax call
*/
function showUsersActivities(){
	var url = '<?php echo $this->createUrl("/site/showusersactivities"); ?>';
	$.get(url,function(data,status){
		$('.notifi-panel').html(data);	
	});
}

//** Very Important To Initialize Plugins
jQuery(document).ready(function() {  
 App.init(); // initlayout and core plugins
 App.initOWL();
 QuickSidebar.init(); 
 
});
</script>

<script>
$(document).ready(function(){
    var documentWidth = $(document).width();
    $(window).scroll(function(){
    var windowHeight = $(window).height();
    var windowMiddle = windowHeight/2;
    var documentHeight = $(document).height();
    var scrollPosition = $(window).scrollTop();    
    //console.log("Scroll: "+scrollPosition+ " Window: "+windowMiddle);    
    var countScroll = $('body').scrollTop();
    //if(($(window).scrollTop() > 0) && ($(window).height() / 2)){
    if (scrollPosition > windowMiddle) {
      $("#scroll_top").removeClass("hidden");
    }
    else {
      $("#scroll_top").addClass("hidden");
    }
   });
   $("#scroll_top").click(function(event){   
        event.preventDefault();   
        $("html, body").animate({
            scrollTop:0
        },"slow");
   });
   if (documentWidth < 1024) {
     $('#scroll_top').css('right', '5px');
   }
    $(window).resize(function() {
        var windowWidth = $(window).width(); 
        if (windowWidth < 1024) {           
          $('#scroll_top').css('right', '5px');
        }
        else{
            $('#scroll_top').css('right', '280px');
        }
    }); 
	
	//** Login & Register Modal window JS
	$('#LoginForm_email').val('');
	$('#LoginForm_password').val('');
	$('.lerrormsg').hide();	
	$('#RegisterForm_firstname').focus(function() {
		if($('#RegisterForm_firstname').val()==''){
                    $('#RegisterForm_email').val('');
                    $('#RegisterForm_password').val('');
                    $('#RegisterForm_username').val('');
		}
		$('.errorMessage').hide();
	});
	
	//** FB & Instagram SignIn,SignUp Icon links
	$(document).on('click', '.faceS', function(){
		var url = "<?php echo Yii::app()->createUrl('/user/hybridauth/authenticate'); ?>";
		window.location=url;
	});
	$(document).on('click', '.instaS', function(){
		var clientId = "<?php echo Yii::app()->params['instaClientId']; ?>"; //Instagram Client Id
		var local = "<?php echo Yii::app()->params['instaredirecturl']; ?>";
		var url = "https://api.instagram.com/oauth/authorize?client_id="+clientId+"&redirect_uri="+local+"&scope=basic&response_type=code";
		//console.log(url);		
		window.location=url;
	});   
   
   $("#forgetpassword").click(function(){
     $('#loginModal').modal('hide');
   });   
   
});

<?php if(!Yii::app()->user->isGuest){ ?>
	showUsersActivities();
	
<?php } else{ //Guest Login *** ?>
    $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          controlsContainer: ".flex-container"
    });
   get_current_nearby_country("<?php echo $this->createUrl('/site/getnearbycountry'); ?>"); 
});
<?php } ?>

</script>

<!-- END JAVASCRIPTS -->
<?php
if(Yii::app()->user->isGuest){
   $model=new LoginForm;
   $this->renderPartial('//site/login', array('model'=>$model)); //to display SignIn Email Modal window
   $model=new RegisterForm;
   $this->renderPartial('//site/register', array('model'=>$model)); //to display SignUp By Email Modal window
   $model=new ForgetpasswordForm;
   $this->renderPartial('//site/forgetpassword', array('model'=>$model)); //to display SignUp By Email Modal window 
}
?>
</body>
<!-- END BODY -->
</html>
