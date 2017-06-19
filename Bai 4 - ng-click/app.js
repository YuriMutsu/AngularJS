(function(){

	var app = angular.module('app', []);

	app.controller('myController', function($scope){
		var technoloies = [
			{name: "JAVA", likes:0, dislikes:0},
			{name: "C++", likes:0, dislikes:0},
			{name: ".NET", likes:0, dislikes:0},
			{name: "SQL Server", likes:0, dislikes:0}
		]

		$scope.technoloies = technoloies;

		$scope.onClickLike = function(tec){
			tec.likes++;
		}

		$scope.onClickDisLike = function(tec){
			tec.dislikes++;
		}
	});

})()