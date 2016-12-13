
(function() {

    'use strict';

    var dashboardController = function($scope) {

        //grafico productividad
        $scope.labels = ["","Los Algarrobos","Agua Blanca"];
        $scope.data   = [0,4304,7921];


        $scope.labelsNucleo = ["","Los Algarrobos","Agua Blanca"];
        $scope.dataNucleo   = [0,210,351];

        //grafico alta/baja colmenas
        $scope.labelsColmenas = ["","Los Algarrobos","Agua Blanca"];
        $scope.dataColmenas   = ['',120, 150];



        $scope.labelsEstado = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
        $scope.dataEstado = [300, 500, 100];

    };

    angular.module('colmenapp.Controllers')
        .controller('dashboardController', [
            '$scope',
            dashboardController
        ]);

})();