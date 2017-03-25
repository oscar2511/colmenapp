
(function() {

    'use strict';

    var apiarioController = function($scope, $http) {

        $scope.apiario = {};
        $scope.mostrarModal = false;

        /**
         * Mostrar modal crear apiario
         */
        $scope.mostrarModalCrear = function() {
          $scope.mostrarModal = true;
        };

        $scope.ocultarModalCrear = function() {
            $scope.mostrarModal = false;
        };
        /**
         *
         * @param apiarioForm
         */
        $scope.guardarApiario = function(apiarioForm) {
          var dataApiario = {};
          dataApiario.nombre      = apiarioForm.nombre;
          dataApiario.direccion   = apiarioForm.direccion;
          dataApiario.observacion = apiarioForm.observacion;

          $http.post(Routing.generate('apiario_crear'), dataApiario)
              .then(function(response) {
                if(response.data.data          = 200 && response.data.data) {
                    $scope.apiario.id          = response.data.data.id;
                    $scope.apiario.nombre      = response.data.data.nombre;
                    $scope.apiario.direccion   = response.data.data.direccion;
                    $scope.apiario.observacion = response.data.data.observacion;
                }
                  getApiarios();
                  setTable();
              });
        };

        function getApiarios() {

            $http.get(Routing.generate('apiario_todos'))
                .then(function(response) {
                    if(response.data.status == 200) {
                        $scope.gridOptionsApiario.data = response.data.data;
                    }
                });
        }

        function setTable() {
            $scope.gridOptionsApiario = {
                paginationPageSizes: [10, 25, 50],
                paginationPageSize: 5,
                enableSorting: true,
                enableFiltering: true,
                rowHeight: 50,
                enableColumnResizing: true,
                columnDefs: [
                    {field: 'id', enableColumnResizing: true},
                    {field: 'nombre', enableColumnResizing: true},
                    {field: 'direccion'},
                    {field: 'nroCol', enableColumnResizing: true},
                    {field: 'Ult. Visita', enableColumnResizing: true},
                    {field: 'observacion'},
                    {
                        field: 'location',
                        cellTemplate: '<div align="center" class="ngCellText"><a ng-href="/#/monitor/{{row.entity.nombre}}">Ver</a></div>',
                        enableSorting: false
                    }
                ],
                onRegisterApi: function (gridApi) {
                    $scope.grid1Api = gridApi;
                }
            }
        }

        setTable();
        getApiarios();

    };

    angular.module('colmenapp.Controllers')
        .controller('apiarioController', [
            '$scope',
            '$http',
            apiarioController
        ]);

})();