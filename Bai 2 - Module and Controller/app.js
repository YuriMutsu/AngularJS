(function (){

	var app = angular.module('app', []);
	
	app.controller('myController', myController);
	
	myController.$inject = ['$scope'];
	
	function myController($scope){
		$scope.message = "AngularJS Tutorial";
		$scope.notify = "It's notify";
	}
	
})()