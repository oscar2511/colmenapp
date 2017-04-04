
(function() {

    'use strict';

    var apiarioController = function($scope, $http, i18nService, notificacionService, loader) {

        i18nService.setCurrentLang('es'); //idioma de tabla
        $scope.apiario        = {};
        $scope.mostrarModal   = false;
        $scope.mostrarSpinner = true;

        /**
         * Crear un apiario
         * @param apiarioForm
         */
        $scope.guardarApiario = function(apiarioForm) {
          $scope.mostrarSpinner = true;
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
                  $scope.mostrarSpinner = false;
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
                        $scope.mostrarSpinner = false;
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
                      enableColumnResizing: true,
                      headTemplate: '<div align="center">{{row.entity.id}}</div>'
                    },
                    {
                      field: 'nombre',
                       enableColumnResizing: true
                     },
                    {field: 'direccion'},
                    {
                      field: 'observacion',
                      enableFiltering: false,
                      enableHiding: false
                    },
                    {
                      field: 'Ver',
                      cellTemplate: '<div align="center" class="ngCellText"><a ng-href="detalle/{{row.entity.id}}"><i class="fa fa-fw fa-eye"></i></a></div>',
                      enableSorting: false,
                      enableFiltering: false,
                      enableHiding: false
                    },
                    {
                      field: 'Editar',
                      cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
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
        $scope.mostrarSpinner = true;
        $http.post(Routing.generate('apiario_editar'), apiario)
          .then(function(response) {
            if(response.data.data = 200 && response.data.data) {
              notificacionService.mostrarNotificacion('success', "Apiario Editado!", "");
            }
            getApiarios();
            setTable();
            $scope.mostrarSpinner = false;
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
            'notificacionService',
            'cfpLoadingBar',
            apiarioController
        ]);

})();
