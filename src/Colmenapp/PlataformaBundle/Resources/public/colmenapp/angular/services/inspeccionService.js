
(function(){

  "use strict";

  var inspeccionService = function($http, $q) {

    var $ = this;
    $.inspecciones = [];

    /**
     * Obtener todas las inspecciones para un apiario
     * @param apiarioId
     * @returns {*}
     */
    function getInspecciones(apiarioId) {
      var inspecciones = [];
      return $http.get(Routing.generate('inspecciones', {apiarioId: apiarioId}))
        .then(function(response) {
          if(response.data.status == 200) {
            $.inspecciones = response.data.data;
            return $q.resolve($.inspecciones);
          }
        })
    }

    /**
     * Crear inspeccion
     * @param dataColmena
     * @returns {*}
     */
    function crearInspeccion(dataInspeccion) {
      return $http.post(Routing.generate('inspeccion_crear'), dataInspeccion)
        .then(function(response) {
          if(response.data.data = 200 && response.data.data) {
            return $q.resolve(response);
          }
        })
    }

    function editarColmena(colmena) {
      return $http.post(Routing.generate('colmena_editar'), colmena)
        .then(function(response){
          if(response.data.data = 200 && response.data.data) {
            return $q.resolve(response);
          }
        })
    }

    this.getcolmenas   = getColmenas;
    this.crearColmena  = crearColmena;
    this.editarColmena = editarColmena;

  };

  angular.module("colmenapp.Services")
    .service("inspeccionService",[
      '$http',
      '$q',
      inspeccionService
    ]);

})();
