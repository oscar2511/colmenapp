
(function() {

  'use strict';

  var colmenaController = function($scope, $http, i18nService, toaster, notificacionService, loader) {

    i18nService.setCurrentLang('es'); //idioma de tabla

    $scope.colmena      = {};
    $scope.mostrarModal = false;

    /**
     * Crear una colmena
     * @param colmenaForm
     */
    $scope.guardarColmena = function(colmenaForm) {
      loader.start();
      var dataApiario = {};
      dataColmena.nombre      = colmenaForm.nombre;
      dataColmena.direccion   = colmenaForm.direccion;
      dataColmena.observacion = colmenaForm.observacion;

      $http.post(Routing.generate('colmena_crear'), dataApiario)
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
    function getColmenas(idApiario) {
      loader.start();
      $http.get(Routing.generate('colmenas'))
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
            enableColumnResizing: true,
            headTemplate: '<div align="center">{{row.entity.id}}</div>'
          },
          {
            field: 'identificador',
            enableColumnResizing: true
          },
          {field: 'apiario'},
          {
            field: 'tipo',
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'Rejilla Excluidora',
            cellTemplate: '<div align="center" class="ngCellText"><a ng-href="detalle/{{row.entity.id}}"><i class="fa fa-fw fa-eye"></i></a></div>',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'Camara Cria',
            cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'En Observacion',
            cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'Ultima Visita',
            cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'Estado',
            cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false
          },
          {
            field: 'Ver',
            cellTemplate: '<div align="center" data-toggle="modal" data-target=".modal-editar-apiario" class="ngCellText"><a ng-href="#" ng-click="grid.appScope.mostrarEditar(row.entity)"><i class="fa fa-fw fa-edit"></i></a></div>',
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
    getColmenas();

  };

  angular.module('colmenapp.Controllers')
    .controller('colmenaController', [
      '$scope',
      '$http',
      'i18nService',
      'toaster',
      'notificacionService',
      'cfpLoadingBar',
      colmenaController
    ]);

})();
