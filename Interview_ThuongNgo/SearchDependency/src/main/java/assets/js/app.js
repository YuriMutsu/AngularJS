var app = angular.module('searchDependencyApp', ['ngCookies', 'ngAnimate', 'ngMaterial', 'ngResource', 'ngMessages']);
app.controller('SearchDependencyCtrl', ['$scope', '$http', '$cookies', '$cookieStore', '$resource', function ($scope, $http, $cookies, $cookieStore, $resource) {
    var binaryName = sessionStorage.getItem("binaryName");
    if (binaryName == null || binaryName == "") {
        $('.contentDependency').hide();
    } else {
        $('.contentDependency').show('fast');
        $http.get("/dependency/getDependency?binaryName=" + binaryName).then(
            function (data) {
                $('.notice').show();
                $('.notice').text('Results found: ' + binaryName);
                $scope.resultDependency = data.data.data;
                $scope.dependencies = data.data.data.dependencies;
                $scope.session = binaryName;
                updateData($scope.dependencies);
            });
    }
    $scope.rootEnabled = true;
    $scope.parentEnabled = true;
    $scope.childEnabled = true;

    $scope.toggleRoot = function () {
        $scope.rootEnabled = !$scope.rootEnabled;
        $('.iconRelease').toggleClass("glyphicon glyphicon-plus").toggleClass("glyphicon glyphicon-minus");
    }

    $scope.toggleParent = function () {
        $scope.parentEnabled = !$scope.parentEnabled;
        $('.iconGroupId').toggleClass("glyphicon glyphicon-plus").toggleClass("glyphicon glyphicon-minus");
    }

    $scope.toggleChild = function () {
        $scope.childEnabled = !$scope.childEnabled;
        $('.iconArtifactId').toggleClass("glyphicon glyphicon-plus").toggleClass("glyphicon glyphicon-minus");
    }
    $scope.binaryName = "";
    $scope.search = function () {
        $scope.linearEnabled = true;
        $http.get("/dependency/getDependency?binaryName=" + $scope.binaryName).then(function (data) {
            if (data.data.type == "SUCCESS") {
                $('.contentDependency').show('fast');
                $('.notice').show();
                $('.notice').text('Results found: ' + $scope.binaryName);
                sessionStorage.binaryName = $scope.binaryName;
                $scope.resultDependency = data.data.data;
                $scope.dependencies = data.data.data.dependencies;
                updateData($scope.dependencies);
                $scope.linearEnabled = false;
            } else {
                console.log(data.data);
                error();
            }
        }, function (error) {
            console.log("Error with: " + e);
            error();
        });
    }

    error = function () {
        sessionStorage.removeItem("binaryName");
        $('.contentDependency').hide();
        $('.notice').show();
        $('.notice').text('0 results found');
        $scope.linearEnabled = false;
    }


    updateData = function (dependencies) {
        $scope.arrDependency = [];
        for (var i = 0; i < dependencies.length; i++) {
            var artifactId = [];
            artifactId = dependencies[i].artifactId.split("-");
            if (artifactId.length == 1) {
                artifactId[0] = "CORE";
            }
            var dependency = {};
            dependency.type = artifactId[0].toUpperCase();
            dependency.groupId = dependencies[i].groupId;
            dependency.artifactId = dependencies[i].artifactId;
            dependency.version = dependencies[i].version;
            dependency.index = i;
            $scope.arrDependency.push(dependency);
        }
    }

    var previousIndex = 0;
    $scope.getInfoDependency = function (type, groupId, artifactId, version, currentIndex) {
        // console.log(currentIndex);
        expandIconTree(currentIndex);
        if ($scope.arrDependency[currentIndex].clicked) {
            $scope.arrDependency[currentIndex].clicked = false;
        } else {
            $scope.arrDependency[previousIndex].clicked = false;
            $scope.arrDependency[currentIndex].clicked = true;
        }
        previousIndex = currentIndex;
        var newArtifactId = artifactId.split("-");
        if (newArtifactId.length == 1) {
            artifactId = newArtifactId[0];
        } else if (newArtifactId.length == 2) {
            artifactId = newArtifactId[1];
        }
        var data = {
            type: type,
            groupId: groupId,
            artifactId: artifactId,
            version: version
        };
        var url = '/dependency/getDependencySecondLevelInfo';
        $resource(url, {
            data: data
        }).save().$promise.then(function (response) {
                // console.log(response);
                if (response.type == "ERROR") {
                    $('.secondLevelDependency').hide("fast");
                    // for popup
                    $scope.type = type;
                    var modal = document.getElementById('myModal');
                    modal.style.display = "block";
                    var btn = document.getElementsByClassName("secondLevelDependency");
                    var span = document.getElementsByClassName("close")[0];
                    span.onclick = function () {
                        modal.style.display = "none";
                    }
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                } else {
                    $('.secondLevelDependency').show();
                    $scope.dependencies = getDependency(type, artifactId, version, response.data.dependencies);
                }
            },
            function (error) {
                console.log(error);
            }
        );
    }

    expandIconTree = function (currentIndex) {
        var isCurrentExpand = $('.' + currentIndex).hasClass('glyphicon-plus');
        if (isCurrentExpand) {
            $('.' + currentIndex).toggleClass("glyphicon-plus").toggleClass("glyphicon-minus");
        } else {
            $('.' + currentIndex).toggleClass("glyphicon-minus").toggleClass("glyphicon-plus");
        }
        var isPreviousExpand = $('.' + previousIndex).hasClass('glyphicon-plus');
        if (!isPreviousExpand) {
            $('.' + previousIndex).toggleClass("glyphicon-minus").toggleClass("glyphicon-plus");
        }
        if (currentIndex == previousIndex) {
            if (isCurrentExpand) {
                $('.' + currentIndex).toggleClass("glyphicon-plus").toggleClass("glyphicon-minus");
            }
        }
    }

    $scope.core = "com.alcatel.axs.basic.app";
    $scope.basicFwk = "com.alcatel.axs.basic.fwk";

    //for apc
    $scope.apcApp = "com.alcatel.axs.apc.app.fwk";
    $scope.apcPluginFwk = "com.alcatel.axs.apc.app.plugins.fwk";

    //for gsip
    $scope.gsipApp = "com.alcatel.axs.gsip.app.fwk";
    $scope.gsipPluginFwk = "com.alcatel.axs.gsip.app.plugins.fwk";

    //for idm
    $scope.idmPlugFwk = "com.alcatel.axs.idm.app.plugins.fwk";
    $scope.idmApp = "com.alcatel.axs.idm.app.fwk";
    $scope.oifApp = "com.alcatel.axs.oif.app";

    //for spfe
    $scope.spfeApp = "com.alcatel.axs.spfe.app";
    $scope.spfePluginFwk = "com.alcatel.axs.spfe.app.plugins.fwk";

    getDependency = function (type, artifactId, version, response) {
        artifactId = artifactId.split("-");
        version = version.split("-")[0];
        if (artifactId.length == 1) {
            artifactId = artifactId[0];
        } else if (newArtifactId.length == 2) {
            artifactId = artifactId[1] + ".";
        }
        var keys = [];
        dependencies = [];
        var corePlug = "";
        for (var i = 0; i < response.length; i++) {
            var key = response[i].groupId;
            if (keys.indexOf(key) === -1) {
                keys.push(key);
                var dependency = {};
                if (type == "CORE") {
                    if (key == $scope.basicFwk || key == $scope.core) {
                        pushData(key, response[i]);
                    }
                } else if (type == "IDM") {
                    corePlug = ("com.alcatel.axs.basic." + artifactId + "." + version);
                    if (key == $scope.core || key == $scope.idmPlugFwk || key == $scope.idmApp || key == $scope.oifApp || key == $scope.basicFwk || key == corePlug) {
                        pushData(key, response[i]);
                    }
                } else if (type == "APC") {
                    corePlug = ("com.alcatel.axs.basic." + artifactId + "." + version);
                    if (key == $scope.apcApp || key == $scope.apcPluginFwk || key == $scope.core || key == $scope.basicFwk || key == corePlug) {
                        pushData(key, response[i]);
                    }
                } else if (type == "GSIP") {
                    if (key == $scope.gsipApp || key == $scope.gsipPluginFwk || key == $scope.core) {
                        pushData(key, response[i]);
                    }
                } else if (type == "SPFE") {
                    corePlug = "com.alcatel.axs.basic." + artifactId + "." + version;
                    if (key == $scope.apcApp || key == $scope.apcPluginFwk || key == corePlug || key == $scope.core || key == $scope.basicFwk || key == $scope.spfeApp || key == $scope.spfePluginFwk) {
                        pushData(key, response[i]);
                    }
                }
                // console.log(key);
            }
        }
        // console.log(dependencies);
        return dependencies;
    }

    var dependencyType = new Object();
    dependencyType["com.alcatel.axs.basic.app"] = "Core";
    dependencyType["com.alcatel.axs.idm.app.plugins.fwk"] = "IDM Plug FWK";
    dependencyType["com.alcatel.axs.idm.app.fwk"] = "IDM APP";
    dependencyType["com.alcatel.axs.oif.app"] = "OIF APP";
    dependencyType["com.alcatel.axs.basic.fwk"] = "Basic FWK";
    dependencyType["com.alcatel.axs.gsip.app.fwk"] = "GSIP APP";
    dependencyType["com.alcatel.axs.gsip.app.plugins.fwk"] = "GSIP Plugin Fwk";
    dependencyType["com.alcatel.axs.apc.app.fwk"] = "APC APP";
    dependencyType["com.alcatel.axs.apc.app.plugins.fwk"] = "APC Plugin Fwk";
    dependencyType["com.alcatel.axs.spfe.app"] = "SPFE APP";
    dependencyType["com.alcatel.axs.spfe.app.plugins.fwk"] = "SPFE Plugin Fwk";

    function getMapValue(key) {
        return dependencyType[key];
    }

    pushData = function (key, response) {
        var dependency = {};
        var type = getMapValue(key);
        dependency.type = type;
        if (null == type) {
            dependency.type = "Core Plug"
        }
        dependency.groupId = key;
        dependency.version = response.version;
        dependencies.push(dependency);
    }


    $scope.exportDependency = function (group, artifact, version) {
        $scope.linearEnabled = true;
        console.log(group, artifact, version);
        data = {
            groupId: group,
            artifactId: artifact,
            version: version
        }
        var url = '/dependency/exportXML';
        $resource(url, {
            data: data
        }).save().$promise.then(function (response) {
            $scope.linearEnabled = false;
            // console.log(response);
            download(response.data, 'exportXML.xml', 'text/plain');

        });
    }

    function download(strData, strFileName, strMimeType) {
        var D = document,
            A = arguments,
            a = D.createElement("a"),
            d = A[0],
            n = A[1],
            t = A[2] || "text/plain";

        a.href = "data:" + strMimeType + "charset=utf-8," + escape(strData);

        if (window.MSBlobBuilder) {// for IE10
            var bb = new MSBlobBuilder();
            bb.append(strData);
            return navigator.msSaveBlob(bb, strFileName);
        }

        if ('download' in a) { //FF20, CH19
            a.setAttribute("download", n);
            a.innerHTML = "downloading...";
            D.body.appendChild(a);
            setTimeout(function () {
                var e = D.createEvent("MouseEvents");
                e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                a.dispatchEvent(e);
                D.body.removeChild(a);
            }, 66);
            return true;
        }
        ;

        var f = D.createElement("iframe");
        D.body.appendChild(f);
        f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64" : "") + "," + (window.btoa ? window.btoa : escape)(strData);
        setTimeout(function () {
            D.body.removeChild(f);
        }, 333);
        return true;
    }

}]);