(function(){

	var app = angular.module("myApp", ['ngResource']);

	app.controller('LoginCtrl', ['$scope', '$resource', function($scope, $resource){
		$scope.user = {username : "", password : ""};

        $resource('/users',
            {},
            {
                query: {
                    method: 'get',
                    isArray: true
                }
            }).query().$promise.then(
            function (data) {
				console.info(JSON.stringify(data));
            },
            function (err) {
                console.info(err);
            }
        );
	}]);
})()