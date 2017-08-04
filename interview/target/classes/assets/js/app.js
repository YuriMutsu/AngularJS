(function () {

    var app = angular.module("myApp", ['ngMaterial', 'ngResource', 'ngMessages', 'ngCookies']);

    app.config(function ($mdThemingProvider) {
        $mdThemingProvider.theme('dark-grey').backgroundPalette('grey').dark();
    });

    app.run(function ($rootScope, $resource, $location, $cookies, $mdToast, $mdMenu, $mdDialog) {


    });

    app.controller("HomeCtrl", ['$scope', '$rootScope', '$cookies', '$mdToast', '$resource', function ($scope, $rootScope, $cookies, $mdToast, $resource) {
        $scope.listTemp = ["", "", "", "", "", "", "", "", "", ""];
        $scope.hide = true;

        $scope.search = function () {
            $scope.waiting = false;
            $resource('/getDependency',
                {
                    binaryName: $scope.binaryName
                }).get().$promise.then(
                function (data) {
                    $scope.resultDependency = data;
                    if (data.m_listDependency == null) {
                        $scope.hide = false;
                        $scope.hideRoot = true;
                    } else {
                        if ($scope.hideRoot != false) {
                            $scope.hideRoot = false;
                        }
                    }

                    $scope.waiting = true;
                },
                function (err) {
                    console.error(err);
                }
            );
        }

        $scope.getInfoDependency = function (index, type, groupId, artifactId, version) {
            if ($scope.indexSelect != index) {
                $scope.indexSelect = index;
                $scope.hideChild_lv2 = true;
            } else {
                $scope.hideChild_lv2 = !$scope.hideChild_lv2;
            }

            if ($scope.hideChild_lv2 == true) {
                $scope.waiting = false;
                var newArtifactId = artifactId.split("-");
                if (newArtifactId.length == 1) {
                    artifactId = newArtifactId[0];
                } else if (newArtifactId.length == 2) {
                    artifactId = newArtifactId[1];
                }


                if ($scope.listTemp[index] == ""){
                    var data = {
                        type: type,
                        groupId: groupId,
                        artifactId: artifactId,
                        version: version
                    };
                    var url = '/getDependency/getDependencySecondLevelInfo';
                    $resource(url, {
                        data: data
                    }).save().$promise.then(
                        function (data) {
                            var list = data.m_listDependency;
                            $scope.dependencies = getListDenpendency(list);
                            $scope.listTemp[index] = $scope.dependencies;

                            console.info("CREATE LIST DEPENDENCY " + index + ": " + JSON.stringify($scope.listTemp[index]));
                            $scope.waiting = true;
                        },
                        function (error) {
                            console.log(error);
                        }
                    );
                }else{
                    $scope.dependencies = $scope.listTemp[index];

                    console.info("LOAD LIST DEPENDENCY " + index + ": " + JSON.stringify($scope.listTemp[index]));
                    $scope.waiting = true;
                }

            }
        }

        var dependencyType = new Object();
        dependencyType["CORE"] = "com.alcatel.axs.basic.app";

        dependencyType["BASIC_FWK"] = "com.alcatel.axs.basic.fwk";

        dependencyType["APC_APP"] = "com.alcatel.axs.apc.app.fwk";
        dependencyType["APC_PLUGIN_FKW"] = "com.alcatel.axs.apc.app.plugins.fwk";

        dependencyType["GSIP_APP"] = "com.alcatel.axs.gsip.app.fkw";
        dependencyType["GSIP_PLUGIN_FKW"] = "com.alcatel.axs.gsip.app.plugins.fwk";

        dependencyType["IDM_APP"] = "com.alcatel.axs.idm.app.fkw";
        dependencyType["IDM_PLUGIN_FKW"] = "com.alcatel.axs.idm.app.plugins.fwk";

        dependencyType["OIF_APP"] = "com.alcatel.axs.oif.app";

        dependencyType["SPFE_APP"] = "com.alcatel.axs.spfe.app";
        dependencyType["SPFE_PLUGIN_FKW"] = "com.alcatel.axs.spfe.app.plugins.fkw";

        function getListDenpendency(list) {
            var data = [];
            for (var i = 0; i < list.length; i++) {
                var map = {type: "", groupId: "", version: ""};
                map.groupId = list[i].m_groupId;
                map.version = list[i].m_version;
                if (list[i].m_groupId === dependencyType["CORE"]) {
                    map.type = "CORE";
                } else if (list[i].m_groupId === dependencyType["BASIC_FWK"]) {
                    map.type = "BASIC FWK";
                } else if (list[i].m_groupId === dependencyType["APC_APP"]) {
                    map.type = "APC APP";
                } else if (list[i].m_groupId === dependencyType["APC_PLUGIN_FKW"]) {
                    map.type = "APC PLUGIN FKW";
                } else if (list[i].m_groupId === dependencyType["GSIP_APP"]) {
                    map.type = "GSIP APP";
                } else if (list[i].m_groupId === dependencyType["GSIP_PLUGIN_FKW"]) {
                    map.type = "GSIP PLUGIN FKW";
                } else if (list[i].m_groupId === dependencyType["IDM_APP"]) {
                    map.type = "IDM APP";
                } else if (list[i].m_groupId === dependencyType["IDM_PLUGIN_FKW"]) {
                    map.type = "IDM PLUGIN FKW";
                } else if (list[i].m_groupId === dependencyType["OIF_APP"]) {
                    map.type = "OIF APP";
                } else if (list[i].m_groupId === dependencyType["SPFE_APP"]) {
                    map.type = "SPFE APP";
                } else if (list[i].m_groupId === dependencyType["SPFE_PLUGIN_FKW"]) {
                    map.type = "SPFE PLUGIN FKW";
                } else {
                    map.type = "CORE PLUG";
                }
                pushData(map, data);
            }
            return data;
        }

        function pushData(map, data) {
            var check = false;
            for (var i = 0; i < data.length; i++) {
                if (map.type == data[i].type) {
                    check = true;
                    break;
                }
            }
            if (!check) {
                data.push(map);
            }
        }


        $scope.toggleRelease = function () {
            $scope.hideRoot = !$scope.hideRoot;
        }

        $scope.toggleParent = function () {
            $scope.hideParent = !$scope.hideParent;
        }

        $scope.toggleChild = function () {
            $scope.hideChild = !$scope.hideChild;
        }


        $scope.export = function (dependency) {
            $scope.waiting = false;

            $resource("/exportXml",
                {
                    groupId: dependency.m_groupId,
                    artifactId: dependency.m_artifactId,
                    version: dependency.m_version
                },
                {
                    query: {
                        method: 'get',
                        isArray: false
                    }
                }).query().$promise.then(
                function (data) {
                    $scope.xml = data.data;
                    $scope.waiting = true;
                },
                function (err) {
                    console.error(err);
                }
            )
        }


    }]);
})()


