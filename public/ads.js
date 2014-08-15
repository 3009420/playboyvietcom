$ = jQuery.noConflict();

$(document).ready(function() {
    var head = document.getElementsByTagName('head')[0];
    var loadcss = document.createElement('link');
    loadcss.rel = 'stylesheet';
    loadcss.type = 'text/css';
    loadcss.href = 'http://clipplayboy.com/public/css/helloAdsStyle.css';
    loadcss.media = 'all';
    head.appendChild(loadcss);
    var listLink = new Array();
    listLink["https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn#"] = "Click Download App android";
    listLink["https://play.google.com/store/apps/details?id=com.playboyviet.alatca.vn"] = "Click Download App android";
    listLink["http://dowsphone.com/en-us/store/app/playboyviet/2820e163-f66e-4cae-823d-ea256716d385/xap?apptype=regular"] = "Click Download App Windows Phone";
	
    var dateAds = "";
    //
    dateAds += '<div class="bgtran"></div><div class="flagclassapp"><div id="app">' +
            '<div class="title">' +
            '<h3>dowload app <img onclick="closepopupads();"; src="http://clipplayboy.com/public/css/img/icon.png" alt=""></h3>' +
            '</div>' +
            '<div class="app">';
    var key;
    var index = 0;
    var checkclass = "";

    for (key in listLink) {
        if (index == 0) {
            checkclass = "ios";
        }
        else if (index == 1) {
            checkclass = "android";
        }
        else {
            checkclass = "windows";
        }
        dateAds += '<div id="' + checkclass + '">' +
                '<a class="' + checkclass + '" href="' + key + '" title="' + listLink[key] + '"></a>' +
                '<p>' + listLink[key] + '</p>' +
                '</div>';

        index++;
    }


    dateAds += '</div>' +
            '</div></div>';
    //
    $("body").append(dateAds);
    $(".bgtran").hide();
    $("#app").hide();
    var adshello = sessionStorage.flag;
    if (adshello == null) {
        setTimeout(function() {
            $(".bgtran").show();
            $("#app").show();
        }, 2000);
    } else {
        $(".bgtran").hide();
        $("#app").hide();
    }
});
function closepopupads() {
    $(".bgtran").hide();
    $("#app").hide();
    sessionStorage.flag = "Tat roi thi thoi.Khong hien nua.";
}
;
