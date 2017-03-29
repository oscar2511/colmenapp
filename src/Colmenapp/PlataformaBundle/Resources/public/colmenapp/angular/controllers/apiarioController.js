
(function() {

    'use strict';

    var apiarioController = function($scope, $http, i18nService, toaster, notificacionService, loader) {

        i18nService.setCurrentLang('es'); //idioma de tabla

        $scope.apiario      = {};
        $scope.mostrarModal = false;


        /**
         * Crear un apiario
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
                    notificacionService.mostrarNotificacion('success', "Apiario Guardado!", "");
                }
                  getApiarios();
                  setTable();
              })
              .finally(function() {
                loader.complete();
              });
        };

        /**
        * Obtener todos los apiarios y crear tabla
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
                      cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)">Editar</a></div>',
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

      /**
       * Mostrar modal editar apiario
       * @param apiario
       */
        $scope.mostrarEditar = function(apiario) {
          console.log(apiario);
          $scope.editForm = {
            id          : apiario.id,
            nombre      : apiario.nombre,
            direccion   : apiario.direccion,
            observacion : apiario.observacion
          };
        };

      /**
       * Editar un apiario
       * @param apiario
       */
      $scope.editar = function(apiario) {
        $http.post(Routing.generate('apiario_editar'), apiario)
          .then(function(response) {
            if(response.data.data = 200 && response.data.data) {
              notificacionService.mostrarNotificacion('success', "Apiario Editado!", "");
            }
            getApiarios();
            setTable();
          }).finally(function() {
            loader.complete();
          })
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
