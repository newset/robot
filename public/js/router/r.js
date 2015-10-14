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
                        templateUrl: 'templates/robot/index.html'
                    })
                    .state('base.robot.list',
                    {
                        url: '/list?page_num&limit&with_search',
                        templateUrl: shot('page/robot'),
                        controller: 'CPageRobot as cPageRobot'
                    })
                    .state('base.robot.query',{
                        url : '/query/:type?',
                        templateUrl : shot('page/robot_query'),
                        controller: 'CPageRobot as cPageRobot'
                    })
                    .state('base.robot.new',{
                        url : '/new',
                        templateUrl : shot('seg/robot_new_form'),
                        controller: 'CPageRobotNew as cPageRobot'
                    })
                    .state('base.robot.detail', {
                        url : '/detail/:id',
                        templateUrl : shot('page/robot/detail'),
                        controller : 'CPageRobotDetail as ctrl',
                        resolve : {
                            sIns : function(SRobot, $stateParams){
                                return SRobot.h.r($stateParams.id, SRobot, ['robotLog.employee', 'robotLeaseLog.agency', 'robotLeaseLog.hospital', 'employee', 'lastAgency', 'lastHospital']).then(function(){
                                    return SRobot;
                                });
                            }
                        }
                    })
                    .state('base.hospital',
                    {
                        url: '/hospital',
                        //controller: 'CPageHospital as cPageHospital',
                        template: '<div ui-view></div>',
                    })
                    .state('base.hospital.new',{//新建医院
                        url : '/new',
                        templateUrl : shot('seg/hospital_form')
                    })
                    .state('base.hospital.edit',{//编辑医院
                        url : '/edit?hid',
                        controller:'CHospitalEdit',
                      templateUrl : shot('seg/hospital_edit')
                    })
                    .state('base.hospital.list', {//医院列表页
                        url: '/list?page_num&limit&with_search',
                        controller: 'CPageHospital as cPageHospital',
                        templateUrl: shot('page/hospital'),
                    })
                    .state('base.hospital.department_doctor',
                    {//医院详情页
                        controller:'CHospitalDetail',
                        url: '/department_doctor?page_num&limit&with_search&hid',
                        templateUrl: shot('page/department_doctor'),
                    })
                    .state('base.department',
                    {
                        url: '/department',
                        //controller: 'CPagedepartment as cPagedepartment',
                        template: '<div ui-view></div>',
                    })
                    .state('base.department.new',{//新建科室
                        url : '/new?hid',
                        controller:'CDepartmentNew',
                        templateUrl : shot('seg/department_form')
                    })
                    .state('base.department.edit',{//编辑科室
                        url : '/edit?did',
                        controller:'CDepartmentEdit',
                        templateUrl : shot('seg/department_edit_form')
                    })
                    .state('base.agency',
                    {
                        url: '/agency?page_num&limit&with_search',
                        // templateUrl: shot('page/agency'),
                        template : '<div ui-view></div>'
                    })
                    .state('base.agency.new', {//新建代理商
                        url : '/new',
                        templateUrl : shot('page/agency_new')
                    })
                    .state('base.agency.list', {//代理商查询页
                        url : '/list',
                        controller:'CPageAgency',
                        templateUrl: shot('page/agency'),
                    })
                    .state('base.agency.detail', {//代理商详情页
                        url : '/detail?aid',
                        controller:'CAgencyDetail',
                        templateUrl: shot('seg/agency_detail'),
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
                        templateUrl: 'templates/mark/index.html'
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
                        controller : 'CPageMark as CPageMark'
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
                        controller : "CPageDoctorNew",
                        templateUrl : shot('seg/doctor_form')
                    })
                    .state('base.doctor.list', {
                        url : '/list',
                        templateUrl : shot('page/doctor'),
                        controller : "CPageDoctor as cPageDoctor",
                        resolve : {
                            sDoctor : function(SDoctor){
                                return SDoctor.init().then(function(res){
                                    return SDoctor;
                                })
                            }
                        }
                    })
                    .state('base.patient', {
                        url : '/patient',
                        template : '<div ui-view></div>'
                    })
            }])
})();
