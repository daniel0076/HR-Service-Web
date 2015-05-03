'use strict';

var ctrl=angular.module('sort', ['ngSanitize']);

ctrl.controller('sortController',function($scope, $window,$http,$sce) {
    $http.get("api/make_recruit_table.php?sort=null").success(
            function(response){
                $scope.table= $sce.trustAsHtml(response);
            }
            )
        $scope.sortBy= function(sort) {
            $http.get("api/make_recruit_table.php?sort="+sort).success(
                    function(response){
                        $scope.table= $sce.trustAsHtml(response);
                    }
                    )
        }
});
