;
(function ()
{
    'use strict';
    angular.module('base_app.filter', [])

        .filter('cut', function () {
            return function (value, wordwise, max, tail) {
                if (!value) return '';

                max = parseInt(max, 10);
                if (!max) return value;
                if (value.length <= max) return value;

                value = value.substr(0, max);
                if (wordwise) {
                    var lastspace = value.lastIndexOf(' ');
                    if (lastspace != -1) {
                        value = value.substr(0, lastspace);
                    }
                }

                return value + (tail || ' …');
            };
        })

        .filter('laDate', function($filter) {
           var angularDateFilter = $filter('date');
           return function(theDate, format) {
                var format = format || 'yyyy-MM-dd',
                    date = new Date(theDate);

                // firefox fix
                if (date == 'Invalid Date') {
                    date = new Date(theDate.replace(/-/g,'/'));
                };
               return angularDateFilter(date, format);
           }
        });
})();
