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
                                    'SBase', '$q',
                                    function(SBase, $q)
                                    {
                                        var defer = $q.defer();
                                        SBase.init()
                                            .success(function(r)
                                            {
                                                window._robot = r;
                                                console.log('r: ', r);
                                                defer.resolve(SBase);
                                            })
                                        return defer.promise;
                                    }
                                ]
                        }
                    })
                    .state('base.home',
                    {
                        url: '/',
                        controller: 'CHome as cHome',
                        templateUrl: shot('page/home'),
                        resolve : {
                            Role : ['$q', 'Init', 'H', '$timeout', function($q, Init, H, $timeout){
                                return Init;
                            }]
                        },
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
                            deps : function(SRobot) {
                                return SRobot.deps;
                            }
                        }
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
                        controller: 'CPageRobot as cPageRobot',
                        resolve : {
                            'deps' : function(deps, h){
                                return h.prepare_location_data();
                            }
                        }
                    })
                    .state('base.robot.report', {
                        url : '/report/:type',
                        controller: 'ReportCtrl',
                        templateUrl : function($stateParams){
                            return shot_report($stateParams.type);
                        }
                    })
                    .state('base.robot.new',{
                        url : '/new',
                        templateUrl : shot('seg/robot_new_form'),
                        controller: 'CPageRobotNew as cPageRobot',
                        resolve : {
                            deps : function(SEmployee){
                                return SEmployee.refresh().then(function(res){
                                    SEmployee.all = res.data.d.main
                                    return SEmployee;
                                });
                            }
                        }
                    })
                    .state('base.robot.edit',{
                        url : '/edit/:id',
                        templateUrl : shot('seg/robot_new_form'),
                        controller: 'CPageRobotNew as cPageRobot',
                        resolve : {
                            sIns : function(SRobot, $stateParams){
                                return SRobot.h.r($stateParams.id, SRobot, []).then(function(res){
                                    SRobot.current_row = res.data.d.main[0];
                                    return SRobot;
                                });
                            }
                        }
                    })
                    .state('base.robot.log',{
                        url : '/log/:id',
                        templateUrl : shot('page/robot/log'),
                        controller: 'CPageRobotLog as cPageRobot',
                        resolve : {
                            sIns : function(SRobot, $stateParams){
                                return SRobot.h.r($stateParams.id, SRobot, []).then(function(res){
                                    SRobot.current_row = res.data.d.main[0];
                                    return SRobot;
                                });
                            }
                        }
                    })
                    .state('base.robot.lease',{
                        url : '/lease/:id',
                        templateUrl : shot('page/robot/lease'),
                        controller: 'CPageRobotDetail as cPageRobot',
                        resolve : {
                            sIns : function(SRobot, $stateParams){
                                return SRobot.h.r($stateParams.id, SRobot, []).then(function(res){
                                    SRobot.current_row = res.data.d.main[0];
                                    return SRobot;
                                });
                            }
                        }
                    })
                    .state('base.robot.detail', {
                        url : '/detail/:id',
                        templateUrl : shot('page/robot/detail'),
                        controller : 'CPageRobotDetail as ctrl',
                        resolve : {
                            sIns : function(SRobot, $stateParams){
                                return SRobot.h.r($stateParams.id, SRobot, ['robotLog.employee', 'robotLeaseLog.agency', 'robotLeaseLog.hospital', 'employee', 'lastAgency', 'lastHospital']).then(function(res){
                                    SRobot.current_row = res.data.d.main[0];
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
                        // resolve todo
                        url: '/department_doctor/:hid?page_num=&limit=&with_search=',
                        templateUrl: shot('page/department_doctor'),
                    })
                    .state('base.department',
                    {
                        url: '/department',
                        //controller: 'CPagedepartment as cPagedepartment',
                        template: '<div ui-view></div>',
                    })
                    .state('base.department.new',{//新建科室
                        url : '/new?hid=&next=',
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
                        url : '/detail?aid=',
                        controller:'CAgencyDetail',
                        templateUrl: shot('seg/agency_detail'),
                        resolve : {
                            'deps' : function(SAgency, H, $stateParams, $q, h){
                                return H.p(cook('agency/r'), {
                                    where:{'id': parseInt($stateParams.aid)},
                                    relation: ['robotLeaseLog', 'mark', 'hospital']}
                                ).then(function (r){
                                    SAgency.current_row = r.data.d.main[0];
                                    return SAgency;
                                });
                            }
                        }
                    })
                    .state('base.agency.edit', {
                        url : '/edit/:id',
                        controller: 'CAgencyDetail',
                        templateUrl : shot('page/agency/edit'),
                        resolve : {
                            'deps' : function(H, $stateParams, SAgency){
                                return H.p(cook('agency/r'), {
                                    id : $stateParams.id
                                }).then(function(res){
                                    SAgency.current_row = res.data.d.main[0];
                                    return SAgency;
                                })
                            }
                        }                        
                    })
                    .state('base.agency.report', {
                        url : '/report/:type',
                        controller: 'ReportCtrl',
                        templateUrl : function($stateParams){
                            return shot_report($stateParams.type);
                        }
                    })
                    .state('base.employee',
                    {
                        url: '/employee',
                        // templateUrl: shot('page/employee')
                        template : '<div ui-view></div>'
                    })
                    .state('base.employee.list',
                    {
                        url: '/list?page_num=&limit=&with_search=',
                        templateUrl: shot('page/employee/employee')
                        // template : '<div ui-view></div>'
                    })
                    .state('base.employee.new',
                    {
                        url: '/new/:id?',
                        templateUrl: shot('page/employee/new'),
                        controller : 'CPageEmployeeNew',
                        resolve : {
                            'deps': function(SEmployee, $stateParams, h){
                                if ($stateParams.id) {
                                    return SEmployee.one($stateParams.id);
                                }else{
                                    return SEmployee;
                                };
                            }
                        }
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
                        resolve : {
                            deps : function(SMark) {
                                return SMark.deps;
                            }
                        }
                    })
                    .state('base.mark_checkout',
                    {
                        url: '/mark_checkout?page_num&limit',
                        templateUrl: shot('page/mark_checkout'),
                    }).state('base.mark.new',{
                        url : '/new',
                        controller : 'CPageMarkNew',
                        templateUrl : shot('seg/mark_new_form')
                    }).state('base.mark.bind',{
                        url : '/bind',
                        controller : 'CPageMarkNew',
                        templateUrl : shot('page/mark/bind_form')
                    }).state('base.mark.unbind',{
                        url : '/unbind',
                        controller : 'CPageMarkNew',
                        templateUrl : shot('page/mark/unbind_form')
                    })
                    .state('base.mark.usb',{
                        url : '/usb?id=',
                        controller : 'CMarkUsb',
                        resolve : {
                            'Log' : function($stateParams, H){
                                if ($stateParams.id) {
                                    return H.p(cook('usblog/r'), {id : $stateParams.id});
                                }else{
                                    return '';
                                };
                            }
                        },
                        templateUrl : shot('page/mark/usb')
                    }).state('base.mark.query',{
                        url : '/query',
                        templateUrl : shot('page/mark/query'),
                        controller : 'CPageMark as CPageMark'
                    })
                    .state('base.mark.checkout',{ //mark 结账
                        url : '/checkout',
                        templateUrl : shot('page/agency/mark_checkout'),
                        controller : 'CPageMarkNew'
                    })
                    .state('base.mark.ck_mark_history',{ //mark 结账
                        url : '/ck_mark_history',
                        templateUrl : shot('page/agency/mark_checkout_history'),
                        controller : 'CPageMark'
                    })
                    .state('base.mark.ck_mark_history_detail',{ //mark 结账
                        url : '/ck_mark_history_detail/:time',
                        templateUrl : shot('page/agency/checkout_his_detail'),
                        resolve: {
                            detail : function(SMark, $stateParams, $filter){
                                return SMark.bat_mark('checkout2', {
                                    a : $filter('laDate')($stateParams.time)
                                }).then(function(res){
                                    if (res.data.status == 1 && res.data.d) {
                                        res.data.d  = JSON.parse(res.data.d);
                                    };
                                    return res.data;
                                })
                            }
                        },
                        controller : ['$scope', 'SMark', '$stateParams', 'detail', function($scope, SMark, $stateParams, detail){
                            console.log($stateParams.time, detail);
                            $scope.detail = detail;
                            $scope.time = $stateParams.time;
                        }]
                    })
                    .state('base.mark.show', {
                        url : '/show/:id',
                        templateUrl : shot('page/mark/show'),
                        controller : 'CMarkDetail',
                        resolve : {
                            iMark : function(SMark, $stateParams, $state){
                                return SMark.one($stateParams.id).then(function(res){
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
                    .state('base.mark.report', {
                        url : '/report/:type',
                        controller: 'ReportCtrl',
                        templateUrl : function($stateParams){
                            return shot_report($stateParams.type);
                        }
                    })
                    .state('base.doctor', {
                        url : '/doctor',
                        template : '<div ui-view></div>'
                    })
                    .state('base.doctor.new', {
                        url : '/new/:hospital?',
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
