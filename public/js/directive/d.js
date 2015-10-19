;
(function ()
{
    'use strict';
    angular.module('base_app.directive', [])
    .directive('iToggle', [function () {
    	return {
    		restrict: 'A',
    		link: function (scope, elm, attr) {
    			$(elm).click(function() {
		            $(this).toggleClass('fa-chevron-down fa-chevron-up');
		        });
    		}
    	};
    }])
    .directive('mdDateWrapper', [function () {
        return {
            restrict: 'A',
            require : 'mdDatepicker',
            link: function (scope, iElement, iAttrs, controller) {
                console.log('md date controller:', controller);
            }
        };
    }])
    .directive('multiCheck', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, elm, attr, ngModel) {
                var getter = $parse(attr.holder),
                    value = Number(attr.value),
                    holder = getter(scope) || [];

                $(elm).prop('checked', holder.indexOf(value) != -1);
                function parse(){
                    var holder = getter(scope),
                        setter = getter.assign;

                    var checked = holder.indexOf(value) == -1
                    $(elm).prop('checked', checked);
                    if (checked) {
                        holder.push(value);
                    }else{
                        holder.splice(holder.indexOf(value), 1);
                    };

                    scope.$apply(function (scope) {
                          // Change bound variable
                        setter(scope, holder);
                    });
                }

                elm.on('click', parse);
            }
        };
    }])
    .directive('chosen', [function chosen() {
      return {
        restrict: 'EA',
        link: function (scope, element, attrs) {
          // update the select when data is loaded
          scope.$watch(attrs.chosen, function () {
            element.trigger('chosen:updated');
          });

          // update the select when the model changes
          scope.$watch(attrs.ngModel, function () {
            element.trigger('chosen:updated');
          });

          element.chosen({disable_search_threshold: 1});
        }
      };
    }]);

    angular.module('material.components.datepicker').config(function($provide) {
        // calendar
        $provide.decorator('mdCalendarDirective', function($delegate, $controller) {
            var directive = $delegate[0],
                link = directive.link;
            // directive.require.push('^mdDatepicker');
            // directive.template = '<div><a href="" class="pre-day btn"><</a>header</div>' + directive.template;
            directive.compile = function(){
                return function(scope, elm, attrs, controllers){
                    // 添加方法 切换

                    var newLink = function(scope, elm, attrs, controllers){
                            link.apply(this, arguments);
                            var cal = controllers[1], ngmodel = controllers[0];

                            // var $mdUtil = cal.$mdUtil;

                            // if (ngmodel.$viewValue) {
                            //     console.log('preious:', $mdUtil.getDateInPreviousMonth(ngmodel.$viewValue));
                            // };
                            console.log('cs : ', cal, ngmodel);
                        }
                    newLink.apply(this, arguments);
                }

            }
            return $delegate;

        });
    });

    angular.module('720kb.datepicker')
        .config(['$provide', function ($provide) {
            $provide.decorator('datepickerDirective', ['$delegate', function($delegate){
                var directive = $delegate[0];

                console.log(directive);
                return $delegate
            }])
        }]);
})();