'use strict';

var ctrl=angular.module('recruitTable', ['ngSanitize']);

ctrl.controller('tableCtrl',function($scope, $window,$http,$sce) {

    $scope.sortBy= function(sort) {
        $http.get("api/make_recruit_table.php?sort="+sort).success(
                function(data){
                    $scope.table= $sce.trustAsHtml(data);
                }
                )
    }
    $scope.search=function(){
        $http.post("api/recruit_search.php",{'salary':$scope.salary,
                                            'experience':$scope.experience,
                                            'occupation':$scope.occupation,
                                            'location':$scope.location,
                                            'worktime':$scope.worktime,
                                            'education':$scope.education
        }).success(
                function(data){
                    $scope.table= $sce.trustAsHtml(data);
                }
                )
    }

})

