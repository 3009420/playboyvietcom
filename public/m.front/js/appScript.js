$(document).ready(function(){
	
	$('.sidebar-right').hide();
			//CLOSE OPEN RIGHT MENU
			var $mn_right;
					$('#networks').click(function(){
						if($mn_right !== false) {
							$('.wrap').css('position','relative');
							$('.wrap').animate(
								{left:-210}, // what we are animating
								250, // how fast we are animating
								'easeOutQuad', // the type of easing
								function() { // the callback
							});
							//$('body').css('position', 'absolute') 
							$('.sidebar-right').show(250);
							$mn_right = false;
							return false;
						}
						if($mn_right !== true) {
							$('.wrap').animate(
							{left:0}, // what we are animating
							200, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
								$('.wrap').css('position','static');
							});	
							$('.sidebar-right').hide();
							$mn_right = true;
							return false;
						}
					});
					
			//CLOSE OPEN CATEGORY MENU
			var $mn_left;
			$('.navMain .btn-category .theloai').click(function(){
					if($mn_left !== false) {
						$('.wrap').css('position','relative');
						$('.wrap').animate(
							{left:220}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
						});
						//$('body').css('position', 'absolute') 
						$('.category-left').show(250);
						$mn_left = false;
						return false;
					}
					if($mn_left !== true) {
						$('.wrap').animate(
							{left:0}, // what we are animating
							200, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
							$('.wrap').css('position','static');
						});	
						//$('body').css('position', 'absolute') 
						$('.category-left').hide();
						$mn_left = true;
						}
				});
					
			//SEP BY STEP UPLOAD PHOTO : INFO
            
			$('.box-upload button.back-2').click(function(){
						$('.setInfo form fieldset').animate(
							{left:0}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
							$('body,html').animate({scrollTop: 0}, 250, 'easeOutQuad');
						});
						$('.upload').animate (
							{left:'-110%'}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() {} // the callback
						);
						//$('body').css('position', 'absolute') 
						$('.setInfo form fieldset').fadeIn();
						$('.upload').fadeOut();
						return false;
					});
			
			
			//SEP BY STEP UPLOAD PHOTO : MANAGE - EDIT		
			$('.stepUpload a, .submit .back').click(function(){
						$('.upload').animate(
							{left:0}, // what we are animating
							500, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
							$('body,html').animate({scrollTop: 0}, 250, 'easeOutQuad');
						});
						$('.setInfo form fieldset').animate (
							{left:'110%'}, // what we are animating
							500, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() {} // the callback
						);
						//$('body').css('position', 'absolute') 
						$('.setInfo form fieldset').fadeOut();
						$('.upload').fadeIn();
						return false;
					});
            
			//CATEGORY PHOTO - MISS LIST	
			$('.navTamtay ul li a.miss').click(function(){
						$('.navTamtay .miss-list').animate(
							{left:0}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
						});
						$('.navTamtay ul.category-photo').animate (
							{left:'110%'}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() {} // the callback
						);
						//$('body').css('position', 'absolute') 
						$('.navTamtay .miss-list, .back-category').fadeIn();
						$('.navTamtay ul.category-photo').fadeOut();
						return false;
					});
					
			$('.back-category a').click(function(){
						$('.navTamtay ul.category-photo').animate(
							{left:0}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() { // the callback
						});
						$('.navTamtay .miss-list').animate (
							{left:'-110%'}, // what we are animating
							250, // how fast we are animating
							'easeOutQuad', // the type of easing
							function() {} // the callback
						);
						//$('body').css('position', 'absolute') 
						$('.navTamtay .miss-list, .back-category').fadeOut();
						$('.navTamtay ul.category-photo').fadeIn();
						return false;
					});
			$('.manageAlbum .listAlbum h3 a i').click(function(){
					$('form.manageAlbum .listAlbum .input-append').toggle()
					});
            /*
			$('.share-image').click(function(){
					$('.share-func').slideToggle()
					$('.share-image').toggleClass('share-image-click')
					});
            */
			// scroll body to comment on click
			var commentH = $('.commentDetailArticle').height();
			var bodyH = $(document).height();
			//var commentP = $(document).height() - $('.commentDetailArticle').height()
			$('.infoAlbum ul li:last-child a').click(function () {
					$('body,html').animate({
						scrollTop: bodyH
					}, 1500, 'easeOutQuad');
					return false;
				});
			
			/*GO TO TOP*/	
			// hide #back-top first
			$(".btnUpTop").hide();
			
			// fade in #back-top
			$(function () {
						$(window).scroll(function () {
							if ($(this).scrollTop() > 100) {
								$('.btnUpTop').fadeIn();
							} else {
								$('.btnUpTop').fadeOut();
							}
						});
						// scroll body to 0px on click
						$('.btnUpTop a').click(function () {
							$('body,html').animate({
								scrollTop: 0
							}, 800);
							return false;
						});
			});
					
});


var $show;
   $('.btn-detail-box').click(function(){
     $('.detail-box').slideToggle()
     $('.btn-detail-box i').toggleClass('icon-up-open')
     function showhide(){
      if($show !== false){
       $('.btn-detail-box span').text('Rút gọn');
       $show = false;
       return false;
      }
      if($show !== true){
       $('.btn-detail-box span').text('Xem chi tiết');
       $show = true;
       return false;
      }
     }
    showhide();
   });
 
function chiase(id){
    $('#share-func-'+id).slideToggle()
   	$('#share-image-'+id).toggleClass('share-image-click')
}

function editInfo(id){
    $('.edit-box, .setInfo form fieldset').animate(
    	{left:0}, // what we are animating
    	250, // how fast we are animating
    	'easeOutQuad', // the type of easing
    	function() { // the callback
    	$('body,html').animate({scrollTop: 0}, 250, 'easeOutQuad');
    });
    $('#container, #other-house').animate (
    	{left:'110%'}, // what we are animating
    	250, // how fast we are animating
    	'easeOutQuad', // the type of easing
    	function() {
    	} // the callback
    );
    
    //$('body').css('position', 'absolute') 
    $('#container, #other-house, .upload').fadeOut();
    $('.edit-box, .setInfo form fieldset').fadeIn();
    /*
    $.ajax({
	   type: "POST",
	   url: "/my/index" ,
       data : "aid="+id,
       complete: function(res, s){
          $("fieldset").html(res.responseText);
	    }
    });
    */
    
    return false; 
}