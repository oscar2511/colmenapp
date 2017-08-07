
(function(){

  "use strict";

  var colmenaService = function($http, $q) {

    var $ = this;
    $.colmenas = [];

    /**
     * Obtener todas las colmenas para un apiario
     * @param apiarioId
     * @returns {*}
     */
    function getColmenas(apiarioId) {
      var colmenas = [];
      return $http.get(Routing.generate('colmenas', {apiarioId: apiarioId}))
        .then(function(response) {
          if(response.data.status == 200) {
            $.colmenas = response.data.data;
            return $q.resolve($.colmenas);
          }
        })
    }

    /**
     * Crear colmena
     * @param dataColmena
     * @returns {*}
     */
    function crearColmena(dataColmena) {
      return $http.post(Routing.generate('colmena_crear'), dataColmena)
        .then(function(response) {
            return $q.resolve(response);
        })
        .catch(function(e) {
          return $q.reject(e);
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
    .service("colmenaService",[
      '$http',
      '$q',
      colmenaService
    ]);

})();
