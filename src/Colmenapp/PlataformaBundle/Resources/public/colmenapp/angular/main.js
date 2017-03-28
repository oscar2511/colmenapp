
(function(){

    'use strict';

    angular
        .module('colmenapp',[
            'colmenapp.Controllers',
            'colmenapp.Services',
            'chart.js',
            'ui.grid',
            'ui.grid.pagination',
            'ui.grid.resizeColumns',
            'toaster',
            'ngAnimate'
        ]);

    angular.module('colmenapp.Controllers',[]);
    angular.module('colmenapp.Services',[]);

})();
