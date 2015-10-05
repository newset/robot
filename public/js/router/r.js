;
(function ()
{
    'use strict';
    angular.module('base_app.router', [])

        .config([
            '$stateProvider',
            '$urlRouterProvider',
            function ($stateProvider
                , $urlRouterProvider)
            {
                $urlRouterProvider.otherwise('/');

                $stateProvider
                    .state('base',
                    {
                        abstract: true,
                        views:
                        {
                            navbar:
                            {
                                templateUrl: shot('seg/navbar')
                            },
                            page:
                            {
                                template: '<ui-view>'
                            },
                            sidebar_left:
                            {
                                templateUrl: shot('seg/sidebar_left')
                            }
                        },
                        sticky: 1,
                        //controller: 'CBase as cBase',
                        resolve:
                        {
                            Init:
                                [
                                    'SBase',
                                    function(SBase)
                                    {
                                        SBase.init()
                                            .success(function(r)
                                            {
                                                console.log('r: ', r);
                                            })
                                        return SBase;
                                    }
                                ]
                        }
                    })

                    .state('base.home',
                    {
                        url: '/',
                        controller: 'CHome as cHome',
                        templateUrl: shot('page/home'),
                        sticky: 1,
                        ncyBreadcrumb: {
                            label: '首页',
                        }
                    })

                    .state('base.signup',
                    {
                        url: '/signup',
                        controller: 'CSignup as cSignup',
                        templateUrl: shot('page/signup'),
                        ncyBreadcrumb: {
                            label: '注册',
                            parent: 'base.home'
                        }
                    })

                    .state('base.robot',
                    {
                        url: '/robot?page_num&limit&with_search',
                        controller: 'CPageRobot as cPageRobot',
                        templateUrl: shot('page/robot'),
                    })

                    .state('base.hospital',
                    {
                        url: '/hospital?page_num&limit&with_search',
                        controller: 'CPageHospital as cPageHospital',
                        templateUrl: shot('page/hospital'),
                    })

                    .state('base.hospital_menu',
                    {
                        url: '/hospital_menu',
                        //controller: 'CPageHospital as cPageHospital',
                        templateUrl: shot('page/hospital_menu'),
                    })

                    .state('base.department_doctor',
                    {
                        url: '/department_doctor?page_num&limit&with_search&hid',
                        templateUrl: shot('page/department_doctor'),
                    })

                    .state('base.agency',
                    {
                        url: '/agency?page_num&limit&with_search',
                        templateUrl: shot('page/agency'),
                    })

                    .state('base.employee',
                    {
                        url: '/employee?page_num&limit&with_search',
                        templateUrl: shot('page/employee'),
                    })

                    .state('base.me',
                    {
                        url: '/me',
                        templateUrl: shot('page/me'),
                    })

                    .state('base.mark',
                    {
                        url: '/mark?page_num&limit&with_search',
                        templateUrl: shot('page/mark'),
                    })

                    .state('base.mark_checkout',
                    {
                        url: '/mark_checkout?page_num&limit',
                        templateUrl: shot('page/mark_checkout'),
                    })
            }])
})();