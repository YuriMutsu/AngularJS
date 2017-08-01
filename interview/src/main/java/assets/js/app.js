(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource', 'ngMessages', 'ngCookies']);

    app.config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('dark-grey').backgroundPalette('grey').dark();
    });

    app.run(function ($rootScope, $resource, $location, $cookies, $mdToast, $mdMenu, $mdDialog) {
    });

    app.controller("HomeCtrl", ['$scope', '$rootScope', '$cookies', '$mdToast', function ($scope, $rootScope, $cookies, $mdToast) {

    }]);
})()


