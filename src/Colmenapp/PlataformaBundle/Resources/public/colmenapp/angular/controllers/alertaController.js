
(function() {

    'use strict';

    var alertaController = function($scope, $http) {


        $scope.labelsEstado = ["Pendientes", "Enviadas", "Fallidas"];
        $scope.dataEstado = [300, 500, 100];
        $scope.colors = ['#FDB45C','#46BFBD','#F70106'];

    };

    angular.module('colmenapp.Controllers')
        .controller('alertaController', [
            '$scope',
            '$http',
            alertaController
        ]);

})();