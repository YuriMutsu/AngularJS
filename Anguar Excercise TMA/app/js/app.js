(function () {

    var app = angular.module("myApp", ['ngMaterial']);

    app.factory('myService', ['$http', '$q', function($http, $q) {
        var REST_SERVICE_URI = 'http://localhost:9200/list/poem/_search';
        var REST_URI = 'http://localhost:9200/list/poem/';
        var factory = {
            fetchAllPoems : function () {
                var deferred = $q.defer();
                $http.get(REST_SERVICE_URI).then(
                    function (response) {
                        deferred.resolve(response.data);
                    },
                    function (errResponse) {
                        console.error('Error while fetching Poems');
                        deferred.reject(errResponse);
                    }
                );
                return deferred.promise;
            },

            addNewPoem : function (poem, list) {
                var deferred = $q.defer();
                if (list == ""){
                    list.length = 0;
                }
                var max = 0;
                for (var i=0;i<list.length;i++){
                    if (parseInt(list[i]._id) > max )
                        max = parseInt(list[i]._id);
                }

                $http.post(REST_URI+(max+1), poem).then(
                    function (response) {
                        deferred.resolve(response.data);
                    },
                    function (errResponse) {
                        console.error('Error while fetching Poems');
                        deferred.reject(errResponse);
                    }
                );
                return deferred.promise;
            },

            updatePoem : function (poem, id) {
                var deferred = $q.defer();
                $http.put(REST_URI+id, poem).then(
                    function (response) {
                        deferred.resolve(response.data);
                    },
                    function (errResponse) {
                        console.error('Error while fetching Poems');
                        deferred.reject(errResponse);
                    }
                );
                return deferred.promise;
            },

            deletePoem : function (id) {
                var deferred = $q.defer();
                $http.delete(REST_URI+id).then(
                    function (reponse) {
                        deferred.resolve(reponse.data);
                    },
                    function (errResponse) {
                        console.error('Error while fetching Poems');
                        deferred.reject(errResponse);
                    }
                );
                return deferred.promise;
            }
        };

        return factory;
    }]);

    app.controller('myController', ['$scope', '$mdDialog' , 'myService',function ($scope, $mdDialog,myService) {

        $scope.pageAdd = 'add.html';
        $scope.pagePoem = 'poem.html';
        $scope.pageSearch = 'search.html';
        $scope.view = 'poem.html';

        $scope.customFullscreen = false;

        $scope.poem = {title: '', author: '', category: 'Romantic', content: ''};

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
                        console.error('Error while fetching Poems');
                    }
                );
        }


        $scope.listCategory = ('Romantic Resistance Affection Poetry Fleer').split(' ').map(function (categoly) {
            return {value: categoly};
        });

        $scope.showPageAdd = function(ev){
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'add.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true
            }).then(
                function (answer) {
                },
                function() {
                    $scope.status = 'You cancelled the dialog.';
                    fetchAllPoems();
                }
            );
        };

        function DialogController($scope, $mdDialog) {
            $scope.hide = function() {
                $mdDialog.hide();
            };

            $scope.cancel = function() {
                $mdDialog.cancel();
            };

            $scope.answer = function(answer) {

            };
        }

        $scope.hideDetail = true;
        var position = -1;

        $scope.clickDetail = function (id) {
            if (position != id){
                $scope.hideDetail = false;
                position = id;
            }else{
                $scope.hideDetail = !$scope.hideDetail;
            }

            for (var i =0 ; i<$scope.listPoem.length;i++){
                if (id == $scope.listPoem[i]._id){
                    $scope.poem.title = $scope.listPoem[i]._source.title;
                    $scope.poem.author = $scope.listPoem[i]._source.author;
                    $scope.poem.category = $scope.listPoem[i]._source.category;
                    $scope.poem.content = $scope.listPoem[i]._source.content;
                }
            }
        };

        $scope.updatePoem = function (poem) {
            myService.updatePoem(poem, position).then(
                function () {
                    fetchAllPoems();
                    alert("Update Complete!");
                },
                function (errResponse) {
                    console.error("ERROR while UPDATE POEM");
                }
            );
        };

        $scope.clickHide = function () {
            $scope.hideDetail = true;
        };

        $scope.clickDelete = function (id) {
            var confirm = $mdDialog.confirm()
                .title('Would you like to delete your poem')
                .ariaLabel('Lucky day')
                .ok('YES')
                .cancel('I think again');

            $mdDialog.show(confirm).then(function() {
                myService.deletePoem(id).then(
                    function () {
                        fetchAllPoems();
                    },
                    function (errReponse) {
                        console.error('Error while fetching Poems');
                        fetchAllPoems();
                    }
                );
            }, function() {
                $scope.status = 'You decided to keep your debt.';
            });



        };

        $scope.submitAdd = function (poem, list) {
            myService.addNewPoem(poem, list).then(
                function () {
                    fetchAllPoems();
                    alert("Add Complete");
                },
                function(errResponse){
                    console.error('Error while creating Poems');
                }
            );
        };

    }]);

    // SEARCH CONTROLLER
    app.controller('searchController', ['$scope',  '$mdDialog', 'myService', function ($scope, $mdDialog, myService) {
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
                }else{
                    $mdDialog.show(
                        $mdDialog.alert()
                            .parent(angular.element(document.querySelector('#popupContainer')))
                            .clickOutsideToClose(true)
                            .title('Term is empty')
                            .textContent('You should not leave Term blank')
                            .ok('Retry')
                    );
                }
            }
        };
    }])
})()