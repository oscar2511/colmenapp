
(function() {

    'use strict';

    var dashboardController = function($scope) {

        //grafico Ingresos/Egresos
        $scope.labels = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $scope.data   = [
            [3304,7921,4467, 8996,2678,7822,2678,7822,2678,7822,2678,7822],
            [5304,6921,7921, 4467,2899,4822,2899,4822,2899,4822,2899,4822]

        ];

        $scope.colorsIngresosEgresos = ['#45b7cd','#ff6384'];
        $scope.seriesIngresosEgresos = ['Ingresos', 'Egresos'];

      ////////////// grafico gastos

      $scope.labelsGastos = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
      $scope.dataGastos = [
        [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56],
        [28, 48, 40, 19, 86, 27, 90,65, 59, 80, 81, 56]
      ];
      $scope.seriesGastos = ['Los Algarrobos', 'Agua Blanca'];

      $scope.onClick = function (points, evt) {
        console.log(points, evt);
      };
      $scope.datasetOverrideGastos = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
      $scope.optionsGastos = {
        scales: {
          yAxes: [
            {
              id: 'y-axis-1',
              type: 'linear',
              display: true,
              position: 'left'
            },
            {
              id: 'y-axis-2',
              type: 'linear',
              display: true,
              position: 'right'
            }
          ]
        }
      };


    };

    angular.module('colmenapp.Controllers')
        .controller('dashboardController', [
            '$scope',
            dashboardController
        ]);

})();