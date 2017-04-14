
(function() {

    'use strict';

    var inspeccionController = function(
      $scope,
      $http,
      i18nService,
      notificacionService,
      loader,
      apiarioService,
      inspeccionService) {

      i18nService.setCurrentLang('es');

      $scope.mostrarSinRegistrosMsj = false;
      $scope.mostrarSelApiario = true;

      function getApiarios() {
        apiarioService.getApiarios()
          .then(function(apiarios) {
            $scope.apiarios = apiarios;
          })
      }


      function setTable() {
        $scope.gridOptionsInspeccion = {
          paginationPageSizes: [10, 25, 50],
          paginationPageSize: 5,
          enableSorting: true,
          enableFiltering: true,
          rowHeight: 50,
          enableHorizontalScrollbar: 0,
          enableVerticalScrollbar:0,
          enableColumnResizing: true,
          plugins: [new ngGridFlexibleHeightPlugin()],
          columnDefs: [
            {
              field: 'id',displayName: 'Número',
              enableColumnResizing: true
            },
            {
              field: 'fecha',displayName: 'Fecha',
              cellTemplate: '<div class="celda margIzq">{{row.entity.fecha}}</div>'
            },
            {
              field: 'tarearealizada',displayName: 'T. Realizada',
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda margIzq">{{row.entity.tareaRealizada}}</div>'
            },
            {
              field: 'tareaEnColmena',displayName: 'T. en Colmena',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" align="center" ng-if="row.entity.tareaEnColmena"><i class="fa fa-fw fa-check success"></i></div><div align="center" ng-if="!row.entity.tareaEnColmena">--</div>'
            },
            {
              field: 'observacion',displayName: 'Observación',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" align="center" ng-if="row.entity.observacion">{{row.entity.observacion}}</div><div align="center" ng-if="!row.entity.observacion">--</div>'
            },
            {
              field: 'Acciones',
              cellTemplate: '<div align="center" class="ngCellText">' +

              '<a ng-href="detalle/{{row.entity.id}}"><i class="fa fa-fw fa-eye"></i></a>' +
                '<br>'+
              '<a ng-href="#" data-toggle="modal" data-target=".modal-editar-colmena" ng-click="grid.appScope.mostrarEditar(row.entity)">' +
                '<i class="fa fa-fw fa-edit"></i>' +
              '</a>' +
              '</div>',
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

      $scope.seleccionarApiario = function(apiario) {
        $scope.mostrarSelApiario = false;
        $scope.mostrarTabla   = true;
        $scope.mostrarSpinner = true;
        $scope.apiarioSeleccionado = apiario;
        getInspecciones(apiario);
      };

      /**
       * Obtener todos los apiarios y crear tabla
       */
      function getInspecciones(idApiario) {
        loader.start();
        inspeccionService.getInspecciones(idApiario)
          .then(function(response) {
            if(response) {
              $scope.gridOptionsInspeccion.data = response;
              $scope.mostrarSpinner          = false;
              $scope.mostrarSinRegistrosMsj  = false;
            } else {
              $scope.mostrarSinRegistrosMsj = true;
              $scope.mostrarSpinner         = false;
              $scope.mostrarTabla           = false;
            }
          })
          .finally(function() {
            loader.complete();
          });
      }

      function getApiarios() {
        apiarioService.getApiarios()
          .then(function(apiarios) {
            $scope.apiarios = apiarios;
          })
      }

      /**
       * Crear una colmena
       * @param colmenaForm
       */
      $scope.crearInspeccion = function(inspeccionForm) {
        $scope.limpiarForm();
        loader.start();
        $scope.mostrarSpinner = true;
        var dataInspeccion = {};
        dataInspeccion.apiarioId     = $scope.apiarioSeleccionado;
        dataInspeccion.identificador = colmenaForm.identificador;
        dataInspeccion.tipo          = colmenaForm.tipo;
        dataInspeccion.rejilla       = colmenaForm.rejilla;
        dataInspeccion.camaraCria    = colmenaForm.camara;
        dataInspeccion.multiple      = colmenaForm.multiple;

        InspeccionService.crearColmena(dataColmena)
          .then(function() {
              notificacionService.mostrarNotificacion('success', "Colmena Creada!", "");
              getColmenas($scope.apiarioSeleccionado);
              setTable();
              $scope.mostrarSpinner = false;
          })
          .finally(function() {
            loader.complete();
          });
      };

      /**
       * Crear una colmena
       * @param colmenaForm
       */
      $scope.guardarInspeccion = function(inspeccionForm) {
        $scope.limpiarForm();
        loader.start();
        $scope.mostrarSpinner = true;
        var dataInspeccion = {};
        dataInspeccion.apiarioId      = $scope.apiarioSeleccionado;
        dataInspeccion.fecha          = inspeccionForm.fecha.toISOString().substring(0, 10);;
        dataInspeccion.tareaRealizada = inspeccionForm.tareaRealizada;
        dataInspeccion.tareaEnColmena = inspeccionForm.tareaEnColmena;
        dataInspeccion.observacion    = inspeccionForm.observacion;

        inspeccionService.crearInspeccion(dataInspeccion)
          .then(function() {
              notificacionService.mostrarNotificacion('success', "Colmena Creada!", "");
              getInspecciones($scope.apiarioSeleccionado);
              setTable();
              $scope.mostrarSpinner = false;
          })
          .finally(function() {
            loader.complete();
          });
      };

      $scope.limpiarForm = function() {
        $scope.apiarioForm = {};
      };

      getApiarios();
      setTable();



    };

    angular.module('colmenapp.Controllers')
        .controller('inspeccionController', [
            '$scope',
            '$http',
            'i18nService',
            'notificacionService',
            'cfpLoadingBar',
            'apiarioService',
            'inspeccionService',
            inspeccionController
        ]);

})();
