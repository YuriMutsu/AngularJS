var app = angular.module('app', []);

app.controller('messageController', function($scope){

		$scope.showMessage = function(){
			alert("Hello world");
		};
});

app.directive('message', function(){

	return{
		// A: attrs
		// C: class
		// E: elelemt
		restrict : "E",
		link : function(scope, elelemt, attrs){
			elelemt.bind("mouseenter", function(){
				scope.showMessage();
			});
		}
	}
});