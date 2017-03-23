
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

      ///////////////////////////////

      $scope.gridOptions = {
        paginationPageSizes: [10,25, 50, 75],
        paginationPageSize: 5,
        enableSorting: true,
        enableFiltering: true,
        rowHeight: 50,
        enableColumnResizing: true,
        columnDefs: [
          { field: 'name',enableColumnResizing: true },
          { field: 'age' },
          { field: 'location',
            cellTemplate: '<div class="ngCellText"><a ng-href="/#/monitor/{{row.entity.age}}">Ver</a></div>',
            enableSorting: false}
        ],
        onRegisterApi: function (gridApi) {
          $scope.grid1Api = gridApi;
        }
      };
      $scope.users = [
        { name: "Madhav Saiccs ccs dcdsMadhav Saiccs ccs dcdsMadhav Saiccs ccs dcdsMadhav Saiccs ccs dcdsMadhav Saiccs ccs dcdsMadhav Saiccs ccs dcdsMadhav Saiccs ccs dcds", age: 10, location: 'Nagpu' },
        { name: "Suresh Dasari", age: 30, location: 'Chennai' },
        { name: "Rohini Alavala", age: 29, location: 'Chennai' },
        { name: "Praveen Kumar", age: 25, location: 'Bangalore' },
        { name: "Sateesh Chandra", age: 27, location: 'Vizag' },
        { name: "Siva Prasad", age: 38, location: 'Nagpur' },
        { name: "Sudheer Rayana", age: 25, location: 'Kakinada' },
        { name: "Honey Yemineni", age: 7, location: 'Nagpur' },
        { name: "Mahendra Dasari", age: 22, location: 'Vijayawada' },
        { name: "Mahesh Dasari", age: 23, location: 'California' },
        { name: "Nagaraju Dasari", age: 34, location: 'Atlanta' },
        { name: "Gopi Krishna", age: 29, location: 'Repalle' },
        { name: "Sudheer Uppala", age: 19, location: 'Guntur' },
        { name: "Madhav Sai", age: 10, location: 'Nagpur' },
        { name: "Suresh Dasari", age: 30, location: 'Chennai' },
        { name: "Rohini Alavala", age: 29, location: 'Chennai' },
        { name: "Praveen Kumar", age: 25, location: 'Bangalore' },
        { name: "Sateesh Chandra", age: 27, location: 'Vizag' },
        { name: "Siva Prasad", age: 38, location: 'Nagpur' },
        { name: "Sudheer Rayana", age: 25, location: 'Kakinada' },
        { name: "Honey Yemineni", age: 7, location: 'Nagpur' },
        { name: "Mahendra Dasari", age: 22, location: 'Vijayawada' },
        { name: "Mahesh Dasari", age: 23, location: 'California' },
        { name: "Nagaraju Dasari", age: 34, location: 'Atlanta' },
        { name: "Gopi Krishna", age: 29, location: 'Repalle' },
        { name: "Sudheer Uppala", age: 19, location: 'Guntur' },
        { name: "Madhav Sai", age: 10, location: 'Nagpur' },
        { name: "Suresh Dasari", age: 30, location: 'Chennai' },
        { name: "Rohini Alavala", age: 29, location: 'Chennai' },
        { name: "Praveen Kumar", age: 25, location: 'Bangalore' },
        { name: "Sateesh Chandra", age: 27, location: 'Vizag' },
        { name: "Siva Prasad", age: 38, location: 'Nagpur' },
        { name: "Sudheer Rayana", age: 25, location: 'Kakinada' },
        { name: "Honey Yemineni", age: 7, location: 'Nagpur' },
        { name: "Mahendra Dasari", age: 22, location: 'Vijayawada' },
        { name: "Mahesh Dasari", age: 23, location: 'California' },
        { name: "Nagaraju Dasari", age: 34, location: 'Atlanta' },
        { name: "Gopi Krishna", age: 29, location: 'Repalle' },
        { name: "Sudheer Uppala", age: 19, location: 'Guntur' },
        { name: "Sushmita", age: 27, location: 'Vizag' }
      ];
      $scope.gridOptions.data = $scope.users;

    };

    angular.module('colmenapp.Controllers')
        .controller('dashboardController', [
            '$scope',
            dashboardController
        ]);

})();