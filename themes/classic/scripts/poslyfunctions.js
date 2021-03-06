//************ This JS has Common Posly js function to be used in overall site *****

/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict'; //http://blueimp.github.io/jQuery-File-Upload/ --for File Upload..***********Newly Added in New HTML
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
   /* $('#fileupload').fileupload({
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
	*/
});

/* on click of image in carousel in Cart, show related comments & likes
** app.js Line-506 contains collapseed & expand class
* Last Modified: 25-Sep-14
*/
function showcartComments(elmn){	
	photoid = $(elmn).attr('photo_id');
	$(elmn).parents('.portlet-body').parents('.portlet').children('.portlet-body').children('.divcomments').hide();	
	$('#cart-data'+photoid).show();
	$('.main-img-user').children('.owl-carousel').children('.owl-controls').css("bottom",0);
	//adjustOwlCarouselHeight(photoid); //Adjust carousel black strip position	
	setTimeout(function(){adjustOwlCommentBoxHeight(elmn,'show')}, 1000);	
}

/* Re-arrange height of owl-carousel Black Strip height/Position wrt various img height..	
* Last Modified: 25-Sep-14
*/
function adjustOwlCarouselHeight(photoid){	
	return false; //NOT IN USE ****** Now 25-Sep-14 *******
	var owldivheight = $(".main-img-user .owl-carousel .owl-height").height();
	var activeImgheight = $("#owl"+photoid).height();
	var maximgheight=0;
	var heightdiff=0;
	if(activeImgheight<owldivheight)
	{		
		$("#owl"+photoid).parents(".owl-stage").children('div').each(function(){
			if($(this).hasClass("owl-item"))
			{
				imgheight = $(this).height();
				if($(this).height()>maximgheight)
				maximgheight = $(this).height();
			}
		});
		if(activeImgheight<maximgheight){
			heightdiff = maximgheight-activeImgheight;
		}			
		//$('.main-img-user .owl-controls').css("bottom",heightdiff);		
		$('.main-img-user .owl-controls').animate({
			bottom: heightdiff	
		}, 200);		
	}
}

/* Re-arrange height of owl-carousel Black Strip in ZOOM Images
* Last Modified: 25-Sep-14
*/
function adjustZoomCarouselHeight(photoid){
	return false; //NOT IN USE **** Now 25-Sep-14 ********
	$("#zoomowl"+photoid).click();
	var owldivheight = $(".main-img-user .owl-carousel .owl-stage-outer").height();
	var activeImgheight = $("#zoomowl"+photoid).height();
	var maximgheight=0;
	var heightdiff=0;	
	if(activeImgheight<owldivheight)
	{		
		$("#zoomowl"+photoid).parents(".owl-stage").children('div').each(function(){
			if($(this).hasClass("owl-item"))
			{	
				imgheight = $(this).height(); console.log(imgheight);
				if($(this).height()>maximgheight)
				maximgheight = $(this).height();
			}
		});
		console.log(photoid+' '+owldivheight+' '+maximgheight);
		if(activeImgheight<maximgheight){
			heightdiff = maximgheight-activeImgheight;
		}			
		//$('.main-img-user .owl-controls').css("bottom",heightdiff);		
		$('.main-img-user .owl-controls').animate({
			bottom: heightdiff	
		}, 200);		
	}
}

/* Re-arrange height of owl-carousel Comment div "divcomments"
* Logic is that , find the smallest height of images from 3-slots
* then apply that height to ".owl-height" div so that all images in slots 
* maintains an equal height, hence the comment div will get top align and reduce in betwn space
* Last Modified: 25-Sep-14
*/
function adjustOwlCommentBoxHeight(obj,showhide)
{	
	var elmn;
	var minimgheight;	
	var imgheight;	
	if(showhide=='hide')
	{	
		//Appy for all Cards ..Hide Cards At First Page Load						
		$(".main-img-user").each(function(){
			elmn = $(this); //elm - Parent .main-img-user
			minimgheight = 90000;
			imgheight = 0;			
			$(elmn).children('.owl-carousel').children('.owl-height').children('div').children('div').each(function(){
				//$(this) is the DIV class - owl-item, owl-item cloned, owl-item active
				$(this).css("overflow","hidden");
				imgheight = $(this).height();
				$(this).attr("data-min",imgheight);	//Keep record of each Image height			
				if(imgheight<minimgheight){
					minimgheight = imgheight; //Min Height Image
				}				
				if(minimgheight>0){
					//Apply img height which in lowest level, to ".owl-height" div, 
					//so that all the images under owl-height div gets hidden to overflow..
					$(elmn).children('.owl-carousel').children('.owl-height').css("height",minimgheight);
					$(elmn).children('.owl-carousel').children('.owl-height').attr("data-minheight",minimgheight);
				}				
				//console.log($(this).attr("class"));				
			});		
		});		
	} 
	else{
		//Show specific card, on click of an carousel-blackStrip img 
		elmn = $(obj).parent('.owl-dot').parent('.owl-dots').parent('.owl-controls').parent('.owl-carousel').children('.owl-height');
		//obj is object of class="owl-dot" <img>, ie carousel-blackStrip img 
		minimgheight = $(elmn).attr("data-minheight");
		imgheight = $(elmn).children('div').children('.active').attr("data-min"); //Get Active Image Height & apply to owl-height		
		$(elmn).css("height",imgheight);
	}
}

/* Image Zoom function
	when click on Cart Image, it Open in Modal Poup with Zoom, magnify
	Modal code is in Index.php Line-71, /components/cartzoom.php
*/
$(document).on('click', '.img-zoom', function(){
	var pid=$(this).attr('dphoto_id');
	$('.czoomimage').hide();
	var cartuserid = $(this).attr('data-userid');	
	$('#zoomimage'+cartuserid).show();	
	//unhide comments,like for this Zoom image,
	activephotoid = $('#zoomimage'+cartuserid+' .active > .article-image').attr('dphoto_id'); 
	setTimeout('', 100); //timer to delay the execution for 100milisec, to aviod any ambiguity
	$('#zoomimage'+cartuserid+' .tagcloud').hide(); //first hide all tags for this Cart
	$('#zoomimage'+cartuserid+' .zoomdivcomments').hide(); //first hide all comments for this Cart
	$('#zoomcart-data'+activephotoid).show(); //show only tags of active image
	$('#zoomtag'+activephotoid).show();
	//adjustZoomCarouselHeight(pid); //Adjust carousel black strip position
	setTimeout(showWhoAlsoLike(pid), 1000);	
});

/* Hide/Unhide comments,tags in Zoom Image
	when click on any image in Black strip carousel in Zoom Image Cart, 
	show related comments & likes 
*/
function showZoomcartComments(elmn){
	var activephotoid = $(elmn).attr('photo_id');	
	$('#share-pic .zoomdivcomments').hide();
	$('#share-pic .tagcloud').hide();	
	$('#zoomcart-data'+activephotoid).show();	
	$('#zoomtag'+activephotoid).show();	
	setTimeout(showWhoAlsoLike(activephotoid), 1000);	
}

/* Add Comments Box
	this method is to add & save comments under Cart image	
*/
$(document).on('keypress', '.custom-comment-box', function(e){
	var code= (e.keyCode ? e.keyCode : e.which); 
	if(code == 13)
	{
		var url= $(this).attr('data-url');
		var profileurl = $(this).attr('data-profileurl');
		var id= $(this).attr('photo_id');
		var isfromzoom_img = $(this).attr('data-zoomimg'); //weather comment is trigger from ZoomImage or NormalImage
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
				var end="<li class='in'> <img class='avatar img-responsive' alt='' src='"+profileurl+data.avatar+"'";
				end=end+' />';
				end= end+'<div class="message"> <a href="#" class="name">';
				end= end+ data.firstName+' '+data.lastName;
				end=end+'</a> <span class="datetime">@ '+data.created_date;
				end=end+'</span>';
				end=end+' <span class="body">'+data.comment+'</span> </div> </li>';
			}			 
			$('#cart-data-maincomments'+id).append(end);
			 
			//Now increase the comment count at '5 comments' at Cart Data.
			var totcom = $('#cart-data-topcomments'+id+' .tools a').attr('data-src');
			totcom = parseInt(totcom) + 1;
			$('#cart-data-topcomments'+id+' .tools a').text(totcom+' comments');
			 
			if(isfromzoom_img=='1'){
				// As User has Put comment from Zoom Image Textarea, append the new comment Text
				$('#zoomcart-data-comments'+id).append(end);
			}			
		});
		$(this).val('');
		return false;
	}
});

/* ** This is for getting current country and near by country
*/
function get_current_nearby_country(url){
	var nearbyCountry = '';
	$.ajax({
		type: 'POST', 
		async: false,
		url: url,
		success:function(response){			
			var item = jQuery.parseJSON(response);
			var current_country = item.current.country_name;
			//added on 16-10-2014
			if (current_country=='-') {
				current_country = "Worldwide";
			}
			$("#current_country").html(current_country);
			$("#top_current_country").html(current_country);
			$("#current_view_country").html(current_country);			
			var nearby_countries = item.nearby;
			$.each(nearby_countries, function(idx, obj) {
				nearbyCountry += '<li><a href="/projects/posly_v2/posly/index.php/country/'+obj.country_name+'">'+obj.country_name+'</a></li>';
			});
			$("#nearby_country").html(nearbyCountry);
		},
		error: function(data) { // if error occured

		}
	});
}

//alternate function to get latlong
function showPosition(position) {
	var poslat =  position.coords.latitude;
	var poslong = position.coords.longitude;	
}

/* ** This is for Reset password
** /views/site/resetpassword.php
*/
function resetpassword(){
	var data=$("#resetpassword-form").serialize();
	var url_reset_password = $('#resetpassword-form').attr('data-url');
	$.ajax({
		type: 'POST',  
		url: url_reset_password,
		async: false,
		data:data,
		success:function(data){
			data = jQuery.parseJSON(data);
			if(data.status=="success"){				
				window.location=data.returnUrl;				
			}      
		},
		error: function(data) { // if error occured
		}
	});	
}

/* ** This is for site Login by EmailId
** Yii CActiveForm is used to show site Login Modal box
** /views/site/login.php
*/
function signInByEmail(){
	var data=$("#login-form").serialize();
	var url1 = $('#login-form .blue').attr('data-url');
	$.ajax({
		type: 'POST',  
		url: url1,
		async: false,
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

/* ** This is for resetting paasword to EmailId
** Yii CActiveForm is used to show forget password Modal box
** /views/site/forgetpassword.php
*/
function forgetpasswordToEmail(){
	$('#forgot_password_loader').show();
	$('#ForgetpasswordForm_email_em_').show();
	$('#ForgetpasswordForm_email_em_').html('');
	var data=$("#forgetpassword-form").serialize();
	var urlforget = $('#forgetpassword-form .blue').attr('data-url');	
	$.ajax({
		type: 'POST',  
		url: urlforget,
		data:data,
		success:function(data){
			//console.log(data);
			data = jQuery.parseJSON(data);
			if(data.status=="success"){				
				$('#forgot_password_loader').hide();
				$('#ForgetpasswordForm_email').hide();
				$('.input-icon').hide();
				$("#forgetmail").hide();				
				$("#ForgetpasswordForm_email_success").show();
				$("#reset_password_close").show();				
				$('#ForgetpasswordForm_email_success').html("A new password has been sent to your e-mail address");
			}
			else{				
				$('#forgot_password_loader').hide();
				$('#ForgetpasswordForm_email_em_').html(data.msg);
			}       
		},
		error: function(data) { // if error occured
			console.log("error: "+data);
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
		async: false,
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

/* When at app.js line 506, handlePortletTools, Comment Scroll
.main-commnet event get called to Hide Unhide comments at cart
There is a Much Gap between <ul> .CMn and div .scrollercm, to reduce this gap
resetCommentboxHeight comes into picture
Last Modified: 25-Sep-14
*/
function resetCommentboxHeight(elmn){
	return false; //**** NOT IN USE 25-Sept-14, as Scroll disappear in Chrome due to this fun****
	var datacnt = $(elmn).attr('data-src'); //elmn is the hyper-Link
	var ulId = $(elmn).parents('.main-commnet').parents('.divcomments').children('.CMc').children('.display-hide').children('.slimScrollDiv').children('.scrollercm').children('ul').attr('id');
	var ulheight = $('#'+ulId).height();
	var parentDiv = $('#'+ulId).parents('div').height();
	var parentDiv1 = $('#'+ulId).parents('div').parents('.slimScrollDiv').height();
	var heightdiff = parentDiv1 - ulheight;
	
	if(ulheight<160 && heightdiff>30){
		//Reduce the height
		//console.log(ulheight+' '+parentDiv1+' '+heightdiff);
		var scaleheight = parentDiv1 - (heightdiff - 20);
		$('#'+ulId).parents('div').parents('.slimScrollDiv').css("height", scaleheight);
		$('#'+ulId).parents('.scrollercm').css("height", scaleheight);
	}
}

/* In Zoom image, " Person Who Like This Also Like " 
list of carts liked by same person who like this cart.
Controller - PhotoController, actionWholiked
TemplateFile - /views/photo/wholikes.php
*/
function showWhoAlsoLike(pid){
	var photoid = pid;
	var url = $('#zoomcart-data'+photoid).parents('.portlet').next('.row').attr('data-src');
	url = url+"?id="+photoid; 
	//console.log(url);
	$.get(url, function(data) {		
		$('#zoomcart-data'+photoid).parents('.portlet').next('.row').html(data);
	});
}

function reload_js() {
	var src = '/plugins/owl-carousel/owl.carousel.min.js';
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
}

/* Used to check Uniqueness of EmailId and others at SignUp
Controller - SiteController, actionRegister
TemplateFile - /views/site/register.php
*/
function checkSignUp(elm)
{	
	var pass='1';
	var haserror='0';
	$('.errorMessage').html('');
	$('.errorMessage').show();	
	if($('#RegisterForm_firstname').val()==''){
		$('#RegisterForm_firstname_em').html('Name cannot be blank.');
		haserror='1';
	}	
	if($('#RegisterForm_email').val()==''){
		$('#RegisterForm_email_em').html('Email cannot be blank.');
		haserror='1';
	}
	if($('#RegisterForm_username').val()==''){
		$('#RegisterForm_username_em').html('PageName cannot be blank.');
		haserror='1';
	}
	if($('#RegisterForm_password').val()==''){
		$('#RegisterForm_password_em').html('Password cannot be blank.');
		pass='0';
		haserror='1';
	}	
	//to check Email
	if($('#RegisterForm_email').val()!='')
	{	var email = $('#RegisterForm_email').val();
		if(validateEmail(email))
		{	//check Email uniqueness
			var url = $(elm).attr('data-url');
			var url=url+'?email='+email;
			$.get(url,function(data){
				if(data=='1'){
					$('#RegisterForm_email_em').html('This email already used');
					haserror='1';
				}
			});
		} else{
			$('#RegisterForm_email_em').html('Enter Valid Email Id');
			haserror='1';
		}
	}
	//to password
	if($('#RegisterForm_password').val()!='')
	{	var str = $('#RegisterForm_password').val();
		var n = str.length;
		if(n<6)
		{	
			$('#RegisterForm_password_em').html('Enter Minimum 6 char length');
			haserror='1';
		}
	}	
	//console.log(haserror);
	if(haserror=='1')
	return false;
	else
	signUpEmail();	
}

function validateEmail(email) {
var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
return re.test(email);
}

/* ** This is for site SignUp by EmailId
** this Ajax call will save user to DB records
** /controller/site/register.php
*/
function signUpEmail()
{
	var data=$("#register-form").serialize();
	var url1 = $('#register-form').attr('data-url');
	$.ajax({
		type: 'POST',  
		url: url1,
		async: false,
		data:data,
		success:function(data){
			data = jQuery.parseJSON(data);
			if(data.status=="success"){
				window.location=data.returnUrl;				
			}
			else{				
				$("#RegisterForm_re_password_em").show();
				$("#RegisterForm_re_password_em").html(data.msg);
			}       
		},
		error: function(data) { // if error occured
		}
	});
}

/* ** This is used to populate city, state, region, wrt to country
** this Ajax call fetch data from DB, mostly used at Step-1 SignUp process
** /controller/registration/settings
*/
function getcountrycity(elm,targetid)
{	
	var url1 = $(elm).next('p').attr('data-url');
	var selectid = $(elm).attr('id'); 
	var name = $(elm).attr('name');
	var countryid = $("#formreg_country option:selected").attr('data-id');
	if(name=='country'){
		$("#formreg_region option").remove();
		//$("#formreg_state option").remove();
		$("#formreg_city option").remove();
	} else{
		$("#formreg_city option").remove();
	}
	sdata = $("#"+selectid+" option:selected").attr('data-id'); //$( elm+" option:selected" ).text(); //for inner value
	$.ajax({
		type: 'POST',  
		url: url1,
		async: false,  /* async - means other parrel event will carry on */
		data:{         
			pdata: sdata,
			pname: name,
			cid: countryid
		},
		success:function(data){
			data = jQuery.parseJSON(data);
			if(data.status=="success"){
				$("#"+targetid+" option").remove();
				$("#"+targetid).append(data.msg);			
			}
			else{				
				
			}       
		},
		error: function(data) { // if error occured
		}
	});
	$('#'+targetid).removeAttr('disabled');
}

//** Registration process Step- #1
$(document).on('click', '.accset_save', function(){
	var noerr = true;
	var gender = $("input[name='gender']:checked").val();
	$('.errorMessage').html('');
	if($('#firstname').val()==""){	
		$('#firstname').parent('.right').next('.errorMessage').html('Please Enter First Name');
		$('#firstname').parent('.right').next('.errorMessage').show();		
		noerr = false;
	}	
	if($('#email').val()==""){	
		$('#email').parent('.right').next('.errorMessage').html('Please Enter Email');
		$('#email').parent('.right').next('.errorMessage').show();		
		noerr = false;
	}
	if($('#password').val()==""){	
		var pflag = $('#password').attr('data-flag');
		if(pflag=="y"){
		$('#passerr').html('Please Enter Password');
		$('#passerr').show();
		noerr = false;
		}
	}
	if($('#dob').val()==""){	
		$('#dob').parent('.right').next('.errorMessage').html('Please Enter DOB');
		$('#dob').parent('.right').next('.errorMessage').show();		
		noerr = false;
	}
	if(gender==""){
		$('#gendererr').html('Please Select Gender');
		$('#gendererr').show();		
		noerr = false;
	}
	if($('#formreg_country').val()==""){
		$('.cnty_error').html('Please Select Country');		
		noerr = false;
	}
	if($('#formreg_city').val()==""){
		$('.city_error').html('Please Select City');		
		noerr = false;
	}
	if($('#form_2_select2222').val()==""){
		$('.ethi_error').html('Please Select Etnicity');		
		noerr = false;
	}
	if($('#userurl').val()==""){	
		$('#urlerror').html('Please Enter Page Name');		
		$('#urlerror').css('display','block');
		noerr = false;		
	} else{
		var str = $('#userurl').val();
		if(str.length<3){
			$('#urlerror').html('Page Name should be Minimum 4 chars');		
			$('#urlerror').css('display','block');
			noerr = false;	
		}
		if($('#errorpgname').val()=='1'){
			$('#urlerror').html('Page Name Already Used');		
			$('#urlerror').css('display','block');
			noerr = false;
		}
	}
	
	if(noerr)
		$('#formregstep1').submit();
	else
		return false;
});

//** click and keypress events
$(document).on('click', '#signinmail', function(){
	signInByEmail();
});

$(document).on('click', '#submit_resetpassword', function(){
	
	$('#ResetpasswordForm_password_em_').html('');
	$('#ResetpasswordForm_retype_password_em_').html('');
	$('#lerrormsg').html('');
	if($('#ResetpasswordForm_password').val()==''){
		$('#ResetpasswordForm_password_em_').show();
		$('#ResetpasswordForm_password_em_').html('Enter password');		
	}	
	else if($('#ResetpasswordForm_retype_password').val()==''){
		$('#ResetpasswordForm_retype_password_em_').show();
		$('#ResetpasswordForm_retype_password_em_').html('Retype  password');		
	}	
	else{
		var forget_password = $("#ResetpasswordForm_password").val();
		var forget_confirmPassword = $("#ResetpasswordForm_retype_password").val();
		if (forget_password == forget_confirmPassword) {
			resetpassword();
		}
		else{		
			$('#lerrormsg').html('Your Passwords Must Match');
		}
	}
});

$(document).on('click', '#reset_password_close', function(){
	var urlforget = $('#reset_password_close').attr('data-url');
	window.location=urlforget;	
});

$(document).on('click', '#forgetmail', function(){
	$('#ForgetpasswordForm_email_em_').html('');
	$('#ForgetpasswordForm_email_em_').hide();
	if($('#ForgetpasswordForm_email').val()!=''){		
		var email = $('#ForgetpasswordForm_email').val();
		if(validateEmail(email)){	//check Email uniqueness
			forgetpasswordToEmail();			
		} else{
			$('#ForgetpasswordForm_email_em_').show();
			$('#ForgetpasswordForm_email_em_').html('Enter Valid Email Id');
		}		
	}
	else{
		$('#ForgetpasswordForm_email_em_').show();
		$('#ForgetpasswordForm_email_em_').html('Enter Email Id');
	}	
});


/*A common Ajax function 
url - controller Path
data1 - single string variable
Last Modified: 22-Sep-14
*/
function getAjaxreturn(url,data1,id){
	var val1;
	$.ajax({
		type: 'POST',  
		url: url,
		async: false,
		data:{         
			pdata: data1,
			pid: id			
		},
		success:function(data){
			data = jQuery.parseJSON(data);
			if(data.status=="success"){				
				val1 = data.values;		
			}      
		},
		error: function(data) { // if error occured
		}
	});	
	return val1;
}

//** Click, change &onkeypress Events
$(document).on('click', '#signupmail', function(){
	checkSignUp( $(this) );
}); 

$(document).on('keypress', '#LoginForm_password', function(event){
	if(event.which == 13){
		signInByEmail();   
	}
});

$(document).on('click', '.commentlike', function(event){
	//** Comment Like & Dislike Call
	var sdata = $(this).attr('data-id');
	var flag = $(this).text();
	var url = $(this).attr('data-url');
	var val1 = '';
	url = decodeURIComponent(url);
	if(flag=="Like")
		$(this).text("UnLike");
	else
		$(this).text("Like");
	$.ajax({
		type: 'POST',  
		url: url,
		async: false,
		data:{         
			pdata: sdata,
			pflag: flag			
		},
		success:function(data){
			data = $.parseJSON(data);
			if(data.status=="success"){				
				val1 = data.values;		
			}      
		},
		error: function(data) { // if error occured
		}
	});	
	if(val1==0)
	val1='';
	$(this).parent('.like').parent('.likebox').children('.lcnt').html(val1);
});

$(document).on('click', '.shareposly', function(event){
	//** Share Pic into Posly Feeds
	var sharecnt=0;
	var url = $(this).attr('data-url');
	url = decodeURIComponent(url);
	var photoid = $(this).attr('data-id'); 
	sharecnt=getAjaxreturn(url,photoid,'1');
});

//click on owl-carousel Black Strip slot images, will show respective Comments
$(document).on('click', '.owl-controls .img-responsive', function(){
	showcartComments($(this));
});

//Re-Adjust Height of Owl-Carousel Black Strip uponimage at Mouse hover
$(document).on('hover', '.main-img-user', function(){
	$(this).children(".owl-carousel").children(".owl-controls").css("bottom",0);
	var photoid = $(this).children(".owl-carousel").children(".owl-height").children(".owl-stage").children(".active").children(".article-image").children(".hover-zomm").children(".lazyOwl").attr('dphoto_id');
	//adjustOwlCarouselHeight(photoid);
});

//Step-1# Email-SignUp page, Country, Region/States, Cities
$(document).on('change', '#formreg_country', function(){
	$('#formreg_region').attr('disabled', 'true');
	getcountrycity($(this),'formreg_region');
});
$(document).on('change', '#formreg_region', function(){
	$('#formreg_city').attr('disabled', 'true');
	getcountrycity($(this),'formreg_city');
});
$(document).on('change', '#formreg_state', function(){
	$('#formreg_city').attr('disabled', 'true');
	//getcountrycity($(this),'formreg_city');
});

// profile page functions

