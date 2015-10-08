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
})();