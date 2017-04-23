
(function(){

  "use strict";

  var reinaService = function($http, $q) {

    var $ = this;
    $.razas = [];

    /**
     * Obtener todas las inspecciones de un apiario
     * @param apiarioId
     * @returns {*}
     */
    function getRazas() {
      var razas = [];
      return $http.get(Routing.generate('reina_razas'))
        .then(function(response) {
          if(response.status === 200 && response.data.data.length > 0 ) {
            $.razas = response.data.data;
            return $q.resolve($.razas);
          }
          return $q.resolve(false);
        })
    }

    /**
     * Crear inspeccion
     * @param dataColmena
     * @returns {*}
     */
    function getReina(reinaId) {
      return $http.post(Routing.generate('reina'), reinaId)
        .then(function(response) {
            return $q.resolve(response);
          })
          .catch(function(e) {
            return $q.reject(e);
          })
    }


    this.getRazas = getRazas;
    this.getReina = getReina;

  };

  angular.module("colmenapp.Services")
    .service("reinaService",[
      '$http',
      '$q',
      reinaService
    ]);

})();
