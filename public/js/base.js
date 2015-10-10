;
(function() {
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
            '$interpolateProvider', '$mdDateLocaleProvider',
            function($interpolateProvider, $mdDateLocaleProvider) {
                $interpolateProvider.startSymbol('[:');
                $interpolateProvider.endSymbol(':]');

                $mdDateLocaleProvider.months = ['一', '二','三月','四月','五月','六月','七月','八月','九月','十月','十一月', '十二月'];
                $mdDateLocaleProvider.shortMonths = ['一', '二','三','四','五','六','七','八','九','十','十一', '十二'];
                $mdDateLocaleProvider.days = ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日'];
                $mdDateLocaleProvider.shortDays = ['一', '二', '三', '四', '五', '六', '日'];
                // Can change week display to start on Monday.
                $mdDateLocaleProvider.firstDayOfWeek = 0;
               
            }
        ])
        .run(['$rootScope', '$state', function($rootScope, $state) {
            $rootScope.$state = $state;

            $rootScope.$on('$stateChangeStart',
                function(event){ 
                    $('#main-content .load-container').show();
                    $('#main-content .load-container+div[ui-view]').hide();
            });
            $rootScope.$on('$stateChangeSuccess',
                function(event, toState, toParams, fromState, fromParams){ 
                    $('#main-content .load-container').hide();
                    $('#main-content .load-container+div[ui-view]').show();

            });

            $rootScope.$on('$stateChangeError',
                function(event, toState, toParams, fromState, fromParams){ 
                    $('#main-content .load-container+div[ui-view]').show();
                    $('#main-content .load-container').hide();
            });
        }])
})();
