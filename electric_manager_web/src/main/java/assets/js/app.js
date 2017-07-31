(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource', 'ngMessages', 'ngCookies']);

    app.config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('dark-grey').backgroundPalette('grey').dark();

    });

    app.controller('HomeCtrl', ['$scope', '$rootScope', '$cookies', '$resource', '$mdDialog', '$mdToast', function ($scope, $rootScope, $cookies, $resource, $mdDialog, $mdToast) {
        $rootScope.tenKhuVuc = "Home";
        $scope.hideKhuVuc = false;
        $scope.hidenTable = true;
        $scope.hiden = false;
        $scope.hidenTableDienKe = true;
        $rootScope.khuVucSelected = "kv01";

        $resource('/getKhuVuc',
            {},
            {
                query: {
                    method: 'get',
                    isArray: true
                }
            }).query().$promise.then(
            function (data) {
                $scope.khuvuc = data;
            },
            function (err) {
                console.info(err);
            }
        );

        $resource('/getThanhPho',
            {},
            {
                query: {
                    method: 'get',
                    isArray: true
                }
            }).query().$promise.then(
            function (data) {
                $scope.thanhpho = data;
            },
            function (err) {
                console.info(err);
            }
        );

        $rootScope.showAddKhachHang = function (ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'assets/html/addKhachHang.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
                .then(function (data) {
                }, function (err) {

                });
        }

        $scope.deleteKhachHang = function (kh) {
            $resource('/deleteKhachHang',
                {id: kh.id}).save().$promise.then(
                function (data) {
                    $rootScope.showKhachHang();
                },
                function (err) {
                    console.error(err);
                }
            );
        }
        $rootScope.showKhachHang = function () {
            $rootScope.listKhachHang = [];
            $resource('/getListKhachHang', {
                makv: $rootScope.khuVucSelected
            }, {
                query: {
                    isArray: true,
                    method: 'get'
                }
            }).query().$promise.then(
                function (data) {
                    $rootScope.listKhachHang = data;

                    if ($scope.listKhachHang.length == 0) {
                        $scope.hidenTable = true;
                        $scope.hidenTableDienKe = true;
                    } else {
                        $scope.hidenTable = false;
                    }
                },
                function (err) {
                    console.error(err);
                }
            );
        }

        $rootScope.showKhachHang();

        $scope.khuVucSelected = '';
        $scope.khuVucItemClick = function (khuvuc) {
            window.location = "/#/?khuvuc=" + khuvuc.tenkv;
            $rootScope.khuVucSelected = khuvuc.makv;
            $rootScope.tenKhuVuc = khuvuc.tenkv;
            $scope.hideKhuVuc = false;
            $scope.hidenTable = true;
            $scope.hiden = false;
            $scope.hidenTableDienKe = true;
            $scope.hidenHoaDon = true;
            $rootScope.showKhachHang();
        }

        // DIEN KE
        $scope.clickThanhToan = function(dk){

        }

        $scope.thongTinhDienKe = function (kh) {
            $scope.hidenHoaDon = true;
            $scope.listDienKe = [];
            $resource('/getDienKe', {
                makh: kh.makh
            }, {
                query: {
                    isArray: true,
                    method: 'get'
                }
            }).query().$promise.then(
                function (data) {
                    $scope.listDienKe = data;
                    $scope.hidenTableDienKe = false;
                },
                function (err) {
                    console.error(err)
                }
            );
        }

        $scope.updateChiSoDien = function (dk) {
            if (dk.chisomoi > dk.chisocu) {
                $resource('/updateChiSoDienKe',
                    {
                        id: dk.id,
                        chisomoi: dk.chisomoi,
                        isthanhtoan: dk.isthanhtoan
                    }).save().$promise.then(
                    function (data) {
                        $resource('/getDienKe', {
                            makh: dk.makh
                        }, {
                            query: {
                                isArray: true,
                                method: 'get'
                            }
                        }).query().$promise.then(
                            function (data) {
                                $scope.listDienKe = data;
                            },
                            function (err) {
                                console.error(err)
                            }
                        );

                        $mdToast.show(
                            $mdToast.simple()
                                .textContent("Update complete")
                                .hideDelay(700)
                        );

                        $scope.showInfoHoaDon(dk);
                    },
                    function (err) {
                        console.error(err);
                    }
                );
            } else {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent("Chi so moi khong duoc nho hon chi so cu")
                        // .position({bottom:true, left:true})
                        .hideDelay(3000)
                );
            }
        }
        $rootScope.dienke = {
            madk: "",
            makh: "",
            mathang: "",
            manam: "",
            ngaydksd: "",
            chisocu: "",
            chisomoi: "",
            isthanhtoan : false
        }

        $scope.showAddDienKe = function (ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'assets/html/addDienKe.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
                .then(function (data) {
                }, function (err) {

                });
        };

        function DialogController($rootScope, $scope, $mdDialog) {
            $scope.hide = function () {
                $mdDialog.hide();
            };

            $scope.cancel = function () {
                $mdDialog.cancel();
            };

            $scope.answer = function (answer) {
                $mdDialog.hide(answer);
            };
        }


        //    Hoa Don

        $scope.showInfoHoaDon = function (dk) {
            $scope.hidenHoaDon = false;
            $resource('/getHoaDon',
                {
                    makh: dk.makh,
                    madk: dk.madk,
                    mathang: dk.mathang,
                    manam: dk.manam
                },
                {
                    query: {
                        isArray: false,
                        method: 'get'
                    }
                }
            ).query().$promise.then(
                function (data) {
                    $rootScope.hoadon = data;
                },
                function (err) {
                    console.error(err);
                });
        }

        $scope.showPrintHoaDon = function (ev, hd) {
            $mdDialog.show({
                controller: PrintHoaDonCtrl,
                templateUrl: 'assets/html/printHoaDon.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
                .then(function (data) {
                    
                }, function (err) {

                });

        }

        function PrintHoaDonCtrl() {
        }
    }]);

    app.controller('PrintController', ['$scope', '$rootScope',function ($scope, $rootScope) {
        $scope.hoadon = $rootScope.hoadon;
    }]);

})()


