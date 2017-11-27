(function () {

    var app = angular.module("myApp", ['ngResource']);

    app.controller('LoginCtrl', ['$scope', '$rootScope', '$resource', function ($scope, $rootScope, $resource, $window) {

        console.info(JSON.stringify($rootScope.user));

        $scope.logout = function () {
            $resource('/logout').post(
                function (data) {
                    console.info(data);
                },
                function (err) {
                    console.error(err)
                });

        }

        $scope.doLogin = function ($rootScope) {
            $resource('/doLogin',
                {
                    username: $rootScope.username,
                    password: $rootScope.password
                },
                {
                    query: {
                        method: 'post',
                        isArray: false
                    }
                }).query().$promise.then(
                function (data) {
                    console.info(JSON.stringify(data));
                    alert(JSON.stringify(data));
                },
                function (err) {
                    console.error(err);
                }
            );
        }
    }]);

    app.controller('WapperCtrl', ['$scope', '$rootScope', function ($scope, $rootScope) {
        $scope.listItemTinTuc = ['1', '2', '3', '4', '5', '6', '7', '8'];

        $scope.listItemSidebar = ['1', '2', '3'];
    }]);

    app.controller('HeaderCtrl', ['$scope', '$rootScope', function ($scope, $rootScope) {
        $rootScope.user = {username: "", password: "", name: "TMTAI", role: ""};

    }]);

    app.controller('RegisterCtrl', ['$scope', '$rootScope', function ($scope, $rootScope){
        $scope.user = {};
        $scope.register = function (user) {
            alert(JSON.stringify(user));
            // $resource('/addUser',
            //     {user : user},
            //     {
            //         query : {
            //             method : 'post',
            //             isArray : false
            //         }
            //     }).query().$promise.then(
            //     function (data) {
            //
            //     },
            //     function (err) {
            //
            //     }
            // );
        }

    }]);

})()