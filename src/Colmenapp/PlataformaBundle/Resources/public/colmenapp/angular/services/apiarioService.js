
(function(){

  "use strict";

  var apiarioService = function($http, $q) {

    var $ = this;
    $.apiarios = [];

    function getApiarios() {
      var apiarios = []
      return $http.get(Routing.generate('apiario_todos'))
        .then(function(response) {
          if(response.data.status == 200) {
            $.apiarios = response.data.data;
            return $q.resolve($.apiarios);
          }
        })
    }

    this.getApiarios = getApiarios;

  };

  angular.module("colmenapp.Services")
    .service("apiarioService",[
      '$http',
      '$q',
      apiarioService
    ]);

})();