
(function() {

    'use strict';

    var dashboardController = function($scope, $http) {

        $scope.labels = ["2012/2013","2013/2014", "2014/2015","2015/2016"];
        $scope.data   = [1080, 921, 1366, 1527];

        $scope.onClick = function (points, evt) {
            console.log(points, evt);
        };


        $scope.labelsEstado = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
        $scope.dataEstado = [300, 500, 100];

    };

    angular.module('colmenapp.Controllers')
        .controller('dashboardController', [
            '$scope',
            '$http',
            dashboardController
        ]);

})();