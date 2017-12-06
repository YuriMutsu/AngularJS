(function() {
	'use strict';
	
	var app = angular.module("myApp", [ 'ngResource','ngCookies', '720kb.datepicker', 'ngMap']);
	
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
			$resource('/login', {
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
	
	app.controller('PayCtrl', [ '$scope', '$rootScope', '$resource', function($scope, $rootScope, $resource, $window) {
		var username = window.location.href.split("=")[1];
		var keyAPI = "AIzaSyAEmqYXi6JPjfzig8Y9WBacb3VljK7VPtE";
		var URL = "https://maps.googleapis.com/maps/api/geocode/json?address=";
		var KEY_URL = "&key=" + keyAPI;
		$scope.location = { Latitude : "", Longitude: ""}
		
		$scope.address = "";
		console.info("username: " + username);
		$resource('http://localhost:8080/rest/users/',
			{ user : username},
			{
				query:{
					method: 'get',
					isArray: false
				}
			}).query().$promise.then(
				function(data){
					var uri = URL + data.address + KEY_URL;
					$scope.address = data.address;
					console.info(uri);
					$resource(uri).get({}, function(data){
						var location = data.results[0].geometry.location;
						console.info(location);
						$scope.location.Latitude = location.lat;
						$scope.location.Longitude = location.lng;
						
						$scope.position=$scope.location.Latitude + "," + $scope.location.Longitude;
						console.info("Postion: " + $scope.position);
					});
				},
				function(err){
					console.error(err)
				});	
	}]);
	
	app.controller('ProductInfoCtrl', ['$scope', '$rootScope', '$resource', '$window', '$cookieStore', function($scope, $rootScope, $resource, $window, $cookieStore) {
		
	}]);

	app.controller('AccountCtrl', ['$scope', '$rootScope', '$resource', '$window', '$cookieStore', function($scope, $rootScope, $resource, $window, $cookieStore) {
		$scope.hideChangePassword = true;
		$scope.hideUpdateProfile = true;
		$scope.hideProfile = false;
		$scope.hideProductFavorite = true;
		
		
		$scope.showProfile = function(){
			$scope.hideProfile = false;
			
			$scope.hideUpdateProfile = true;
			$scope.hideChangePassword = true;
			$scope.hideProductFavorite = true;
		}
		
		$scope.showUpdateProfile = function(){
			$scope.hideUpdateProfile = false;
			
			$scope.hideChangePassword = true;
			$scope.hideProfile = true;
			$scope.hideProductFavorite = true;
		}
		
		$scope.showChangePassword = function(){
			$scope.hideChangePassword = false;
			
			$scope.hideUpdateProfile = true;
			$scope.hideProfile = true;
			$scope.hideProductFavorite = true;
		}
		
		$scope.showProductFavorite = function(){
			$scope.hideProductFavorite = false;
			
			$scope.hideChangePassword = true;
			$scope.hideUpdateProfile = true;
			$scope.hideProfile = true;
			
		}
		
		$scope.newAvatar = function(){
			console.info("new avatar");
		}
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

	app.controller('ProductCtrl', ['$scope', '$rootScope', '$resource', '$window',function($scope, $rootScope, $resource, $window) {
		$scope.listTradeMark = ['ASUS', 'DELL', 'HP', 'LENOVO', 'WAIO'];
		
		$scope.listProduct = [];
		$scope.listNoOfPages = [];
		$scope.listCurrentPage = [];
		$scope.listSetPage = [];

		$scope.addToCart = function(product){
			$resource('/addToCart', {}).save(product,
				function(data){
					$scope.add = true;
					$scope.message_success = "Đã thêm sản phẩm vào giỏ hàng.";
					$scope.$watch('add', function() {
						window.location = "/productList";
					});
				},
				function(err){
					$scope.add = false;
					if (err.status == '411'){
						$scope.message_err = "Bạn đã thêm quá số lượng còn trong kho.";
					}else{
						$scope.message_err = "Bạn chưa đăng nhập. Vui lòng đăng nhập và thử lại !";
					}
				});
		}
		
		$scope.updateCart = function(product) {
			$resource('/updateCart', 
				{
					code: product.code,
					quantity: product.quantity
				},
				{
					query:{
						method: 'post',
						isArray: false
					}
				}).query().$promise.then(
					function(data) {
						console.info("ok");
					},
					function(err){
						console.error(err);
					});
		}
		
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
	            		
	            		
	            		// Number Item will show
	            		var numItemShow = 4;
	            		
	            		// ASUS
	            		$scope.listAllProductDetailsAsus = $scope.listProduct[0];	// list all product by trade mark = ASUS.
	            		$scope.listProductDetailsAsus = [];							// list product will be show.
	            		
	            		for (var i=0;i<numItemShow; i++){
	            			$scope.listProductDetailsAsus.push($scope.listAllProductDetailsAsus[i]); // list product default.
	            		}
	            		
	            		$scope.showItemAsus = function(){
	            			var lengthListCurrent = $scope.listProductDetailsAsus.length;
	            			var lengthListAll = $scope.listAllProductDetailsAsus.length;
	            			var less = 0;
	            			if (lengthListCurrent < lengthListAll){
	            				var less = lengthListAll - lengthListCurrent;
	            				if (less > numItemShow){
	            					for (var i=0;i<numItemShow;i++){
	            						$scope.listProductDetailsAsus.push($scope.listAllProductDetailsAsus[lengthListCurrent + i]);
	            					}
	            				}else{
	            					for (var i=0;i<less;i++){
	            						$scope.listProductDetailsAsus.push($scope.listAllProductDetailsAsus[lengthListCurrent + i]);
	            					}
	            				}
	            			}
	            			
	            			if (lengthListCurrent == lengthListAll){
	            				$scope.listProductDetailsAsus = [];
	            				for (var i=0;i<numItemShow; i++){
	    	            			$scope.listProductDetailsAsus.push($scope.listAllProductDetailsAsus[i]);
	    	            		}
	            			}
	            		}
	            		
	            		// DELL
	            		$scope.listAllProductDetailsDell = $scope.listProduct[1];	// list all product by trade mark = DELL.
	            		$scope.listProductDetailsDell = [];							// list product will be show.
	            		
	            		for (var i=0;i<numItemShow; i++){
	            			$scope.listProductDetailsDell.push($scope.listAllProductDetailsDell[i]); // list product default.
	            		}
	            		
	            		$scope.showItemDell = function(){
	            			var lengthListCurrent = $scope.listProductDetailsDell.length;
	            			var lengthListAll = $scope.listAllProductDetailsDell.length;
	            			var less = 0;
	            			if (lengthListCurrent < lengthListAll){
	            				var less = lengthListAll - lengthListCurrent;
	            				if (less > numItemShow){
	            					for (var i=0;i<numItemShow;i++){
	            						$scope.listProductDetailsDell.push($scope.listAllProductDetailsDell[lengthListCurrent + i]);
	            					}
	            				}else{
	            					for (var i=0;i<less;i++){
	            						$scope.listProductDetailsDell.push($scope.listAllProductDetailsDell[lengthListCurrent + i]);
	            					}
	            				}
	            			}
	            			
	            			if (lengthListCurrent == lengthListAll){
	            				$scope.listProductDetailsDell = [];
	            				for (var i=0;i<numItemShow; i++){
	    	            			$scope.listProductDetailsDell.push($scope.listAllProductDetailsDell[i]);
	    	            		}
	            			}
	            		}
	            		
	            		
	            		// HP
	            		$scope.listAllProductDetailsHP = $scope.listProduct[2];	// list all product by trade mark = HP.
	            		$scope.listProductDetailsHP = [];							// list product will be show.
	            		
	            		for (var i=0;i<numItemShow; i++){
	            			$scope.listProductDetailsHP.push($scope.listAllProductDetailsHP[i]); // list product default.
	            		}
	            		
	            		$scope.showItemHP = function(){
	            			var lengthListCurrent = $scope.listProductDetailsHP.length;
	            			var lengthListAll = $scope.listAllProductDetailsHP.length;
	            			var less = 0;
	            			if (lengthListCurrent < lengthListAll){
	            				var less = lengthListAll - lengthListCurrent;
	            				if (less > numItemShow){
	            					for (var i=0;i<numItemShow;i++){
	            						$scope.listProductDetailsHP.push($scope.listAllProductDetailsHP[lengthListCurrent + i]);
	            					}
	            				}else{
	            					for (var i=0;i<less;i++){
	            						$scope.listProductDetailsHP.push($scope.listAllProductDetailsHP[lengthListCurrent + i]);
	            					}
	            				}
	            			}
	            			
	            			if (lengthListCurrent == lengthListAll){
	            				$scope.listProductDetailsHP = [];
	            				for (var i=0;i<numItemShow; i++){
	    	            			$scope.listProductDetailsHP.push($scope.listAllProductDetailsHP[i]);
	    	            		}
	            			}
	            		}
	            		
	            		// Lenovo
	            		$scope.listAllProductDetailsLenovo = $scope.listProduct[3];	// list all product by trade mark = LENOVO.
	            		$scope.listProductDetailsLenovo = [];							// list product will be show.
	            		
	            		for (var i=0;i<numItemShow; i++){
	            			$scope.listProductDetailsLenovo.push($scope.listAllProductDetailsLenovo[i]); // list product default.
	            		}
	            		
	            		$scope.showItemLenovo = function(){
	            			var lengthListCurrent = $scope.listProductDetailsLenovo.length;
	            			var lengthListAll = $scope.listAllProductDetailsLenovo.length;
	            			var less = 0;
	            			if (lengthListCurrent < lengthListAll){
	            				var less = lengthListAll - lengthListCurrent;
	            				if (less > numItemShow){
	            					for (var i=0;i<numItemShow;i++){
	            						$scope.listProductDetailsLenovo.push($scope.listAllProductDetailsLenovo[lengthListCurrent + i]);
	            					}
	            				}else{
	            					for (var i=0;i<less;i++){
	            						$scope.listProductDetailsLenovo.push($scope.listAllProductDetailsLenovo[lengthListCurrent + i]);
	            					}
	            				}
	            			}
	            			
	            			if (lengthListCurrent == lengthListAll){
	            				$scope.listProductDetailsLenovo = [];
	            				for (var i=0;i<numItemShow; i++){
	    	            			$scope.listProductDetailsLenovo.push($scope.listAllProductDetailsLenovo[i]);
	    	            		}
	            			}
	            		}
	            		
	            		// Waio
	            		$scope.listAllProductDetailsWaio = $scope.listProduct[4];	// list all product by trade mark = WAIO.
	            		$scope.listProductDetailsWaio = [];							// list product will be show.
	            		
	            		for (var i=0;i<numItemShow; i++){
	            			if (numItemShow < $scope.listAllProductDetailsWaio.length){
	            				$scope.listProductDetailsWaio.push($scope.listAllProductDetailsWaio[i]); // list product default.
	            			}
	            		}
	            		
	            		$scope.showItemWaio = function(){
	            			var lengthListCurrent = $scope.listProductDetailsWaio.length;
	            			var lengthListAll = $scope.listAllProductDetailsWaio.length;
	            			var less = 0;
	            			if (lengthListCurrent < lengthListAll){
	            				var less = lengthListAll - lengthListCurrent;
	            				if (less > numItemShow){
	            					for (var i=0;i<numItemShow;i++){
	            						$scope.listProductDetailsWaio.push($scope.listAllProductDetailsWaio[lengthListCurrent + i]);
	            					}
	            				}else{
	            					for (var i=0;i<less;i++){
	            						$scope.listProductDetailsWaio.push($scope.listAllProductDetailsWaio[lengthListCurrent + i]);
	            					}
	            				}
	            			}
	            			
	            			if (lengthListCurrent == lengthListAll){
	            				$scope.listProductDetailsWaio = [];
	            				for (var i=0;i<numItemShow; i++){
	    	            			if (numItemShow < $scope.listAllProductDetailsWaio.length){
	    	            				$scope.listProductDetailsWaio.push($scope.listAllProductDetailsWaio[i]); // list product default.
	    	            			}
	    	            		}
	            			}
	            		}
	            	}
	            );
		
		$scope.addToFavorite = function(product){
			$resource('/addToFavorite', {}).save(product,
				function(data){
					$scope.add = true;
					$scope.message_success = "Đã thêm sản phẩm vào danh sách yêu thích.";
				},
				function(err){
					$scope.add = false;
					if (err.status == '411'){
						$scope.message_err = "Bạn đã thêm quá số lượng còn trong kho.";
					}else{
						$scope.message_err = "Bạn chưa đăng nhập. Vui lòng đăng nhập và thử lại !";
					}
				});
		}
	}]);
	
	app.controller('CartCtrl', ['$scope', '$rootScope', function($scope, $rootScope) {
		
	}])
})()