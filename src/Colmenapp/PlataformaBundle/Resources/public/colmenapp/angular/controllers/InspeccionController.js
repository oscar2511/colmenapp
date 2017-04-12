
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

      function getApiarios() {
        apiarioService.getApiarios()
          .then(function(apiarios) {
            $scope.apiarios = apiarios;
          })
      }


      function setTable() {
        $scope.gridOptionsColmena = {
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
              field: 'identificador',displayName: 'Identificador',
              cellTemplate: '<div class="celda margIzq">{{row.entity.identificador}}</div>'
            },
            {
              field: 'created',displayName: 'Creado',
              enableColumnResizing: true,
              cellTemplate: '<div class="celda margIzq" class="celda margIzq">{{row.entity.created}}</div>'
            },
            {
              field: 'tipo',displayName: 'Tipo',
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda margIzq" ng-if="row.entity.tipo">{{row.entity.tipo.descripcion}}</div><div ng-if="!row.entity.tipo">No especificado</div>'
            },
            {
              field: 'rejillaExcluidora',displayName: 'Rej. Excluidora',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" align="center" ng-if="row.entity.rejillaExcluidora"><i class="fa fa-fw fa-check success"></i></div><div align="center" ng-if="!row.entity.tipo">--</div>'
            },
            {
              field: 'camaraCria',displayName: 'Cam. Cría',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" align="center" ng-if="row.entity.camaraCria">{{row.entity.camaraCria}}</div><div align="center" ng-if="!row.entity.camaraCria">--</div>'
            },
            {
              field: 'enObservacion', displayName: 'En Observ.',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" align="center" ng-if="row.entity.enObservacion"><small class="label bg-yellow"><i class="fa fa-fw fa-exclamation"></i></small></div><div class="celda" align="center" ng-if="!row.entity.enObservacion">No</div>'
            },
            {
              field: 'ultimaVisita', displayName: 'U. Visita',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div ng-if="row.entity.ultimaVisita" class="celda margIzq">{{row.entity.ultimaVisita}}</div><div align="center" class="celda margIzq" ng-if="!row.entity.ultimaVisita">---</div>'
            },
            {
              field: 'estado',displayName: 'Estado',
              enableSorting: false,
              enableFiltering: false,
              enableHiding: false,
              cellTemplate: '<div class="celda" ng-if="!row.entity.estado" align="center"><span class="badge bg-green">Activa</span></div><div class="celda" ng-if="row.entity.estado"><span class="badge bg-red">Inactiva</span></div>'
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
      function getColmenas(idApiario) {
        loader.start();
        colmenaService.getcolmenas(idApiario)
          .then(function(response) {
            if(response) {
              $scope.gridOptionsColmena.data = response;
              $scope.mostrarSpinner = false;
            }
          }).finally(function() {
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
