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
 QuickSidebar.init()
 
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
	$('#zoomimage'+cartuserid+' .tagcloud').hide(); //first hide all tags for this Cart
	$('#zoomimage'+cartuserid+' .zoomdivcomments').hide(); //first hide all comments for this Cart
	$('#zoomcart-data'+activephotoid).show(); //show only tags of active image
	$('#zoomtag'+activephotoid).show();
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
}

/* Add Comments Box
	this method is to add & save comments under Cart image	
*/
$(document).on('keypress', '.custom-comment-box', function(e){
	var code= (e.keyCode ? e.keyCode : e.which); 
	if(code == 13)
	{
		var url= $(this).attr('data-url');
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

function reload_js() {
	var src = '/plugins/owl-carousel/owl.carousel.min.js';
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('head');
}
