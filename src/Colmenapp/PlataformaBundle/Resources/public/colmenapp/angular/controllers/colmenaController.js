
(function() {

    'use strict';

    var colmenaController = function($scope, $http) {

        //grafico numero de abejas en colonia
        $scope.labels = ["", "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $scope.data   = [0, 200, 180, 170, 190, 210, 250, 270, 270, 210, 210, 240, 260];1

    };

    angular.module('colmenapp.Controllers')
        .controller('colmenaController', [
            '$scope',
            '$http',
            colmenaController
        ]);

})();