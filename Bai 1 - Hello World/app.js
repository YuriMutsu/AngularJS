(function (){

	var app = angular.module('app', []);
	
	app.controller('myController', ['$scope', function($scope){
		$scope.message = "AngularJS Tutorial";
			
			$scope.click = function(){
				$scope.name = "Hello " + $scope.name;
				alert($scope.name);
			}
	}]);
	
})()