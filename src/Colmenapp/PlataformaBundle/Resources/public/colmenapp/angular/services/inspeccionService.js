
(function(){

  "use strict";

  var inspeccionService = function($http, $q) {

    var $ = this;
    $.inspecciones = [];

    /**
     * Obtener todas las inspecciones de un apiario
     * @param apiarioId
     * @returns {*}
     */
    function getInspecciones(apiarioId) {
      var inspecciones = [];
      return $http.get(Routing.generate('inspecciones', {apiarioId: apiarioId}))
        .then(function(response) {
          if(response.status === 200 && response.data.data.length > 0 ) {
            $.inspecciones = response.data.data;
            return $q.resolve($.inspecciones);
          }
          return $q.resolve(false);
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


    this.getInspecciones = getInspecciones;
    this.crearInspeccion = crearInspeccion;

  };

  angular.module("colmenapp.Services")
    .service("inspeccionService",[
      '$http',
      '$q',
      inspeccionService
    ]);

})();
