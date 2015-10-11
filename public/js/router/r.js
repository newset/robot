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
                        sticky: 1,
                        //controller: 'CBase as cBase',
                        views: {
                            'page' : {
                                template : '<div ui-view></div>'
                            }
                        },
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
                        url: '/robot',
                        templateUrl: 'templates/robot/index.html',
                        resolve : {
                            Robot : function(SRobot){
                                return SRobot.refresh().then(function(){
                                    return SRobot;
                                })
                            }
                        }
                    })
                    .state('base.robot.list',
                    {
                        url: '/list?page_num&limit&with_search',
                        templateUrl: shot('page/robot'),
                        controller: 'CPageRobot as cPageRobot', 
                        resolve : {
                            'Resolve' : function(Robot){
                                return Robot
                            }
                        }
                    })
                    .state('base.robot.query',{
                        url : '/query/:type',
                        templateUrl : shot('page/robot_query'),
                        controller: 'CPageRobot as cPageRobot', 
                        resolve : {
                            'Resolve' : function(Robot){
                                return Robot
                            }
                        }
                    })
                    .state('base.robot.new',{
                        url : '/new',
                        templateUrl : shot('seg/robot_new_form'),
                        controller: 'CPageRobotNew as cPageRobot',
                        resolve : {
                            'Resolve' : function(Robot){
                                return Robot
                            }
                        }
                    })
                    .state('base.hospital',
                    {
                        url: '/hospital',
                        //controller: 'CPageHospital as cPageHospital',
                        template: '<div ui-view></div>',
                    })
                    .state('base.hospital.new',{
                        url : '/new',
                        templateUrl : shot('seg/hospital_form')
                    })
                    .state('base.hospital.list', {
                        url: '/list?page_num&limit&with_search',
                        controller: 'CPageHospital as cPageHospital',
                        templateUrl: shot('page/hospital'),
                    })
                    .state('base.department_doctor',
                    {
                        url: '/department_doctor?page_num&limit&with_search&hid',
                        templateUrl: shot('page/department_doctor'),
                    })
                    .state('base.agency',
                    {
                        url: '/agency?page_num&limit&with_search',
                        // templateUrl: shot('page/agency'),
                        template : '<div ui-view></div>'
                    })
                    .state('base.agency.new', {
                        url : '/new',
                        templateUrl : shot('page/agency_new')
                    })
                    .state('base.agency.list', {
                        url : '/list',
                        templateUrl: shot('page/agency'),
                    })
                    .state('base.employee',
                    {
                        url: '/employee?page_num&limit&with_search',
                        // templateUrl: shot('page/employee'),
                        template : '<div ui-view></div>'
                    })
                    .state('base.me',
                    {
                        url: '/me',
                        templateUrl: shot('page/me'),
                    })
                    .state('base.mark',
                    {
                        url: '/mark?page_num&limit&with_search',
                        // templateUrl: shot('page/mark'),
                        templateUrl: 'templates/mark/index.html',
                        // template : '<div ui-view></div>'
                        resolve : {
                            'iBase' : function(SMark){
                                return SMark.refresh().then(function(){
                                    return SMark;
                                })
                            }
                        }
                    })
                    .state('base.mark_checkout',
                    {
                        url: '/mark_checkout?page_num&limit',
                        templateUrl: shot('page/mark_checkout'),
                    }).state('base.mark.new',{
                        url : '/new',
                        templateUrl : shot('seg/mark_new_form')
                    }).state('base.mark.bind',{
                        url : '/bind',
                        templateUrl : shot('seg/mark_bind_form')
                    }).state('base.mark.unbind',{
                        url : '/unbind',
                        templateUrl : shot('seg/mark_unbind_form')
                    })
                    .state('base.mark.usb',{
                        url : '/usb',
                        templateUrl : shot('seg/mark_usb')
                    }).state('base.mark.query',{
                        url : '/query',
                        templateUrl : shot('seg/mark_query'),
                        controller : 'CPageMark as CPageMark',
                        resolve : {
                            SMark : function(iBase){
                                return iBase;
                            }
                        }
                    })
                    .state('base.mark.show', {
                        url : '/show/:id',
                        templateUrl : shot('page/mark/show'),
                        controller : 'CMarkDetail', 
                        resolve : {
                            iMark : function(SMark, $stateParams, $state){
                                return SMark.h.r($stateParams.id, SMark, ['hospital', 'agency', 'doctor', 'robot']).then(function(res){
                                    if (res.data.status == 1) {
                                        return SMark;
                                    }else{
                                        // 无权限访问
                                    };
                                }, function(){

                                });
                            }
                        }
                    })
                    .state('base.doctor', {
                        url : '/doctor',
                        template : '<div ui-view></div>'
                    })
                    .state('base.doctor.new', {
                        url : '/new',
                        template : ''
                    })
                    .state('base.doctor.list', {
                        url : '/list',
                        template : ''
                    })
                    .state('base.patient', {
                        url : '/patient',
                        template : '<div ui-view></div>'
                    })
            }])
})();