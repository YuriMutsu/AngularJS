(function() {
	'use strict';
	
	var app = angular.module("myApp", [ 'ngResource','ngCookies', '720kb.datepicker']);
	
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
	
	app.controller('CarouselDemoCtrl', function ($scope) {
		$scope.myInterval = 5000;
		$scope.noWrapSlides = false;
		$scope.active = 0;
		var slides = $scope.slides = [];
		var currIndex = 0;

		$scope.addSlide = function() {
			var newWidth = 600 + slides.length + 1;
		    slides.push({
		      image: '//unsplash.it/' + newWidth + '/300',
		      text: ['Nice image','Awesome photograph','That is so cool','I love that'][slides.length % 4],
		      id: currIndex++
		    });
		};

		$scope.randomize = function() {
		    var indexes = generateIndexesArray();
		    assignNewIndexesToSlides(indexes);
		};

		for (var i = 0; i < 4; i++) {
		    $scope.addSlide();
		}

		  // Randomize logic below

		function assignNewIndexesToSlides(indexes) {
		    for (var i = 0, l = slides.length; i < l; i++) {
		      slides[i].id = indexes.pop();
		    }
		}

		function generateIndexesArray() {
		    var indexes = [];
		    for (var i = 0; i < currIndex; ++i) {
		      indexes[i] = i;
		    }
		    return shuffle(indexes);
		}

		  // http://stackoverflow.com/questions/962802#962890
		function shuffle(array) {
		    var tmp, current, top = array.length;

		    if (top) {
		      while (--top) {
		        current = Math.floor(Math.random() * (top + 1));
		        tmp = array[current];
		        array[current] = array[top];
		        array[top] = tmp;
		      }
		    }

		    return array;
		}
	});
	
	app.controller('LoginCtrl', [ '$scope', '$rootScope', '$resource', function($scope, $rootScope, $resource, $window) {
			
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
	}]);

	app.controller('TabsDemoCtrl', function($scope, $window) {
		$scope.tabs = [ {
			title : 'Dynamic Title 1',
			content : 'Dynamic content 1'
		}, {
			title : 'Dynamic Title 2',
			content : 'Dynamic content 2',
			disabled : true
		} ];

		$scope.alertMe = function() {
			setTimeout(function() {
				$window.alert('You\'ve selected the alert tab!');
			});
		};

		$scope.model = {
			name : 'Tabs'
		};
	});
	
	app.controller('MenuCtrl', [ '$scope', '$rootScope', '$resource', '$location', function($scope, $rootScope, $resource, $window, $location) {
		$scope.listTradeMark = ['ASUS', 'DELL', 'HP', 'LENOVO', 'WAIO'];
		
		$scope.clickHome = function(){
			window.location = "/home";
		}
		
		$scope.clickNews = function(){
			window.location = "/news";
		}
		
		$scope.clickTradeMark = function(){
		}
		
		$scope.clickProductList = function(){
			window.location = "/productList";
		}
		
		$scope.clickCon = function(){
			window.location = "/contact";
		}
	}]);
	
	app.controller('RegisterCtrl', [ '$scope', '$rootScope', '$resource', function($scope, $rootScope, $resource, $window) {
	}]);
	
	app.controller('ProductInfoCtrl', ['$scope', '$rootScope', '$resource', '$window', '$cookieStore', function($scope, $rootScope, $resource, $window, $cookieStore) {
		
	}]);

	app.controller('WrapperCtrl', ['$scope', '$rootScope', '$resource', '$window', '$cookieStore', function($scope, $rootScope, $resource, $window, $cookieStore) {
		
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
		$scope.listTradeMark = ['ASUS', 'DELL', 'HP', 'LENOVO', 'WAIO'];
		
		$scope.listProduct = [];
		$scope.listNoOfPages = [];
		$scope.listCurrentPage = [];
		$scope.listSetPage = [];
		
		$resource('/rest/productDetails',
	            {},
	            {
	                query: {
	                    method: 'get',
	                    isArray: true
	                }
	            }).query(
	            	function(data){
	            		for (var i = 0; i<$scope.listTradeMark.length;i++){
	            			var list = [];
	            			for (var j=0;j<data.length;j++){
	            				if (data[j].trademark === $scope.listTradeMark[i]){
	            					list.push(data[j]);
	            				}
	            			}
	            			$scope.listProduct.push(list);
	            		}
	            		
	            		// ALL
	            		$scope.listProductDetails = data;
	            		$scope.numPerPage = 4;
	            		$scope.noOfPages = Math.ceil(data.length / $scope.numPerPage);
	            		$scope.currentPage = 1;

	            		$scope.setPage = function () {
	            			var offset = ($scope.currentPage - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetails = data.slice(offset, offset + limit);
	            		};
	            		  
	            		$scope.$watch('currentPage', $scope.setPage);
	            		
	            		
	            		// ASUS
	            		$scope.listProductDetailsAsus = $scope.listProduct[0];
	            		$scope.numPerPage = 4;
	            		$scope.noOfPagesAsus = Math.ceil($scope.listProduct[0].length / $scope.numPerPage);
	            		$scope.currentPageAsus = 1;

	            		$scope.setPageAsus = function () {
	            			var offset = ($scope.currentPageAsus - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetailsAsus = $scope.listProduct[0].slice(offset, offset + limit);
	            		};
	            		
	            		$scope.$watch('currentPageAsus', $scope.setPageAsus);
	            		  
	            		// DELL
	            		$scope.listProductDetailsDell = $scope.listProduct[1];
	            		$scope.numPerPage = 4;
	            		$scope.noOfPagesDell = Math.ceil($scope.listProduct[1].length / $scope.numPerPage);
	            		$scope.currentPageDell = 1;

	            		$scope.setPageDell = function () {
	            			var offset = ($scope.currentPageDell - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetailsDell = $scope.listProduct[1].slice(offset, offset + limit);
	            		};
	            		
	            		$scope.$watch('currentPageDell', $scope.setPageDell);
	            		
	            		
	            		// HP
	            		$scope.listProductDetailsHP = $scope.listProduct[2];
	            		$scope.numPerPage = 4;
	            		$scope.noOfPagesHP = Math.ceil($scope.listProduct[2].length / $scope.numPerPage);
	            		$scope.currentPageHP = 1;

	            		$scope.setPageHP = function () {
	            			var offset = ($scope.currentPageHP - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetailsHP = $scope.listProduct[2].slice(offset, offset + limit);
	            		};
	            		
	            		$scope.$watch('currentPageHP', $scope.setPageHP);
	            		
	            		// Lenovo
	            		$scope.listProductDetailsLenovo = $scope.listProduct[3];
	            		$scope.numPerPage = 4;
	            		$scope.noOfPagesLenovo = Math.ceil($scope.listProduct[3].length / $scope.numPerPage);
	            		$scope.currentPageLenovo = 1;

	            		$scope.setPageLenovo = function () {
	            			var offset = ($scope.currentPageLenovo - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetailsLenovo = $scope.listProduct[3].slice(offset, offset + limit);
	            		};
	            		
	            		$scope.$watch('currentPageLenovo', $scope.setPageLenovo);
	            		
	            		// Waio
	            		$scope.listProductDetailsWaio = $scope.listProduct[4];
	            		$scope.numPerPage = 4;
	            		$scope.noOfPagesWaio = Math.ceil($scope.listProduct[4].length / $scope.numPerPage);
	            		$scope.currentPageWaio = 1;

	            		$scope.setPageWaio = function () {
	            			var offset = ($scope.currentPageWaio - 1) * $scope.numPerPage;
							var limit = $scope.numPerPage;
	            			$scope.listProductDetailsWaio = $scope.listProduct[4].slice(offset, offset + limit);
	            		};
	            		
	            		$scope.$watch('currentPageWaio', $scope.setPageWaio);
	            		  
	            	}
	            );
		
	}]);
	
})()