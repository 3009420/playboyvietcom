/**
 * Created with JetBrains PhpStorm.
 * User: betapcode
 * Date: 1/2/14
 * Time: 2:27 PM
 * To change this template use File | Settings | File Templates.
 */

app.controller("CategoryController",function($scope,$http){
    $scope.datas = [];
    //Begin: load danh sách category các trường thuộc chuyên mục miss học đường
    $http({method: 'JSONP', url: 'http://localhost/m.phototamtay.vn/api/listcatemiss/listcatemiss.json?callback=JSON_CALLBACK'}).
        success(function(data, status) {
            $scope.datas = data;
        }).
        error(function(data, status) {
            $scope.datas = data || "Request failed";
        });
    //$scope.quantity = 8;

});