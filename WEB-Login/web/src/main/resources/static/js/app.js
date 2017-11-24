(function () {

    var app = angular.module("myApp", ['ngResource']);

    app.controller('LoginCtrl', ['$scope', '$rootScope', '$resource', function ($scope, $rootScope, $resource) {
        $scope.user = {username: "", password: ""};

        // $resource('/users',
        //     {},
        //     {
        //         query: {
        //             method: 'get',
        //             isArray: true
        //         }
        //     }).query().$promise.then(
        //     function (data) {
        // 	console.info(JSON.stringify(data));
        //     },
        //     function (err) {
        //         console.info(err);
        //     }
        // );

        $scope.logout = function () {
            $resource('/logout').post(
                function (data) {
                    console.info(data);
                },
                function (err) {
                    console.error(err)
                });

        }
    }]);
})()