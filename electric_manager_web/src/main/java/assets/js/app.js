(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource', 'ngMessages', 'ngCookies']);

    app.config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('dark-grey').backgroundPalette('grey').dark();
    });

    app.controller('HomeCtrl', ['$scope', '$rootScope', '$cookies', '$resource', function ($scope, $rootScope, $cookies, $resource) {
        $resource('/getKhuVuc',
            {},
            {
                query: {
                    method: 'get',
                    isArray: true
                }
            }).query().$promise.then(
                function (data) {
                    $scope.khuvuc = data;
                },
                function (err) {
                    console.info(err);
                }
        );

        $resource('/getThanhPho',
            {},
            {
                query: {
                    method: 'get',
                    isArray: true
                }
            }).query().$promise.then(
            function (data) {
                $scope.thanhpho = data;
            },
            function (err) {
                console.info(err);
            }
        );
    }]);
})()


