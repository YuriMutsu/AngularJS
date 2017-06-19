(function(){

	var app = angular.module('app',[]);

	app.controller('myController', function($scope, $rootScope){
		$rootScope.message="";

		$scope.username="";
		$scope.password="";
		$scope.page="";

		$scope.login = function(user, pass){
			if ($scope.username=="admin" && $scope.password=="123456"){
				$scope.page="infomation.html";
				$rootScope.message="Login Susscess";
			}else{
				$scope.page="#";
				$rootScope.message="Login Fail";
			}
		}
	});

	app.controller('processController', function($scope){
		var users = [
			{name: "Minh Tai", address:"TP. HCM", age:23}
		]

		$scope.name = "";
		$scope.address = "";
		$scope.age = "";
		
		$scope.users = users;
	});

})()