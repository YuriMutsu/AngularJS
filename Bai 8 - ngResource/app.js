var app = angular.module('app', []);

// app.config(['$resourceProvider', function($resourceProvider) {
//   // Don't strip trailing slashes from calculated URLs
//   $resourceProvider.defaults.stripTrailingSlashes = false;
// }]);

app.factory('myService', ['$http', '$q', function($http, $q) {
        var REST_SERVICE_URI = 'http://localhost:9200/list/poem/_search';

        var factory = {
            fetchAllPoems : function () {
                var deferred = $q.defer();
                $http.get(REST_SERVICE_URI).then(
                    function (reponse) {
                        deferred.resolve(reponse.data);
                    },
                    function (errReponse) {
                        console.error('Error while fetching Poems');
                        deferred.reject(errResponse);
                    }
                );
                return deferred.promise;
            },

            addNewPoem : function () {
            	
            },

            updatePoem : function () {

            },

            deletePoem : function () {

            }
        };

        return factory;
    }]);


app.controller('myController', ['$scope', 'myService', function($scope, myService){

	$scope.entries = [];

	fetchAllPoems();

	function fetchAllPoems(){
        myService.fetchAllPoems()
            .then(
            function(d) {
                $scope.entries = d.hits.hits;
            },
            function(errResponse){
                console.error('Error while fetching Users');
            }
        );
    }


}]);