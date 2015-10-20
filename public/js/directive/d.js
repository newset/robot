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
    .directive('chosen', ['$timeout', function chosen($timeout) {
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

          // $timeout(function() {
          //   element.trigger('chosen:updated');
          // }, 0);

          element.chosen({disable_search_threshold: 1});
        }
      };
    }]);
})();