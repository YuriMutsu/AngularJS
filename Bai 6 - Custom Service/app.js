	'use strict';

	var app = angular.module('app', []);

	app.factory('myService', function(){

		var factory = {
			toLower: function(intput){
				if (!intput){
					return 'No Data';
				}else{
					return intput.toLowerCase();
				}
			},
			createUser : function(ten, dc, tuoi){
				var user = {name: ten, address: dc, age: tuoi};
				return user;
			}
		}

		return factory;
	});

	app.controller('myController', ['$scope','myService', function myController($scope, myService){
		$scope.toLower = function(intput){
			$scope.output = myService.toLower(intput);
		}
	}]);

	app.controller('userController', ['$scope', 'myService', function userController($scope, myService){
    	$scope.name = '';
		$scope.address = '';
		$scope.age = '';
	    
	    $scope.users = [
    		{name: "Minh Tai", address: "TP. HCM", age: 23},
    		myService.createUser("TMTAI", "HAU GIANG", 23)
    	];

    	$scope.createUser = function createUser(ten, dc, tuoi){
    		$scope.users = [
    			myService.createUser($scope.name, $scope.address, $scope.age)
    		];

    		return $scope.users;
    	};
	}]);

	