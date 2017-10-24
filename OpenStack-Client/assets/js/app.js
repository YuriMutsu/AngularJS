var app = angular.module('myApp', ['ngAnimate', 'ngMaterial', 'ngResource', 'ngMessages', 'ngCookies']);

app.controller('HomeCtrl', ['$scope', '$resource', '$http', '$mdDialog', '$rootScope', function ($scope, $resource, $http,  $mdDialog, $rootScope) {
    $rootScope.http = "";
    var urlGetVMs = 'http://localhost:8080/getVMs';
    var urlGetNetworks = 'http://localhost:8080/getNetworks';
    var urlGetUsers = 'http://localhost:8080/getUsers';
    var urlGetFlavors = 'http://localhost:8080/getFlavors';
    var urlGetOpenstack = 'http://localhost:8080/getOpenstackURLs';
    $scope.URL = "135.249.42.29";

    $scope.right = true;

    $scope.menuItems = ['Users', 'Stores'];

    $scope.onMenuItemClicked = function(i){
        if (i == 'Users'){
            $scope.right = true;
        }else{
            $scope.right = false;
        }
    }

    $http.get(urlGetOpenstack).then(
        function (data) {
            $rootScope.openstackURLs = data.data;
            console.info($rootScope.openstackURLs);
        },
        function (err) {
            console.error(err);
        }
    );

    $http.get(urlGetVMs).then(
        function (data) {
            $scope.listVMs = data.data;
            console.info($scope.listVMs);
            $scope.hideSearch = true;
        },
        function (err) {
            console.error(err);
        }
    );

    $http.get(urlGetNetworks).then(
        function (data) {
            $scope.listNetworks = data.data;
            console.info($scope.listNetworks);
            $scope.hideListIPs = true;
        },
        function (err) {
            console.error(err);
        }
    );

    $http.get(urlGetUsers).then(
        function (data) {
            $scope.listUsers = data.data;
            console.info($scope.listUsers);
            $scope.hideListUsers = true;
        },
        function (err) {
            console.error(err);
        }
    );

    $http.get(urlGetFlavors).then(
        function (data) {
            $scope.listFlavors = data.data;
            console.info($scope.listFlavors);
            $scope.hidelistFlavors = true;
        },
        function (err) {
            console.error(err);
        }
    );

    $scope.getSelectedText = function() {
        if ($scope.listNetworks != 'undefinded') {
            for (var i=0;i<$scope.listNetworks.length;i++){
                if ($scope.listNetworks[i].name == $scope.networkSelect){
                    $scope.listSubnets = $scope.listNetworks[i].subnets;
                }
            }
        }
        return $scope.networkSelect;
    }

    $scope.getSelectedOpenstackURL = function() {
        return $scope.URL;
    }

    $scope.typeList = ['IP=', 'status=', 'availabilityzone=', 'tenant name=', 'user name='];
    $scope.search = function(){
        $scope.input = $scope.typeSelect + $scope.textSearch;
    }

    $scope.showNewOpenstackURL = function(ev){
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'assets/html/newOpenstackURL.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true,
        });
    }

    function DialogController($scope, $mdDialog, $rootScope) {
        $rootScope.newURL = "";
        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };

        $scope.addNewOpenstackURL = function () {
            alert($rootScope.newURL);
            $mdDialog.cancel();
        }
    }
}]);
