
(function() {

  'use strict';

  var colmenaController = function(
    $scope,
    $http,
    i18nService,
    notificacionService,
    loader,
    apiarioService,
    colmenaService) {

    i18nService.setCurrentLang('es');

    $scope.colmena      = {};
    $scope.mostrarModal = false;
    $scope.mostrarTabla = false;
    $scope.mostrarSelApiario = true;
    $scope.ocultarIdentificador = false;
    $scope.errorMultiple = false;

    /**
     * Crear una colmena
     * @param colmenaForm
     */
    $scope.guardarColmena = function(colmenaForm) {
      $scope.limpiarForm();
      loader.start();
      $scope.mostrarSpinner = true;
      var dataColmena = {};
      dataColmena.apiarioId     = $scope.apiarioSeleccionado;
      dataColmena.identificador = colmenaForm.identificador;
      dataColmena.tipo          = colmenaForm.tipo;
      dataColmena.rejilla       = colmenaForm.rejilla;
      dataColmena.camaraCria    = colmenaForm.camara;
      dataColmena.multiple      = colmenaForm.multiple;

      colmenaService.crearColmena(dataColmena)
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


    $scope.limpiarForm = function() {
      $scope.colmenaForm = {};
      $scope.ocultarIdentificador = false;
      $scope.errorMultiple = false;
    };


    /**
     * Obtener todos los tipos de colmenas
     */
    function getTipoColmenas() {
      $http.get(Routing.generate('colmenas_tipos'))
        .then(function(response) {
          if(response.data.status == 200) {
            $scope.tiposColmenas = response.data.data;
          }
        })
    }

    /**
     * Mostrar modal editar apiario
     * @param apiario
     */
    $scope.mostrarEditar = function(colmena) {
      console.log(colmena);
      $scope.editForm = {
        id            : colmena.id,
        idApiario     : $scope.apiarioSeleccionado,
        identificador : colmena.identificador,
        tipo          : colmena.tipo,
        rejilla       : colmena.rejillaExcluidora,
        camara        : colmena.camaraCria,
        enObservacion : colmena.enObservacion,
        estado        : colmena.estado
      };
    };

    /**
     * Editar una colmena
     * @param colmena
     */

    $scope.editar = function(colmena) {
      $scope.mostrarSpinner = true;
      colmenaService.editarColmena(colmena)
        .then(function(response) {
            notificacionService.mostrarNotificacion('success', "Colmena Editada!", "");
            getColmenas($scope.apiarioSeleccionado);
            setTable();
        })
        .finally(function() {
          loader.complete();
        })
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

    /**
     * @param {number} multiple
     */
    $scope.checkMultipleActivado = function(multiple) {
      if(multiple && multiple > 0 && multiple < 100) {
        $scope.ocultarIdentificador = true;
        $scope.errorMultiple = false;
      }
      else {
        console.log(multiple);
        if (multiple > 100)
          $scope.errorMultiple = true;
        else {
          $scope.ocultarIdentificador = false;
          $scope.errorMultiple = false;
        }
      }
    };

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
      getColmenas(apiario);
    };

    function getApiarios() {
      apiarioService.getApiarios()
        .then(function(apiarios) {
          $scope.apiarios = apiarios;
        })
    }

    setTable();
    getTipoColmenas();
    getApiarios();

  };

  angular.module('colmenapp.Controllers')
    .controller('colmenaController', [
      '$scope',
      '$http',
      'i18nService',
      'notificacionService',
      'cfpLoadingBar',
      'apiarioService',
      'colmenaService',
      colmenaController
    ]);

})();
