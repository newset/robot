;
(function() {
    'use strict';

    angular.module('base_app', [
        'ui.router',
        'ui.bootstrap.tpls',
        'ui.bootstrap.tabs',
        'ui.bootstrap.pagination',
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
        'ngMaterial',
        '720kb.datepicker'
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
               
                // 
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

'use strict';
angular.module("ngLocale", [], ["$provide", function($provide) {
var PLURAL_CATEGORY = {ZERO: "zero", ONE: "one", TWO: "two", FEW: "few", MANY: "many", OTHER: "other"};
$provide.value("$locale", {
  "DATETIME_FORMATS": {
    "AMPMS": [
      "\u4e0a\u5348",
      "\u4e0b\u5348"
    ],
    "DAY": [
      "\u661f\u671f\u65e5",
      "\u661f\u671f\u4e00",
      "\u661f\u671f\u4e8c",
      "\u661f\u671f\u4e09",
      "\u661f\u671f\u56db",
      "\u661f\u671f\u4e94",
      "\u661f\u671f\u516d"
    ],
    "ERANAMES": [
      "\u516c\u5143\u524d",
      "\u516c\u5143"
    ],
    "ERAS": [
      "\u516c\u5143\u524d",
      "\u516c\u5143"
    ],
    "FIRSTDAYOFWEEK": 6,
    "MONTH": [
      "\u4e00\u6708",
      "\u4e8c\u6708",
      "\u4e09\u6708",
      "\u56db\u6708",
      "\u4e94\u6708",
      "\u516d\u6708",
      "\u4e03\u6708",
      "\u516b\u6708",
      "\u4e5d\u6708",
      "\u5341\u6708",
      "\u5341\u4e00\u6708",
      "\u5341\u4e8c\u6708"
    ],
    "SHORTDAY": [
        "\u65e5",
        "\u4e00",
        "\u4e8c",
        "\u4e09",
        "\u56db",
        "\u4e94",
        "\u516d"
    ],
    "SHORTMONTH": [
      "1\u6708",
      "2\u6708",
      "3\u6708",
      "4\u6708",
      "5\u6708",
      "6\u6708",
      "7\u6708",
      "8\u6708",
      "9\u6708",
      "10\u6708",
      "11\u6708",
      "12\u6708"
    ],
    "WEEKENDRANGE": [
      5,
      6
    ],
    "fullDate": "y\u5e74M\u6708d\u65e5EEEE",
    "longDate": "y\u5e74M\u6708d\u65e5",
    "medium": "y\u5e74M\u6708d\u65e5 ah:mm:ss",
    "mediumDate": "y\u5e74M\u6708d\u65e5",
    "mediumTime": "ah:mm:ss",
    "short": "yy/M/d ah:mm",
    "shortDate": "yy/M/d",
    "shortTime": "ah:mm"
  },
  "NUMBER_FORMATS": {
    "CURRENCY_SYM": "\u00a5",
    "DECIMAL_SEP": ".",
    "GROUP_SEP": ",",
    "PATTERNS": [
      {
        "gSize": 3,
        "lgSize": 3,
        "maxFrac": 3,
        "minFrac": 0,
        "minInt": 1,
        "negPre": "-",
        "negSuf": "",
        "posPre": "",
        "posSuf": ""
      },
      {
        "gSize": 3,
        "lgSize": 3,
        "maxFrac": 2,
        "minFrac": 2,
        "minInt": 1,
        "negPre": "-\u00a4\u00a0",
        "negSuf": "",
        "posPre": "\u00a4\u00a0",
        "posSuf": ""
      }
    ]
  },
  "id": "zh",
  "pluralCat": function(n, opt_precision) {  return PLURAL_CATEGORY.OTHER;}
});
}]);
