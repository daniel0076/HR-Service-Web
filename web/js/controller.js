'use strict';

var ctrl=angular.module('recruitTable', ['ngSanitize']);

ctrl.controller('tableCtrl',function($scope, $window,$http,$sce,$compile) {

    $scope.delFavor=function(fid){
        $http.post("api/del_favor.php",{'fid':fid}).success(
                function(){
                    $scope.search();
                    $scope.getFavor();
                }
                )
    }
    $scope.getFavor=function(){
        $http.post("api/make_favor_table.php").success(
                function(data){
                    $scope.list=data;
                }
                )
    }

    $scope.search=function(sort){
        $http.post("api/recruit_search.php",{'salary':$scope.salary,
            'experience':$scope.experience,
            'occupation':$scope.occupation,
            'location':$scope.location,
            'worktime':$scope.worktime,
            'education':$scope.education,
            'sort':sort
        }).success(
            function(data){
                $scope.table= $sce.trustAsHtml(data);
            }
            )
    }

})
