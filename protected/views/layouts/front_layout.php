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
<li><a class="menu" href="#">News Feed</a></li>
<li><a class="menu" href="#">Blog</a></li>
</ul>
<!--END TOP MENU--> 
	
<!--CONTENT AREA -->

<?php echo $content; ?>

<!-- END CONTENT AREA -->

<!-- BEGIN FOOTER --> 

<!-- END FOOTER --> 

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php if(!Yii::app()->user->isGuest)
{
?>	

<script src='http://connect.facebook.net/en_US/all.js' type="text/javascript"></script>
 
<script type="text/javascript"> 
      FB.init({appId: "<?php echo Yii::app()->params['fbid']; ?>", status: true, cookie: true});
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
      function postToFeed(url) {
      	var auth="<?php if(Yii::app()->user->isGuest) echo '0'; else echo '1'; ?>";
      	if(parseInt(auth)==1)
      	{
		var u=readCookie('purl');
	 	$("body").find('.close').click();
        // calling the API ...
        var obj = {
          method: 'feed',
         // redirect_uri: 'YOUR URL HERE',
          link: 'https://api.facebook.com/me/photos',
          picture: u,
          name: 'Posly.com',
          //caption: '',
          description: 'Posly is the largest social network.'
        };

        function callback(response) {
    if (response && response['post_id']) {
    	var id=readCookie('pid');
    	var shareid=response['post_id'];
    			$.ajax({
					type: "POST",
					url: "<?php echo Yii::app()->createUrl('/photo/sharecount'); ?>",
					data: { id: id, shareid: shareid}
					})
					.done(function( msg ) {
						if(msg=='ok')
						 alert('Photo was shared successfully.');
					});
     
    } else {
      alert('Photo was not shared.');
    }
        }

        FB.ui(obj, callback);
        }
        else
        {
			$('#share-pic').modal('hide');
			$('#loginModal').modal('show');
		}

      }

</script>

<?php } ?>

<!-- The template to display files available for download --> 

<!-- effect item --> 

<!-- BEGIN CORE PLUGINS --> 

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

<!--file upload--> 

<!-- END PAGE LEVEL PLUGINS--> 
<!-- BEGIN:File Upload Plugin JS files--> 
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script> 
<!-- The Templates plugin is included to render the upload/download listings --> 

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script> 
<!-- The basic File Upload plugin --> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-file-upload/js/jquery.fileupload.js"></script> 
<!-- The File Upload processing plugin --> 

<!--end file upload --> 

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/poslyfunctions.js"></script> <!---Important JS Functions mainly for PHP developers --->

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
			/*  $('.bxslider').bxSlider({
				slideWidth: 400,
				minSlides: 5,
				maxSlides: 5,
				moveSlides: 5,
				slideMargin: 5,
				pager:false,
				infiniteLoop: false,
			  });
			*/
			
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
