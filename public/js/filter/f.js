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
                if (!theDate) {
                    return '';
                };
                var format = format || 'yyyy-MM-dd',
                    date = new Date(theDate);

                // firefox fix
                if (date == 'Invalid Date' && theDate) {
                    date = new Date(theDate.replace(/-/g,'/'));
                };
               return angularDateFilter(date, format);
           }
        })
       .filter('unBreak', function () {
            return function(value) {
                if(!angular.isString(value)) {
                    return value;
                }  
                return value.replace(/\<br\>/g, ' '); // you could use .trim, but it's not going to work in IE<9
            };
        });
})();
