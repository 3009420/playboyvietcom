$(document).ready(function()
{

//$(".sttext").livequery(function () { $(this).linkify({
//    target: "_blank"
//}); });

$.getJSON("http://127.0.0.1/playboyviet.com/public/cache/appsatellitedetailread.json", function(data)
{  			 
/*
      var array = data.Messages;	        	
			
	            $.each(array, function(i , employee){
	              alert(JSON.stringify(employee));
				 });
*/
var totalCount=5;
var jsondata='';
$.each(data.Messages, function(i, M)
{
var num = Math.ceil( Math.random() * totalCount );
var i = Math.random();
jsondata +='<div class="stbody"><span class="timeline_square color'+num+'"></span><div class="stimg"><img src="'+M.src+'" /></div>'
             +'<div class="sttext"><span class="stdelete" title="Delete">X</span><b>'+M.i+'</b><br/>'+M.content_detail
             +'<div class="sttime"><img src="'+M.src+'" style="width:100%;height:auto; border-radius:1px solid white;padding:5px;" /></div><div class="stexpand">Playboy Viet</div></div></div>';
});
$(jsondata).appendTo("#updates");

});

$('body').on("click",".stdelete",function()
{
var A=$(this).parent().parent();
A.addClass("effectHinge");
A.delay(500).fadeOut("slow",function(){
$(this).remove();
});
});


});