(function() {

	var app = angular.module("myApp", [ 'ngResource' ]);
	
	app.factory('myService', ['$resource', function($resource){
		var factory = {
			pagination : function(uri, list, noOfPages, currentPage, numPerPage, setPage){
				$resource(uri,
			            {},
			            {
			                query: {
			                    method: 'get',
			                    isArray: true
			                }
			            }).query(
			            	function(data){
			            		numPerPage = 6;
			            		noOfPages = Math.ceil(data.length / numPerPage);
			            		currentPage = 1;

			            		setPage = function () {
			            			var offset = (currentPage - 1) * numPerPage;
									var limit = numPerPage;
									list = data.slice(offset, offset + limit);
			            			
			            			console.info(list);
			            		};
			            		  
//			            		$scope.$watch('currentPage', setPage);
			            	}
			            );
			},
			get : function(data, list, noOfPages, currentPage, numPerPage, setPage, scope){
				numPerPage = 6;
        		noOfPages = Math.ceil(data.length / numPerPage);
        		currentPage = 1;

        		setPage = function () {
        			var offset = (currentPage - 1) * numPerPage;
					var limit = numPerPage;
					list = data.slice(offset, offset + limit);
        			
        			console.info(list);
        		};
        		  
        		scope.$watch('currentPage', setPage);
			}
		}
		return factory;
	}]);
	
	app.directive('pagination', function() {
		  return {
			restrict : 'E',
			scope : {
				numPages : '=',
				currentPage : '=',
				onSelectPage : '&'
			},
			templateUrl : 'pagination',
			replace : true,
			link : function(scope) {
				scope.$watch('numPages', function(value) {
					scope.pages = [];
					for (var i = 1; i <= value; i++) {
						scope.pages.push(i);
					}
					if (scope.currentPage > value) {
						scope.selectPage(value);
					}
				});
				scope.noPrevious = function() {
					return scope.currentPage === 1;
				};
				scope.noNext = function() {
					return scope.currentPage === scope.numPages;
				};
				scope.isActive = function(page) {
					return scope.currentPage === page;
				};

				scope.selectPage = function(page) {
					if (!scope.isActive(page)) {
						scope.currentPage = page;
						scope.onSelectPage({
							page : page
						});
					}
				};

				scope.selectPrevious = function() {
					if (!scope.noPrevious()) {
						scope.selectPage(scope.currentPage - 1);
					}
				};
				scope.selectNext = function() {
					if (!scope.noNext()) {
						scope.selectPage(scope.currentPage + 1);
					}
				};
			}
		};
	});
	
	app.controller('LoginCtrl', [ '$scope', '$rootScope', '$resource',
			function($scope, $rootScope, $resource, $window) {

				console.info(JSON.stringify($rootScope.user));

				$scope.logout = function() {
					$resource('/logout').post(function(data) {
						console.info(data);
					}, function(err) {
						console.error(err)
					});

				}

				$scope.doLogin = function($rootScope) {
					$resource('/doLogin', {
						username : $rootScope.username,
						password : $rootScope.password
					}, {
						query : {
							method : 'post',
							isArray : false
						}
					}).query().$promise.then(function(data) {
						console.info(JSON.stringify(data));
						alert(JSON.stringify(data));
					}, function(err) {
						console.error(err);
					});
				}
			} ]);

	app.controller('WrapperCtrl', ['$scope', '$rootScope', '$resource', function($scope, $rootScope, $resource) {
		$resource('/rest/16News', {}, {
			query : {
				method : 'get',
				isArray : true
			}
		}).query(
				function(data) {
					$scope.listProduct = data;
					$scope.numPerPage = 8;
					$scope.noOfPages = Math.ceil(data.length
							/ $scope.numPerPage);
					$scope.currentPage = 1;

					$scope.setPage = function() {
						var offset = ($scope.currentPage - 1) * $scope.numPerPage;
						var limit = $scope.numPerPage;
						$scope.listNews = data.slice(offset, offset + limit);

						console.info($scope.listNews);
					};

					$scope.$watch('currentPage', $scope.setPage);
					
				});
	}]);

	app.controller('HeaderCtrl', [ '$scope', '$rootScope',
			function($scope, $rootScope) {
				$rootScope.user = {
					username : "",
					password : "",
					name : "TMTAI",
					role : ""
				};

			} ]);

	app.controller('ProductCtrl', ['$scope', '$rootScope', '$resource',function($scope, $rootScope, $resource) {
		$scope.listProduct = [];
		
		$resource('/rest/products',
	            {},
	            {
	                query: {
	                    method: 'get',
	                    isArray: true
	                }
	            }).query(
	            	function(data){
	            		$scope.listProduct = data;
	            		$scope.numPerPage = 6;
	            		$scope.noOfPages = Math.ceil(data.length / $scope.numPerPage);
	            		$scope.currentPage = 1;

	            		$scope.setPage = function () {
	            			var offset = ($scope.currentPage - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProduct = data.slice(offset, offset + limit);
	            			
	            			console.info($scope.listProduct);
	            		};
	            		  
	            		$scope.$watch('currentPage', $scope.setPage);
	            	}
	            );
	}]);
	
})()