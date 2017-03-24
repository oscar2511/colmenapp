
(function() {

    'use strict';

    var apiarioController = function($scope, $http) {


      $scope.guardarApiario = function(apiarioForm) {
        //todo: validar
        var dataApiario = {};
        dataApiario.nombre      = apiarioForm.nombre;
        dataApiario.direccion   = apiarioForm.direccion;
        dataApiario.observacion = apiarioForm.observacion;

        $http.post(Routing.generate('apiario_crear'), dataApiario);
        console.log(dataApiario);
      };

    };

    angular.module('colmenapp.Controllers')
        .controller('apiarioController', [
            '$scope',
            '$http',
            apiarioController
        ]);

})();