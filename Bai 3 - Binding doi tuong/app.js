(function (){

	var app = angular.module('app', []);
	
	app.controller('myController', myController);
	
	myController.$inject = ['$scope'];
	
	function myController($scope){
		var emp = {
			name: "Minh Tai",
			address: "Tp. HCM",
			age: "23",
		}

		$scope.employee = emp;
	}

	app.controller('mycontroller2', function($scope){
		var emp = {
			name: "",
			address: "",
			age: "",
		}

		$scope.employee = emp;
	})
	
})()