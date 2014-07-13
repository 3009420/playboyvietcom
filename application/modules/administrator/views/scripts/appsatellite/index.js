$(document).ready(function(){
	getAppsatellite(1);
	$('#search').click(function(){
		getAppsatellite(1);
    });
    $('#reset').click(function(){
    	$('#keyword').val('');
    	getAppsatellite(1);
    });
	$('#keyword').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
        	getAppsatellite(1); return false;
        }
 });
}); 

function deleteAppsatellite(AppsatelliteId){
	if(confirm('Bạn có chắc chắn muốn xóa dữ liệu này không? Dữ liệu sẽ bị xóa và không thể phục hồi!')){
		$('#loading').show();
		$('#'+AppsatelliteId).hide("slow");
		$.ajax({
            url: $("#AppsatelliteUrl").val(),
            cache: false,
            type: "POST",
            data: "do=delete&id="+AppsatelliteId,           
            success: function(serverData){
            	$('#loading').hide();
            }
        });
	}
}

function getAppsatellite(page){
	var ajaxData = $('#frmList').serialize()+"&do=list&page="+page;
	$('#loading').show();
	$.ajax({
        url: $("#AppsatelliteUrl").val(),
        cache: false,
        type: "POST",
        data: ajaxData,           
        success: function(serverData){
        	$('#loading').hide();
        	$('#AppsatelliteArea').html(serverData);
        }
      });
}
function buildNavigator(page,currentForm){
	getAppsatellite(page);
}
