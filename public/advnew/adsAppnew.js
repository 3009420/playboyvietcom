$ = jQuery.noConflict();

$(document).ready(function() {
    var head = document.getElementsByTagName('head')[0];
    var loadcss = document.createElement('link');
    loadcss.rel = 'stylesheet';
    loadcss.type = 'text/css';
    loadcss.href = 'http://playboyviet.com/public/advnew/advnew.css';
    loadcss.media = 'all';
    head.appendChild(loadcss);

    var dowloadapp ="";
     dowloadapp +=' <div class="box_div_right_view">'+
	    '<h3 class="title_h1_st2">Mời Tải ứng dụng</h3>'+
	     '<div class="tn-hhapp-bx">'+
	        '<a class="apple" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"><img src="http://playboyviet.com/public/advnew/icon-downloadapp.gif" width="100" height="29px" alt="appstore"></a>' +
	        '<a class="apple" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"><img src="http://playboyviet.com/public/advnew/appstore-app.png" width="60" height="64" alt="appstore"></a>' +
	         '<a class="android" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"><img src="http://playboyviet.com/public/advnew/playstore-app.png" width="60" height="64" alt=""></a>'+
	         '<a class="window" target="_blank" href="http://www.windowsphone.com/en-us/store/app/playboyviet/2820e163-f66e-4cae-823d-ea256716d385/xap?apptype=regular"><img src="http://playboyviet.com/public/advnew/windowsphone-app.png" width="64" height="64" alt=""></a>'
	         '</div></div>';
    //$("body").append(dowloadapp);
     $("#displadv").before(dowloadapp);
});

