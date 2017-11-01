(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource', 'ngMessages']);
	
	 app.controller('HomeCtrl', ['$scope', function ($scope) {
        $scope.list = [1, 2, 3, 4, 5];

        $scope.send = function(user){
            alert(user.name);
            alert(user.password);
        }
    }]);
})()


