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

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict'; //http://blueimp.github.io/jQuery-File-Upload/ --for File Upload..***********Newly Added in New HTML
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script> 


<script>
jQuery(document).ready(function() {   
 App.init(); // initlayout and core plugins
 App.initOWL();
 QuickSidebar.init()
 
});

// on click of image in carousel in Cart, show related comments & likes
function showcartComments(elmn){
	photoid = $(elmn).attr('photo_id');
	$(elmn).parents('.portlet-body').parents('.portlet').children('.portlet-body').children('.divcomments').hide();	
	$('#cart-data'+photoid).show();	
}



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
 
/* Add Comments Box
	this method is to add & save comments under Cart image	
*/
$(document).on('keypress', '.custom-comment-box', function(e){
	var code= (e.keyCode ? e.keyCode : e.which); 
	if(code == 13)
	{
		var url= "<?php echo Yii::app()->createUrl('comments/addcomment'); ?>";
		var id= $(this).attr('photo_id');
		var comment= $(this).val();
		url+='/?id='+id+'&comment='+comment;
		$.get(url,function(data,status){ 
			var data = JSON.parse(data);
			if(data.avatar.indexOf('http')!= -1)
			{
				var end="<li class='in'> <img class='avatar img-responsive' alt='' src='"+data.avatar+"'";
				end=end+' />';
				end= end+'<div class="message"> <a href="#" class="name">';
				end= end+ data.firstName+' '+data.lastName;
				end=end+'</a> <span class="datetime">@ '+data.created_date;
				end=end+'</span>';
				end=end+' <span class="body">'+data.comment+'</span> </div> </li>';
			}
			else
			{
				var end="<li class='in'> <img class='avatar img-responsive' alt='' src='<?php echo Yii::app()->baseUrl.'/profiles/'; ?>"+data.avatar+"'";
				end=end+' />';
				end= end+'<div class="message"> <a href="#" class="name">';
				end= end+ data.firstName+' '+data.lastName;
				end=end+'</a> <span class="datetime">@ '+data.created_date;
				end=end+'</span>';
				end=end+' <span class="body">'+data.comment+'</span> </div> </li>';
			 }			 
			 $('#cart-data-maincomments'+id).append(end);
			/* var h= $('#'+id).height()+10;
			 if(h<225)
			 {
				$('#'+id).parent().parent().css('height', h);
				$('#'+id).parent().parent().find('.scrollercm').css('height', h);
			 }
			 else
			 {
				$('#'+id).parent().parent().css('height', 225);
				$('#'+id).parent().parent().find('.scrollercm').css('height', 225);					
				$('#'+id).parent().parent().find('.scrollercm').scrollTop( $('#'+id).height() );
			 }			
			$("#"+id ).scrollTop( $('#'+id).height());			
			*/
		});
		$(this).val('');
		return false;
	}
});	

/* Image Zoom function
	when click on Cart Image, it Open in Modal Poup with Zoom, magnify
	Modal code is in Index.php Line-133
*/
$(document).on('click', '.img-zoom', function(){
	var pid=$(this).attr('dphoto_id');
	var rank=$(this).closest('.portlet').find('.portlet-title > .rank > h2').html();
	var profileimg=$(this).closest('.portlet').find('.portlet-title > .caption').html();
	var cartimg=$(this).closest('.portlet').find('.main-img-user').html();
	
	/*var allimgs=$(this).closest('.portlet').find('.portlet-body  .carousel-inner').html();
	var ind=$(this).closest('.portlet').find('.portlet-body  .carousel-indicators').html();
	var tags=$(this).closest('.portlet').find('.portlet-body  .main-tag').html();
	var mname=$(this).closest('.portlet').find('.portlet-body  .main-name').html();
	var comment=$(this).closest('.portlet').find('.portlet-body  .main-comment').html();
	var commentbox=$(this).closest('.portlet').find('.portlet-body  .comment-form').html();
	*/
	
	//following will replace html elements in Index.php Line-133
	$('#share-pic .caption').html(profileimg); //Avatar image & name,country here ZOOM (A)
	$('#share-pic .rank > h2').html(rank);	 // Rank ZOOM (B)
	
	//imgstr = '<div class="article-image" data-dot="<img class=\'img-responsive\' src=\'assets/img/gallery/album2/b1s.jpg\'>"><a class="hover-zomm">	<img src="assets/img/gallery/album2/b1.jpg" class="lazyOwl img-responsive" alt="">	</a>	<div class="mask">	<a class="like" data-toggle="modal" href="#sign-in">	<i class="icon-heart-empty"></i>	</a>	</div>	</div>	';	
	
	
	//$('#share-pic .portlet-body > .main-img-user > .owl-carousel').html(imgstr);
	
	/*$('.dynamic-carousel-inner').html(allimgs);
	ind=$.trim(ind);
	var html = $.parseHTML(ind);
	$.each( html, function( i, el ) {
		$.each(el.childNodes[0].childNodes[0].childNodes, function(j, ele){
							
		if($(ele).attr('data-target'))
		{
			$(ele).attr('data-target', '#myCarousel4pop');
			$(ele).attr('class', 'slider-data');
		}
		});

	});
	$('.dynamic-carousel-indicators').html(html);
	$('.dynamic-main-tag').html(tags);
	$('.dynamic-main-name').html(mname);
	$('.dynamic-main-comment').html(comment);
	$('.dynamic-comment-form').html(commentbox);
	$('.dynamic-carousel-indicators').find('.bx-viewport').css('height', '70');
	$('.dynamic-main-comment > .slimScrollDiv > .scrollercm').find('.chats').attr('chatid', pid);
	$('.dynamic-comment-form > .input-cont').find('.custom-comment-box').removeAttr('class').attr('class', 'dynamic-box');
	 var url="<?php echo Yii::app()->createUrl('/photo/wholiked'); ?>?id="+pid;
	$.get(url, function( data ) {
	$("#share-pic > #modalbody > .row").remove();
	$('#share-pic > #modalbody').append(data);
	}); */

});


/* ** This is for site Login by EmailId
** Yii CActiveForm is used to show site Login Modal box
** /views/site/login.php
*/
function signInByEmail()
{
	var data=$("#login-form").serialize();
	$.ajax({
		type: 'POST',  
		url: '<?php echo $this->createUrl("/site/login"); ?>',
		data:data,
		success:function(data){
			data = jQuery.parseJSON(data);
			if(data.status=="success"){
				window.location=data.returnUrl;				
			}
			else{				
				$("#lerrormsg").show();
				$("#lerrormsg").html(data.msg);
			}       
		},
		error: function(data) { // if error occured

		}
	});
}

/*
 * This function is used to Render 
 "You & 12 person Like This"..Like txt below cart Image
*/
function poslyAjaxLikecalls(ajaxurl,id,sdata)
{	
	var returnstring;
	$.ajax({
		type: 'POST',  
		url: ajaxurl,		
		data:{                            
			  pid: id,
			  pdata: sdata			  
		},
		success:function(data){		
			returnstring = encodeURIComponent(data); //as return text contains HTML, so decode it first
			$('#cart-data'+id).children('.main-name').html(decodeURIComponent(returnstring));
		},
		error: function(data) { // if error occured

		}
	});	
}
</script> 



<?php if(!Yii::app()->user->isGuest)
{
?>

<?php	
}
else
{ ?>

<?php } ?>



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
