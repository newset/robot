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
})();