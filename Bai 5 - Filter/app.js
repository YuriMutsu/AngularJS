(function (){

	var app = angular.module('app', []);

	app.controller('myController', function($scope){

		var products = [
			{name:"SamSung A5", date: new Date('12/01/2016'),price:"1200"},

			{name:"SamSung A7", date: new Date("05/25/2016"),price:"1560"},

			{name:"Asus", date: new Date("05/05/2013"),price:"800"}
		]

		$scope.row ="";

		$scope.products = products;

		$scope.sortColumn = 'name';

		$scope.reverse = false;

		$scope.sortData = function(column){
			if ($scope.sortColumn == column){
				$scope.reverse = !$scope.reverse;
			}
			else{
				$scope.reverse = false;
			}
			$scope.sortColumn = column;
		}

		$scope.getSortClass = function(column){
			if ($scope.sortColumn == column){
				return $scope.reverse ? 'arrow-up' : 'arrow-down';
			}
			return '';
		}
	});




})()