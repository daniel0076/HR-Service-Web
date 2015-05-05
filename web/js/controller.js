'use strict';

var ctrl=angular.module('recruitTable', ['ngSanitize']);

ctrl.controller('tableCtrl',function($scope, $window,$http,$sce) {

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

