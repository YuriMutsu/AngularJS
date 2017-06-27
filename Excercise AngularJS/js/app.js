(function(){

	var app = angular.module("myApp", []);

	app.controller('myController', ['$scope', function($scope){

		$scope.poem = {id:'', title: '', author: '', category: 'Romantic', content:''};
		$scope.term = "";
		$scope.criteria = "Title";
		$scope.listPoem = [
			{ id:1, title: "Song", author: "Xuan Quynh", category: "Poetry", content: "Song bat dau tu gio, gio bat dau tu dau ....." },
			{ id:2, title: "Viet Bac", author: "To Huu", category: "Poetry", content: "Ta ve minh co nho ta ....." },
			{ id:3, title: "Tu Ay", author: "To Huu", category: "Poetry", content: "Tu ay trong toi bung nang ha ....." }
		];
		$scope.view = 'poem.html';
		$scope.clickPoem = function(){
			$scope.view = 'poem.html';
		};


		$scope.clickSearch = function(){
			$scope.view = 'search.html';
		};

		$scope.clickClear = function(){
			$scope.view = '';
		};

		$scope.clickDetail = function(id){
			for (var i = 0; i<$scope.listPoem.length; i++){
				if ($scope.listPoem[i].id == id){
					$scope.poem = angular.copy($scope.listPoem[i]);
					break;
				}
			}
		};

		$scope.clickDelete = function(id){
			for (var i = 0; i<$scope.listPoem.length; i++){
				if ($scope.listPoem[i].id == id){
					//remove Element
					 $scope.listPoem.splice(i,1);
					 break;
				}
			}
		};


		$scope.submit = function(){
			$scope.poem.id = $scope.poem.id + 1;
			$scope.listPoem.push($scope.poem);
			alert("Submit");
		};

	}]);


})()