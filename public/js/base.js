;(function ()
{
    'use strict';

    angular.module('base_app', [
        'ui.router',
        'ui.bootstrap',
        'ngDialog',
        'angular.filter',
        'ngFileUpload',

        'la.directive',
        'la.service',

        'base_app.router',
        'base_app.service',
        'base_app.controller',
        'base_app.directive',
        'base_app.filter',
        'ngMaterial'
    ])

        .config([
            '$interpolateProvider',
            function($interpolateProvider)
            {
                $interpolateProvider.startSymbol('[:');
                $interpolateProvider.endSymbol(':]');
            }
        ])
        .run(['$rootScope', '$state', function ($rootScope, $state) {
            $rootScope.$state = $state
        }])
})();