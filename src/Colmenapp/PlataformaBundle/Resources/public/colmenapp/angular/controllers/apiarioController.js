
(function() {

    'use strict';

    var apiarioController = function($scope, $http, i18nService, toaster, notificacionService, loader) {

        i18nService.setCurrentLang('es'); //idioma de tabla

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
          loader.start();
          var dataApiario = {};
          dataApiario.nombre      = apiarioForm.nombre;
          dataApiario.direccion   = apiarioForm.direccion;
          dataApiario.observacion = apiarioForm.observacion;

          $http.post(Routing.generate('apiario_crear'), dataApiario)
              .then(function(response) {
                if(response.data.data = 200 && response.data.data) {
                    $scope.apiario.id          = response.data.data.id;
                    $scope.apiario.nombre      = response.data.data.nombre;
                    $scope.apiario.direccion   = response.data.data.direccion;
                    $scope.apiario.observacion = response.data.data.observacion;
                }
                notificacionService.mostrarNotificacion('success', "Apiario Guardado!", "");
                  getApiarios();
                  setTable();
              }).finally(function() {
              loader.complete();
            });
        };

        /**
        *
        */
        function getApiarios() {
          loader.start();
            $http.get(Routing.generate('apiario_todos'))
                .then(function(response) {
                    if(response.data.status == 200) {
                        $scope.gridOptionsApiario.data = response.data.data;
                    }
                }).finally(function() {
                loader.complete();
              });
        }

        function setTable() {
            $scope.gridOptionsApiario = {
                paginationPageSizes: [10, 25, 50],
                paginationPageSize: 5,
                enableSorting: true,
                enableFiltering: true,
                rowHeight: 35,
                enableHorizontalScrollbar: 0,
                enableVerticalScrollbar:0,
                enableColumnResizing: true,
                plugins: [new ngGridFlexibleHeightPlugin()],
                columnDefs: [
                    {
                      field: 'id', displayName: 'Identificador',
                      enableColumnResizing: true
                    },
                    {field: 'nombre', enableColumnResizing: true},
                    {field: 'direccion'},
                    {
                      field: 'observacion',
                      enableFiltering: false,
                      enableHiding: false
                    },
                    {
                      field: 'Ver',
                      cellTemplate: '<div align="center" class="ngCellText"><a ng-href="/#/monitor/{{row.entity.nombre}}">Ver</a></div>',
                      enableSorting: false,
                      enableFiltering: false,
                      enableHiding: false
                    },
                    {
                      field: 'Editar',
                      cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.editar(row.entity)">Editar</a></div>',
                      enableSorting: false,
                      enableFiltering: false,
                      enableHiding: false
                    }
                ],
                onRegisterApi: function (gridApi) {
                    $scope.grid1Api = gridApi;
                }
            }
        }

        $scope.editar = function(apiario) {
          $scope.nombre      = apiario.nombre;
          $scope.observacion = apiario.observacion;
          $scope.direccion   = apiario.direccion;
        };

        setTable();
        getApiarios();

    };

    angular.module('colmenapp.Controllers')
        .controller('apiarioController', [
            '$scope',
            '$http',
            'i18nService',
            'toaster',
            'notificacionService',
            'cfpLoadingBar',
            apiarioController
        ]);

})();
