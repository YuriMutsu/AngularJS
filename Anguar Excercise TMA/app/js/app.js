(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource']);

    app.factory('myService', ['$resource', function ($resource) {
        var factory = {
            fetchList: function (URI) {
                alert("Load Data Called")
                return $resource(URI).get({}, null);
            },

            addNew : function(URI, data, list){
                var max = 1;
                for (var i=0;i<list.length;i++){
                    if (parseInt(list[i]._id) > max) max = parseInt(list[i]._id);
                }
                return $resource(URI+(max+1)).save({id: (max+1), title : data.title, author: data.author, category: data.category, content: data.content},function(){

                });
            },
            update : function (URI, dataId, data) {
                return $resource(URI+dataId).save({id: dataId, title : data.title, author: data.author, category: data.category, content: data.content},function(){
                });
            },
            delete: function(URI, dataId){
                return $resource(URI+dataId).delete({id: dataId}, null);
            }
        };

        return factory;
    }]);

    app.controller('myController', ['$scope', '$mdDialog', 'myService', '$resource', function ($scope, $mdDialog, myService, $resource) {

        var REST_LIST_POEM_URI = 'http://localhost:9200/list/poem/_search';
        var REST_POEM_URI = 'http://localhost:9200/list/poem/';

        var REST_LIST_STORY_URI = 'http://localhost:9200/list/story/_search';
        var REST_STORY_URI = 'http://localhost:9200/list/story/';

        var REST_LIST_SONG_URI = 'http://localhost:9200/list/song/_search';
        var REST_SONG_URI = 'http://localhost:9200/list/song/';

        var REST_LIST_ALL_URI = "http://localhost:9200/list/_search";

        $scope.pageSearch = 'search.html';
        $scope.view = 'poem.html';
        $scope.select = "poem";

        $scope.customFullscreen = false;
        $scope.hideDetail = true;
        var position = -1;

        function loadData(URI){
            $scope.ListData = myService.fetchList(URI);
            $scope.view = 'poem.html';
            $scope.hideDetail = true;
            $scope.hideAdd = true;
        }

        loadData(REST_LIST_POEM_URI);
        //HIDE
        $scope.clickHide = function () {
            $scope.hideDetail = true;
        };

        $scope.hideAdd = true;

        function click(str){
            $scope.view = 'poem.html';
            $scope.hideDetail = true;
            $scope.hideAdd = true;
            $scope.select = str;
            if (str == "poem"){
                $scope.ListData = myService.fetchList(REST_LIST_POEM_URI);
                $scope.listCategory = ('Romantic Resistance Affection Poetry Fleer').split(' ').map(function (categoly) {
                    return {value: categoly};
                });
            }else if (str == "song"){
                $scope.ListData = myService.fetchList(REST_LIST_SONG_URI);
                $scope.listCategory = ('Pop Rock Jazz Blues R&B/Soul HipHop Country Dance').split(' ').map(function (categoly) {
                    return {value: categoly};
                });
            }else{
                $scope.ListData = myService.fetchList(REST_LIST_STORY_URI);
                $scope.listCategory = ('Adventure Legend').split(' ').map(function (categoly) {
                    return {value: categoly};
                });
            }
        }

        $scope.listCategory = ('Romantic Resistance Affection Poetry Fleer').split(' ').map(function (categoly) {
            return {value: categoly};
        });

        $scope.clickPoem = function () {
            click("poem");
        };

        $scope.clickSong = function () {
            click("song");
        };

        $scope.clickStory = function () {
            click("story");
        };

        $scope.showPageAdd = function () {
            $scope.data = {id: '', title: '', author: '', category: 'Romantic', content: ''};
            $scope.hideDetail = true;
            if ($scope.hideAdd == true) {
                $scope.hideAdd = false;
            } else {
                $scope.hideAdd = true;
            }
        };

        $scope.clickDetail = function (id) {
            $scope.hideAdd = true;

            if (position != id) {
                $scope.hideDetail = false;
                position = id;
            } else {
                $scope.hideDetail = !$scope.hideDetail;
            }
            for (var i = 0; i < $scope.ListData.hits.hits.length; i++) {
                if (id == $scope.ListData.hits.hits[i]._id) {
                    $scope.data.id = $scope.ListData.hits.hits[i]._source.id;
                    $scope.data.title = $scope.ListData.hits.hits[i]._source.title;
                    $scope.data.author = $scope.ListData.hits.hits[i]._source.author;
                    $scope.data.category = $scope.ListData.hits.hits[i]._source.category;
                    $scope.data.content = $scope.ListData.hits.hits[i]._source.content;
                }
            }
        };

        $scope.data = {id : '', title: '', author: '', category: 'Romantic', content: ''};
        // ================== CRUD ======================= //

        // ========= UPDATE ========= //
        $scope.updatePoem = function (id, data) {
            if ($scope.select == "poem") {
                myService.update(REST_POEM_URI, id, data );
                loadData(REST_LIST_POEM_URI);
                alert("Update Complete");
            } else if ($scope.select == "song") {
                myService.update(REST_SONG_URI, id, data);
                alert("Update Complete");
            } else {
                myService.update(REST_STORY_URI, id, data);
                alert("Update Complete");
            }
            $scope.hideDetail = true;
        };

        // ========= DELETE ========= //
        $scope.clickDelete = function (id) {
            var confirm = $mdDialog.confirm()
                .title('Would you like to delete')
                .ok('YES')
                .cancel('I think again');

            $mdDialog.show(confirm).then(
                function () {
                    if ($scope.select == "poem") {
                        myService.delete(REST_POEM_URI, id);
                        $scope.ListData = myService.fetchList(REST_LIST_POEM_URI);
                    } else if ($scope.select == "song") {
                        myService.delete(REST_SONG_URI, id);
                        $scope.ListData = myService.fetchList(REST_LIST_SONG_URI);
                    } else {
                        myService.delete(REST_STORY_URI, id);
                        $scope.ListData = myService.fetchList(REST_LIST_STORY_URI);
                    }
                },
                function () {

                }

            );
        };

        // ========= SUBMIT ADD ========= //
        $scope.submitAdd = function (data, list) {
            if ($scope.select == "poem") {
                myService.addNew(REST_POEM_URI, data, list);
                loadData(REST_LIST_POEM_URI);
                alert("Add New Poem Complete !");
            } else if ($scope.select == "song") {
                myService.addNew(REST_SONG_URI, data, list);
                loadData(REST_LIST_SONG_URI);
                alert("Add New Song Complete !");
            } else {
                myService.addNew(REST_STORY_URI, data, list);
                loadData(REST_LIST_STORY_URI);
                alert("Add New Story Complete !");
            }
            $scope.hideAdd = true;
        };



        // ================== SEARCH ======================= //
        $scope.clickSearch = function () {
            $scope.hideSearch = false;
            $scope.view = $scope.pageSearch;

            $scope.listAll = myService.fetchList(REST_LIST_ALL_URI);
        };

        $scope.hidenTable = true;
        $scope.term = '';
        $scope.criteria = '';

        $scope.selection = ('Title Author Category Content').split(' ').map(function (select) {
            return {value: select};
        });

        $scope.submitSearch = function () {
            $scope.list = [];
            if ($scope.term != null && $scope.term != ""){
                for (var i=0;i<$scope.listAll.hits.hits.length;i++){
                    if ($scope.criteria == "Title") {
                        if ($scope.listAll.hits.hits[i]._source.title.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listAll.hits.hits[i]);
                        }
                    } else if ($scope.criteria == "Author") {
                        if ($scope.listAll.hits.hits[i]._source.author.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listAll.hits.hits[i]);
                        }
                    } else if ($scope.criteria == "Category") {
                        if ($scope.listAll.hits.hits[i]._source.category.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listAll.hits.hits[i]);
                        }
                    } else {
                        if ($scope.listAll.hits.hits[i]._source.content.toUpperCase().search($scope.term.toUpperCase()) > -1) {
                            $scope.list.push($scope.listAll.hits.hits[i]);
                        }
                    }
                }
                $scope.hidenTable = false;
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
    }]);
})()


