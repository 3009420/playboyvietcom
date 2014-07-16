/*function get div ID */
function get_parent_id(event,name){
	/*event 			=  event cần bắt , thường là mouse click , mouse over , mouse in , focus*/
	/*name 				=  tên của div cần lấy id , thường là div bo ngoài object cần lấy */
	id = $(event).closest('.'+ name).attr('id');
	return(id);
}
/*=== function show area ==== */
function show_area(object,className,classShow ){
	/*object 			=  Tên của object cần thực hiện , thường là nút nào đấy hoặc link */
	/*class_of_div		=  Tên của class tổng cần lấy ID , lưu ý thường là class chứa object muốn thao tác */
	/*classShow 		=  Tên của class cần hiện */
	
	$('.' + object).click(function(){
		parent_div = get_parent_id(this,className); 	/*thực hiện funtion lấy id */
		$('#' + parent_div + ' .' + classShow).show();
		return(false);
	})
}
/*=== function hide area ==== */
function hide_area(object,className,classHide ){
	/*object 			=  Tên của object cần thực hiện , thường là nút nào đấy hoặc link */
	/*class_of_div		=  Tên của class tổng cần lấy ID , lưu ý thường là class chứa object muốn thao tác */
	/*classHide 		=  Tên của class cần ẩn đi */
	
	$('.' + object).click(function(){
		parent_div = get_parent_id(this,className); 	/*thực hiện funtion lấy id */
		$('#' + parent_div + ' .' + classHide).hide();
		return(false);
	})
}
/*=== function toggle area ==== */
function toggle_area(object,className,classToggle ){
	/*object 			=  Tên của object cần thực hiện , thường là nút nào đấy hoặc link */
	/*class_of_div		=  Tên của class tổng cần lấy ID , lưu ý thường là class chứa object muốn thao tác */
	/*classShow 		=  Tên của class cần hiện */
	
	$('.' + object).click(function(){
		parent_div = get_parent_id(this,className); 	/*thực hiện funtion lấy id */
		$('#' + parent_div + ' .' + classToggle).toggle();
		return(false);
	})
}
/*=== function focus area ==== */
function focus_area(object,className,classFocus ){
	/*object 			=  Tên của object cần thực hiện , thường là nút nào đấy hoặc link */
	/*class_of_div		=  Tên của class tổng cần lấy ID , lưu ý thường là class chứa object muốn thao tác */
	/*classFocus 		=  Tên của class cần focus vào */
	
	$('.' + object).click(function(){
		parent_div = get_parent_id(this,className); 	/*thực hiện funtion lấy id */
		$('#' + parent_div + ' .' + classFocus).focus();
		return(false);
	})
}


/*=== function outfocus and show hide area ==== */
function focus_out(object,className,classShow ){
	/*object 			=  Tên của object cần thực hiện , thường là nút nào đấy hoặc link */
	/*class_of_div		=  Tên của class tổng cần lấy ID , lưu ý thường là class chứa object muốn thao tác */
	/*classShow 		=  Tên của class cần hiện khi outfocus*/
	
	$('.' + object).focusout(function(){
		parent_div = get_parent_id(this,className);
		none_or_not = $('#' + parent_div + ' .' + object).val();
		object_none_textarea = object.replace(' textarea',''); // ID cua phan noi dung.
		if (none_or_not == '') {
			$('#' + parent_div + ' .' + classShow).show();
			$('#' + parent_div + ' .' + object_none_textarea).hide();
		};
	})
}


/*======= function make emo 1======*/
function emo_tamtay(e,class_wrap_emo_btn){
	mouse_target_class_name = $(e.target).attr('class');
	if (mouse_target_class_name != 'btn-emo-master1'){
		$('.tt-emo-list').css('display','none');
		
	}
	else{
		if ($('.tt-emo-list').css('display') == 'none'){
			position_lv1 = $(e.target).closest('.tt-emo').offset();
			//$('.tt-emo-list').css('left',(position_lv1.left) - 3);
			//Xác định vị trí của chuột so với window
			mouseX = e.pageY - $(window).scrollTop();
			if (mouseX > 310) {
				$('.tt-emo-list').css('top',(position_lv1.top - 245 ));
			}else{
				$('.tt-emo-list').css('top',(position_lv1.top + 30 ));
			}
			
			$('.tt-emo-list').css('display','block');
			//Lấy ID của box bo quanh nút emo-btn-master
			id_div_wrap = $(e.target).closest('.'+ class_wrap_emo_btn).attr('id');
			// gán ID cho box emo
			$('.tt-emo-list').attr('id','emo-'+ id_div_wrap);
		}
		else{
			$('.tt-emo-list').css('display','none');
		}
	}
    
    //BEGIN: banh bao
    if (mouse_target_class_name != 'btn-emo-banhbao-master'){
		$('.tt-emo-list-1').css('display','none');
		
	}
	else{
		if ($('.tt-emo-list-1').css('display') == 'none'){
			position_lv1 = $(e.target).closest('.tt-emo').offset();
			//$('.tt-emo-list').css('left',(position_lv1.left) - 3);
			//Xác định vị trí của chuột so với window
			mouseX = e.pageY - $(window).scrollTop();
			if (mouseX > 310) {
				$('.tt-emo-list-1').css('top',(position_lv1.top - 245 ));
			}else{
				$('.tt-emo-list-1').css('top',(position_lv1.top + 30 ));
			}
			
			$('.tt-emo-list-1').css('display','block');
			//Lấy ID của box bo quanh nút emo-btn-banhbao-master
			id_div_wrap = $(e.target).closest('.'+ class_wrap_emo_btn).attr('id');
			// gán ID cho box emo
			$('.tt-emo-list-1').attr('id','emo-'+ id_div_wrap);
		}
		else{
			$('.tt-emo-list-1').css('display','none');
		}
	}
    //END: banh bao
    
    //BEGIN: orange
    if (mouse_target_class_name != 'btn-emo-orange-master'){
		$('.tt-emo-list-2').css('display','none');
		
	}
	else{
		if ($('.tt-emo-list-2').css('display') == 'none'){
			position_lv1 = $(e.target).closest('.tt-emo').offset();
			//$('.tt-emo-list').css('left',(position_lv1.left) - 3);
			//Xác định vị trí của chuột so với window
			mouseX = e.pageY - $(window).scrollTop();
			if (mouseX > 310) {
				$('.tt-emo-list-2').css('top',(position_lv1.top - 245 ));
			}else{
				$('.tt-emo-list-2').css('top',(position_lv1.top + 30 ));
			}
			
			$('.tt-emo-list-2').css('display','block');
			//Lấy ID của box bo quanh nút emo-btn-orange-master
			id_div_wrap = $(e.target).closest('.'+ class_wrap_emo_btn).attr('id');
			// gán ID cho box emo
			$('.tt-emo-list-2').attr('id','emo-'+ id_div_wrap);
		}
		else{
			$('.tt-emo-list-2').css('display','none');
		}
	}
    //END: orange
    
    //BEGIN: emo news
    if (mouse_target_class_name != 'btn-emo-news-master'){
		$('.tt-emo-list-3').css('display','none');
		
	}
	else{
		if ($('.tt-emo-list-3').css('display') == 'none'){
			position_lv1 = $(e.target).closest('.tt-emo').offset();
			//$('.tt-emo-list').css('left',(position_lv1.left) - 3);
			//Xác định vị trí của chuột so với window
			mouseX = e.pageY - $(window).scrollTop();
			if (mouseX > 310) {
				$('.tt-emo-list-3').css('top',(position_lv1.top - 245 ));
			}else{
				$('.tt-emo-list-3').css('top',(position_lv1.top + 30 ));
			}
			
			$('.tt-emo-list-3').css('display','block');
			//Lấy ID của box bo quanh nút emo-btn-news-master
			id_div_wrap = $(e.target).closest('.'+ class_wrap_emo_btn).attr('id');
			// gán ID cho box emo
			$('.tt-emo-list-3').attr('id','emo-'+ id_div_wrap);
		}
		else{
			$('.tt-emo-list-3').css('display','none');
		}
	}
    //END: emo news
    
    
}


//add Emoticons to textarea
function add_emoticons_to_textarea(e){
	var 
		var_emoticon = $(e).attr('title'),
		textarea_val = jQuery.trim($('#' + id_div_wrap + ' textarea').val());
		
	if (textarea_val == '') { sp = '';}
	else {sp = ' ';	}
	$('#' + id_div_wrap + ' textarea').focus().val( textarea_val + sp + var_emoticon + sp);
}
