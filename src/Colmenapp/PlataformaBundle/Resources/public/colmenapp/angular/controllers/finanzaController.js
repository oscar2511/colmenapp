
(function() {

    'use strict';

    var finanzaController = function($scope) {

        $scope.mostrarModalAltaMovimiento = false;

        $scope.altaMovimiento = function () {
            $scope.mostrarModalAltaMovimiento = true;
            console.log(12345);
        };

        //grafico productividad
        $scope.labels = ["","Los Algarrobos","Agua Blanca"];
        $scope.data   = [0,4304,7921];


        //grafico alta/baja colmenas
        $scope.labelsColmenas = ['',1,2,3,4,5,6,7,8,9,10,11,12];
        $scope.dataColmenas   = ['',120, 150, 155, 155,156, 158, 160, 150,120, 123, 127, 130];



        $scope.labelsEstado = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
        $scope.dataEstado = [300, 500, 100];

    };

    angular.module('colmenapp.Controllers')
        .controller('finanzaController', [
            '$scope',
            finanzaController
        ]);

})();