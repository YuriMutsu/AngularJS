(function (){

	var app = angular.module('app', []);
	
	app.controller('myController', myController);
	
	filterDemoCtrl.$inject = ['$scope'];
	
	myController = function($scope){
		$scope.message = "AngularJS Tutorial";
	}
	
})()