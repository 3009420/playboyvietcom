/**
 * Created with JetBrains PhpStorm.
 * User: betapcode
 * Date: 1/2/14
 * Time: 3:40 PM
 * To change this template use File | Settings | File Templates.
 */

app.controller("HomeController",function($scope,$http){
    $scope.datas = [];
    //Begin: load danh sách category các trường thuộc chuyên mục miss học đường
    $http({method: 'JSONP', url: '/home/loaditem?callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.items = data;
        }).
        error(function(data, status) {
            $scope.items = data || "Request failed";
        });


    //helper js
    $scope.serverImg = function(serverid){
        if (serverid == 1){
            return 'http://img.tamtay.vn';
        }
        return 'http://img' + serverid + '.tamtay.vn';
    };

});