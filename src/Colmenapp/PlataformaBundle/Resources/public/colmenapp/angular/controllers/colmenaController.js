
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
      dataColmena.identificador = angular.isUndefined(colmenaForm.identificador) ? colmenaForm.identificador : null;
      dataColmena.tipo          = colmenaForm.tipo;
      dataColmena.rejilla       = colmenaForm.rejilla;
      dataColmena.camaraCria    = colmenaForm.camara;

      colmenaService.crearColmena(dataColmena)
        .then(function() {
            notificacionService.mostrarNotificacion('success', "Apiario Guardado!", "");
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
    };


    /**
     * Obtener todos los tipos de colmenas
     */
    $scope.getTipoColmenas = function() {
      $http.get(Routing.generate('colmenas_tipos'))
        .then(function(response) {
          if(response.data.status == 200) {
            $scope.tiposColomenas = response.data.data;
          }
        })
    };

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

    function setTable() {
      $scope.gridOptionsColmena = {
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
            field: 'id',
            enableColumnResizing: true
          },
          {
            field: 'identificador'
          },
          {
            field: 'tipo',
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div  ng-if="row.entity.tipo">{{row.entity.tipo.descripcion}}</div><div ng-if="!row.entity.tipo">No especificado</div>'
          },
          {
            field: 'rejillaExcluidora',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div align="center" ng-if="row.entity.rejillaExcluidora"><i class="fa fa-fw fa-check success"></i></div><div align="center" ng-if="!row.entity.tipo">--</div>'
          },
          {
            field: 'camaraCria',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div align="center" ng-if="row.entity.camaraCria">{{row.entity.camaraCria}}</div><div align="center" ng-if="!row.entity.camaraCria">--</div>'
          },
          {
            field: 'enObservacion',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div align="center" ng-if="row.entity.enObservacion"><small class="label bg-yellow"><i class="fa fa-fw fa-exclamation"></i></small></div><div align="center" ng-if="!row.entity.enObservacion">No</div>'
          },
          {
            field: 'ultimaVisita',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div>----</div>'
          },
          {
            field: 'estado',
            enableSorting: false,
            enableFiltering: false,
            enableHiding: false,
            cellTemplate: '<div ng-if="!row.entity.estado" align="center"><span class="badge bg-green">Activa</span></div><div ng-if="row.entity.estado"><span class="badge bg-red">Inactiva</span></div>'
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
