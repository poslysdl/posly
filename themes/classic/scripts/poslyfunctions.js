//************ This JS has Common Posly js function to be used in overall site *****

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


jQuery(document).ready(function() {   
 App.init(); // initlayout and core plugins
 App.initOWL();
 QuickSidebar.init(); 
 
});

// on click of image in carousel in Cart, show related comments & likes
function showcartComments(elmn){
	photoid = $(elmn).attr('photo_id');
	$(elmn).parents('.portlet-body').parents('.portlet').children('.portlet-body').children('.divcomments').hide();	
	$('#cart-data'+photoid).show();	
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
	setTimeout(showWhoAlsoLike(pid), 100);	
});

/* Hide/Unhide comments,tags in Zoom Image
	when click on Zoom Image,in carousel in Zoom Image Cart, 
	show related comments & likes 
*/
function showZoomcartComments(elmn){
	var activephotoid = $(elmn).attr('photo_id');	
	$('#share-pic .zoomdivcomments').hide();
	$('#share-pic .tagcloud').hide();	
	$('#zoomcart-data'+activephotoid).show();	
	$('#zoomtag'+activephotoid).show();
	setTimeout(showWhoAlsoLike(activephotoid), 100);
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

/* ** This is for site Login by EmailId
** Yii CActiveForm is used to show site Login Modal box
** /views/site/login.php
*/
function signInByEmail()
{
	var data=$("#login-form").serialize();
	var url1 = $('#login-form .blue').attr('data-url');
	$.ajax({
		type: 'POST',  
		url: url1,
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

/* When at app.js line 506, handlePortletTools,
.main-commnet event get called to Hide Unhide comments at cart
There is a Much Gap between <ul> .CMn and div .scrollercm, to reduce this gap
resetCommentboxHeight comes into picture
*/
function resetCommentboxHeight(elmn){
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
