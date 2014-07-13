$(document).ready(function(){
	getContentdetailfull(1);
	$('#search').click(function(){
		getContentdetailfull(1);
    });
    $('#reset').click(function(){
    	$('#keyword').val('');
    	getContentdetailfull(1);
    });
	$('#keyword').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
        	getContentdetailfull(1); return false;
        }
 });
}); 

function deleteContentdetailfull(contentdetailfullId){
	if(confirm('Bạn có chắc chắn muốn xóa dữ liệu này không? Dữ liệu sẽ bị xóa và không thể phục hồi!')){
		$('#loading').show();
		$('#'+contentdetailfullId).hide("slow");
		$.ajax({
            url: $("#contentdetailfullUrl").val(),
            cache: false,
            type: "POST",
            data: "do=delete&id="+contentdetailfullId,           
            success: function(serverData){
            	$('#loading').hide();
            }
        });
	}
}

function getContentdetailfull(page){
	var ajaxData = $('#frmList').serialize()+"&do=list&page="+page;
	$('#loading').show();
	$.ajax({
        url: $("#contentdetailfullUrl").val(),
        cache: false,
        type: "POST",
        data: ajaxData,           
        success: function(serverData){
        	$('#loading').hide();
        	$('#contentdetailfullArea').html(serverData);
        }
      });
}
function buildNavigator(page,currentForm){
	getContentdetailfull(page);
}
