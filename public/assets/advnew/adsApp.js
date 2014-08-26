$ = jQuery.noConflict();

$(document).ready(function() {
    var head = document.getElementsByTagName('head')[0];
    var loadcss = document.createElement('link');
    loadcss.rel = 'stylesheet';
    loadcss.type = 'text/css';
    loadcss.href = 'http://playboyviet.com/public/advnew/adsjs.css';
    loadcss.media = 'all';
    head.appendChild(loadcss);

    var dateAds = "";
    //
    dateAds += ' <div class="download tn-hhapp-bx-bpx">' +
           '<a class="apple" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"><img src="http://playboyviet.com/public/advnew/icon-dowload.gif" width="100" height="300" alt="appstore"></a>' +
            '<p class="pull-left text_download_app">Tải ứng dụng</p>' +
            ' <a class="apple" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"></a>' +
            '<a class="android" target="_blank" href="https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"></a>' +
            '<a class="window" target="_blank" href="http://www.windowsphone.com/en-us/store/app/playboyviet/2820e163-f66e-4cae-823d-ea256716d385/xap?apptype=regular"></a>' +
            '</div>';
//    $("body").append(dateAds);
    $("#display3232").before(dateAds);
});

