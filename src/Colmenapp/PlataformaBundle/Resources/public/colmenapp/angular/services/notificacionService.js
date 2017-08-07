
(function(){

  "use strict";

  var notificacionService = function(toaster) {

    var $ = this;

    function mostrarNotificacion(tipo, titulo, texto) {
      toaster.pop(tipo, titulo, texto);
    }

    this.mostrarNotificacion = mostrarNotificacion;
  };

  angular.module("colmenapp.Services")
    .service("notificacionService",[
      'toaster',
      notificacionService
    ]);

})();