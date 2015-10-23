;
(function ()
{
    'use strict';
    angular.module('la.directive', [])

        .directive("compareTo", function ()
        {
            return {
                require: "ngModel",
                scope: {
                    otherModelValue: "=compareTo"
                },
                link: function (scope, element, attributes, ngModel)
                {

                    ngModel.$validators.compareTo = function (modelValue)
                    {
                        return modelValue == scope.otherModelValue;
                    };

                    scope.$watch("otherModelValue", function ()
                    {
                        ngModel.$validate();
                    });
                }
            };
        })

        .directive(
        'dateInput',
        function (dateFilter)
        {
            return {
                require: 'ngModel',
                template: '<input type="date">',
                replace: true,
                link: function (scope, elm, attrs, ngModelCtrl)
                {
                    ngModelCtrl.$formatters.unshift(function (modelValue)
                    {
                        return dateFilter(modelValue, 'yyyy-MM-dd');
                    });

                    ngModelCtrl.$parsers.unshift(function (viewValue)
                    {
                        return new Date(viewValue);
                    });
                },
            };
        })

        .directive('laPattern',
        [
            function
                ()
            {
                var o =
                {
                    strict: 'A',
                    require: 'ngModel',
                    scope: {
                        'laPattern': '@'
                    },
                    link: function (sco, ele, att, con)
                    {
                        var REGEX = RegExp(sco.laPattern);

                        con.$validators.laPattern = function (mVal, vVal)
                        {
                            if (!sco.laPattern) return false;

                            if (con.$isEmpty(mVal))
                                return true;

                            console.log('vVal: ', vVal);
                            console.log('REGEX: ', REGEX);

                            console.log('sco.laPattern: ', sco.laPattern);

                            console.log('REGEX.test( vVal ): ', REGEX.test(vVal));


                            if (REGEX.test(vVal))
                                return true;
                            return false;
                        }
                    }
                }

                return o;
            }
        ])

        .directive('laRowNumMatch',
        [
            function
                ()
            {
                var o =
                {
                    strict: 'AE',
                    require: 'ngModel',
                    scope: {
                        'target': '=laRowNumMatch',
                        'arrayReceiver': '=?'
                    },
                    link: function (sco, ele, att, con)
                    {
                        con.$validators.laRowNumMatch = function (mVal, vVal)
                        {
                            if (!sco.target) return false;

                            if (con.$isEmpty(mVal))
                                return true;

                            var arr = vVal.split('\n');
                            for(var i=0; i < arr.length; i++)
                            {
                                arr[i] = $.trim(arr[i]);
                            }

                            sco.arrayReceiver = arr;

                            return sco.arrayReceiver.length == sco.target
                        }

                        sco.$watch("target", function ()
                        {
                            console.log('sco.target: ', sco.target);

                            con.$validate();
                        });
                    }
                }

                return o;
            }
        ])

        .directive('laToggleInputType',
        [
            function ()
            {
                var o = {};
                o.scope =
                {
                    laToggleInputType: '@',
                    laTarget: '@',
                    laOn: '@',
                }

                o.link = function (sco, ele, att, con)
                {
                    var target_ele = $('#' + sco.laTarget),
                        from_type = target_ele.prop('type'),
                        to_type = sco.laToggleInputType || 'text',
                        toggle_state = true,
                        event_name = sco.laOn || 'mousedown';

                    ele.css({
                        'cursor': 'pointer',
                        '-webkit-touch-callout': 'none',
                        '-webkit-user-select': 'none',
                        '-khtml-user-select': 'none',
                        '-moz-user-select': 'none',
                        '-ms-user-select': 'none',
                        'user-select': 'none',
                    });

                    if (event_name === 'mousedown')
                    {
                        ele.on(event_name, change_to)
                        ele.on('mouseup', change_back)
                        ele.on('mouseout', change_back)
                    }
                    else
                    {
                        ele.on(event_name, toggle)
                    }

                    function toggle()
                    {
                        toggle_state ? change_to() : change_back();

                        toggle_state = !toggle_state;
                    }

                    function change_to()
                    {
                        target_ele.attr('type', to_type);
                    }

                    function change_back()
                    {
                        target_ele.attr('type', from_type);
                    }


                }

                return o;
            }
        ])

        /* Pass maker url, maker should return a img url.*/
        .directive('laCaptcha',
        [
            'H',
            function (H)
            {
                var o = {};
                o.scope =
                {
                    laCaptcha: '@'
                }

                o.template = '<img ng-src="[:addr:]">';

                o.link = function (sco, ele, att, con)
                {
                    var captcha_maker = sco.laCaptcha;
                    var refresh = refresh;
                    ele.on('click', refresh).css({'cursor': 'pointer'})

                    function refresh()
                    {
                        return H.captcha.make(captcha_maker)
                            .then(function (d)
                            {
                                console.log('d: ', d);
                                sco.addr = d;
                            })
                    }

                    refresh();
                }

                return o;
            }
        ])

        /* accept three params
         * ins_name
         * key (field_name)
         * value
         * */
        .directive('laExist', [
            '$q', 'H',
            function ($q, H)
            {
                var o = {};
                o.require = 'ngModel';
                //o.scope = {
                //    laInsName: '@',
                //    laK: '@laExist',
                //}
                o.link = function (sco, ele, att, con)
                {
                    var conf_string = att.laExist,
                        conf = conf_string.split('.');

                    return con.$asyncValidators.laExist = function (mV, vV)
                    {
                        return H.record_exist(conf[0], conf[1], vV)
                            .then(function (r)
                            {
                                console.log('r: ', r);
                                if (parseInt(r.data.d) === 1)
                                    return $q.reject();
                                return true;
                            }, function (r)
                            {
                                return $q.reject();
                            })
                    }
                }

                return o;
            }
        ])

        .directive('laCaptchaCheck', [
            '$http', '$q',
            function ($http, $q)
            {
                return {
                    require: 'ngModel',
                    link: function (scope, element, attrs, ngModel)
                    {
                        ngModel.$asyncValidators.captcha_not_match = function (modelValue, viewValue)
                        {
                            return $http.post(cook('captcha/check'), {captcha_phrase: viewValue})
                                .then(function (r)
                                {
                                    if (parseInt(r.data.d) !== 1)
                                    {
                                        return $q.reject(r.data.errorMessage);
                                    }
                                    return true;
                                }
                            );
                        };
                    }
                };
            }]);
})();