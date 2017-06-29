(function () {

    var app = angular.module("myApp", ['ngMaterial']);

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

    app.controller('myController', ['$scope', 'myService',function ($scope, myService) {

        $scope.pageAdd = 'add.html';
        $scope.pagePoem = 'poem.html';
        $scope.pageSearch = 'search.html';

        $scope.view = 'poem.html';

        $scope.clickPoem = function () {
            $scope.view = 'poem.html';
        };

        $scope.clickSearch = function () {
            $scope.view = 'search.html';
        };

        fetchAllPoems();

        function fetchAllPoems(){
            myService.fetchAllPoems()
                .then(
                    function(d) {
                        $scope.listPoem = d.hits.hits;
                    },
                    function(errResponse){
                        console.error('Error while fetching Users');
                    }
                );
        }

        $scope.clickClear = function () {
            $scope.view = '';
        };

        $scope.clickDetail = function (id) {
            for (var i = 0; i < $scope.listPoem.length; i++) {
                if ($scope.listPoem[i].id == id) {
                    $scope.poem = angular.copy($scope.listPoem[i]);
                    break;
                }
            }
        };

        $scope.clickDelete = function (id) {
            for (var i = 0; i < $scope.listPoem.length; i++) {
                if ($scope.listPoem[i].id == id) {
                    //remove Element
                    $scope.listPoem.splice(i, 1);
                    break;
                }
            }
        };

    }]);

    // POEM CONTROLLER
    app.controller('poemController', ['$scope', '$http', function ($scope, $http) {

    }]);

    // ADD CONTROLLER
    app.controller('addController', ['$scope', function ($scope) {
        $scope.poem = {id: '', title: '', author: '', category: 'Romantic', content: ''};
        $scope.listPoem = [
            {
                id: 1,
                title: "Song",
                author: "Xuan Quynh",
                category: "Poetry",
                content: "Song bat dau tu gio, gio bat dau tu dau ....."
            },
            {id: 2, title: "Viet Bac", author: "To Huu", category: "Poetry", content: "Ta ve minh co nho ta ....."},
            {id: 3, title: "Tu Ay", author: "To Huu", category: "Poetry", content: "Tu ay trong toi bung nang ha ....."}
        ];
        $scope.pageIndex = 'index.html';

        $scope.listCategory = ('Romantic Resistance Affection Poetry Fleer').split(' ').map(function (categoly) {
            return {value: categoly};
        });

        $scope.submitAdd = function () {
            $scope.poem.id = $scope.poem.id + 1;
            $scope.listPoem.push($scope.poem);
        };
    }]);

    // SEARCH CONTROLLER
    app.controller('searchController', ['$scope', 'myService', function ($scope, myService) {
        $scope.poem = {id: '', title: '', author: '', category: 'Romantic', content: ''};
        $scope.hidenTable = true;

        $scope.term = "";
        $scope.criteria = "Title";

        fetchAllPoems();

        function fetchAllPoems(){
            myService.fetchAllPoems()
                .then(
                    function(d) {
                        $scope.listPoem = d.hits.hits;
                    },
                    function(errResponse){
                        console.error('Error while fetching Users');
                    }
                );
        }

        $scope.hide = true;
        $scope.list = [];

        $scope.selection = ('Title Author Category Content').split(' ').map(function (select) {
            return {value: select};
        });

        $scope.submitSearch = function () {
            for (var i = 0; i < $scope.listPoem.length; i++) {
                if ($scope.term != null && $scope.term != "") {
                    if ($scope.criteria == "Title") {
                        if ($scope.listPoem[i]._source.title.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listPoem[i]);
                        }
                    } else if ($scope.criteria == "Author") {
                        if ($scope.listPoem[i]._source.author.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listPoem[i]);
                        }
                    } else if ($scope.criteria == "Category") {
                        if ($scope.listPoem[i]._source.category.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listPoem[i]);
                        }
                    } else {
                        if ($scope.listPoem[i]._source.content.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listPoem[i]);
                        }
                    }
                    $scope.hide = false;
                }
            }
        };
    }])
})()