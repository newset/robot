;
(function ()
{
    'use strict';
    angular.module('base_app.controller', [])

        .controller('CBase', [
            '$scope',
            'h',
            function (
                $scope
                , h)
            {
               $scope.h = h;
            }])

        .controller('CHome', ['$rootScope', '$state',
            function ($rootScope, $state)
            {
                console.log('CHome', $rootScope._user_session_data);
                if ($rootScope._user_session_data && $rootScope._user_session_data.his_chara && $rootScope._user_session_data.his_chara[0] == 'agency') {
                    $state.go('base.mark.home');
                };
            }])
        .controller('CDepartmentHome', ['$scope', 'H', function($scope, H){
            H.g(cook('department/rl')).then(function(res){
                console.log('dep:', res.data);
                $scope.marks = res.data;
            });
        }])
        .controller('CSignup', [
            '$scope',
            'SBase',
            'Init',

            function ($scope
                , SBase
                , Init)
            {
                $scope.SBase = SBase;
                $scope.a = 'wowow';
            }])

        .controller('CFormSignup', [
            'SIns',
            function (SIns)
            {
                var me = this;
                me.vals = {}; // form values.
                me.submit = function ()
                {
                    return SIns.c({url: cook('company/c'), d: me.vals})
                        .success(function (d)
                        {
                            console.log('d.d: ', d.d);

                        })
                        .error(function (e)
                        {

                        })
                }
            }])

        .controller('CFormAuth', [
            '$http',
            '$scope',
            'H',
            'h',
            'ngDialog',
            'SBase',
            function ($http
                , $scope
                , H
                , h
                , ngDialog
                , SBase)
            {
                var me = this;
                $scope.SBase = SBase;
                me.vals = {}; // form values.
                me.signup = 0;
                me.login_fail = 0;

                me.alert = function ()
                {
                    alert('lala');
                };

                me.forget = function(){
                    var d = ngDialog.open({
                        template:  '\
                            <div class="panel panel-default"><div class="panel-heading"><h5>请输入注册邮箱</h5></div>\
                            <div class="panel-body"><form name="forget_email" class="form-horizontal" style="margin: 30px 0px 45px;"><div class="form-group"> \
                                <label class="col-md-2 control-label">邮箱:  </label><div class="col-md-8"><input name="email" ng-model-options="{ updateOn:'+"'blur"+"'"+' }" require type="email" ng-model="email" class="form-control"/></div>\
                                <p ng-show="forget_email.email.$error.email" class="col-md-8 col-md-offset-2 mt10 text-danger">邮箱格式错误</p>\
                                <p ng-show="emailsent" class="col-md-8 col-md-offset-2 mt10 text-success">邮件发送成功</p>\
                            </div></form>\
                            <div class="ngdialog-buttons mt20">\
                                <button type="button" class="ngdialog-button ngdialog-button-secondary" ng-click="closeThisDialog(0)">取消</button>\
                                <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirm(1)">确定</button>\
                            </div></div></div>',
                        plain : true,
                        resolve : {
                            userType : function(){
                                return me.user_type;
                            }
                        },
                        controller : function($scope, userType, H){
                            $scope.confirm = function(){
                                if (!$scope.email) {
                                    return;
                                };

                                H.p(cook('auth/forget/'+userType), {'type': userType, 'email' : $scope.email}).then(function(res){
                                    if (res.data.status == 1) {
                                        $scope.emailsent = true;
                                    };
                                });
                            }
                        }
                    });

                }

                me.on_tab_change = function (user_type, auth_type)
                {
                    me.user_type = user_type;
                    me.auth_type = auth_type;
                    me.vals.username = "";
                    me.vals.password = "";
                }

                me.set_ins_conf = function (type, login_or_signup)
                {
                    me.vals.ins_name = type;
                    me.login_or_signup = login_or_signup;
                }

                h.prepare_location_data();

                me.submit = function ()
                {
                    console.log('me.vals: ', me.vals);
                    me.vals.signup = me.signup;

                    var d = {
                        auth_type: me.auth_type,
                        user_type: me.user_type,
                        form_vals: me.vals,
                    }

                    return $http.post(cook('auth/auth_leader'), d)
                        .success(function (r)
                        {
                            console.log('r: ', r);

                            if (parseInt(r.status) === 1)
                            {
                                console.log('r: ', r);
                                return reload_page();
                            }

                            if (me.auth_type == 'login')
                                me.login_fail = 1;
                        })
                }
            }])

        .controller('CFormHospital', [
            '$scope',
            'H',
            'h',
            'SBase',
            'SIns',
            function ($scope
                , H
                , h
                , SBase
                , SIns)
            {
                var me = this;
                $scope.SIns = SIns;
                $scope.SBase = SBase;

                h.prepare_location_data();
                $scope.$watch('SBase', function (a, b)
                {
                    $scope.SBase = SBase;
                })
            }])

        .controller('CSidebar',
        [
            function ()
            {

            }
        ])

        .controller('CPageHospital',
        [
            '$scope',
            'SBase',
            'SHospital',
            'h',
            '$state',
            '$stateParams',
            function ($scope,
                      SBase,
                      SHospital,
                      h,
                      $state,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SHospital;
                // $scope.SIns.init();
                if ($state.current.name == 'base.hospital.new') {
                    SHospital.current_row = {};
                };
                $scope.cond = $scope.SIns.cond;
                $scope.SIns.show_search_panel = $stateParams.with_search;
                h.prepare_location_data();

                if($stateParams.with_search)
                {
                    SHospital.with_search = 1;
                };
                $scope.equalsId=function(a,b){
                    return a==b;
                }

                $scope.save = function(hospital){
                    $scope.SIns.cu(hospital).then(function(res){
                        if (res.data.status == 1) {
                            $scope.SIns.refresh();
                            $state.go('base.hospital.department_doctor', {hid : res.data.d.id});
                        }else{
                            $scope.errors = res.data.d.additional_info;
                        }
                    })
                    
                }
            }
        ])
        .controller('CHospitalEdit',
        [//医院编辑
            '$scope',
            'SBase',
            'SHospital',
            '$state',
            'h','H',
            '$stateParams',
            function ($scope,
                      SBase,
                      SHospital,
                      $state,
                      h,H,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SHospital;
                $scope.hospital_id=parseInt($stateParams.hid);
                $scope.hospital ={};
                h.prepare_location_data();
                //获取医院信息
                H.p(cook('hospital/r'), {'limit': 0, 'order_by': 'id','id':
                        $scope.hospital_id}).then(function (r){
                        $scope.hospital = r.data.d.main[0];
                        $scope.SIns.current_row=$scope.hospital;
                });

                $scope.save = function(hospital){
                    $scope.SIns.cu(hospital).then(function(res){
                        if (res.data.status == 1) {
                            $scope.SIns.refresh();
                            $state.go('base.hospital.department_doctor', {hid : res.data.d.id});
                        }else{
                            $scope.errors = res.data.d.additional_info;
                        }
                    })
                    
                }
            }
        ])
        .controller('CPageDoctor',
        [
            '$scope',
            'SBase',
            'sDoctor',
            'h',
            '$stateParams',
            function ($scope,
                      SBase,
                      SDoctor,
                      h,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SDoctor;
                console.log('sDoctor', SDoctor);
                // 根据医院进行筛选
                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                SDoctor.init();
                $scope.cond = SDoctor.cond;
                // h.prepare_location_data();
            }
        ])
        .controller('CPageDoctorDetail', ['$scope', 'sIns', 'SDoctor', 'SHospital', 'H', '$state', function ($scope, sIns, SDoctor, SHospital, H, $state) {
            $scope.SIns = sIns;
            
            $scope.SDoctor = SDoctor;            
            $scope.SHospital = SHospital;

            $scope.data = {
                doctor_id : $scope.SIns.current_row.id
            } 
            
            //获取已归档Mark
            H.p(cook('mark/getMarkByDoctorId'), {
                'doctor_id': $scope.SIns.current_row.id,
                'type': 0
            }).then(function(r) {
                $scope.archive_yes = r.data.d.count;
            });
            //获取未归档Mark
            H.p(cook('mark/getMarkByDoctorId'), {
                'doctor_id': $scope.SIns.current_row.id,
                'type': 1
            }).then(function(r) {
                $scope.archive_no = r.data.d.count;
            });
            //获取累计使用Mark
            H.p(cook('mark/getMarkByDoctorId'), {
                'doctor_id': $scope.SIns.current_row.id,
                'type': 2
            }).then(function(r) {
                $scope.archive = r.data.d.count;
            });
        }])
        .controller('CPageDoctorNew',
        [
            '$scope',
            '$state',
            'SBase',
            'SDoctor',
            'SHospital',
            'SDepartment',
            'h',
            '$stateParams',
            function ($scope,
                      $state,
                      SBase,
                      SDoctor,
                      SHospital,
                      SDepartment,
                      h,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SDoctor;
                SDoctor.init();
                $scope.SIns.current_row = {}

                $scope.get_department = function(){
                    if ($scope.SIns.current_row.hospital_id) {
                        SDoctor.h.get_all_department($scope.SIns.current_row.hospital_id).then(function(res){
                            console.log('deps: ', res.data);
                            $scope.SIns.departments = res.data.d.main;
                        });
                    }else{
                        $scope.SIns.departments = [];
                    };
                }

                $scope.currentHospital = Number($stateParams.hospital);
                if ($stateParams.hospital) {
                    $scope.SIns.current_row.hospital_id = Number($stateParams.hospital);
                    $scope.createForHopistal = true;
                    $scope.get_department();
                };
                
                $scope.getLastId = function(){
                    var time = new Date().valueOf().toString(),
                        a = time.substr(-9),
                        b = a.substr(-4) + a.substr(0, 5);
                    SDoctor.lastId(b).then(function(res){
                        if (res.data.status == 1) {
                            $scope.SIns.current_row.cust_id = Number(res.data.d);
                        }else{
                            $scope.getLastId();
                        };
                    })
                }
                //$scope.getLastId();

                $scope.save = function(data){
                    $scope.SIns.cu(data).then(function(res){
                        $state.go('base.hospital.department_doctor', {hid : data.hospital_id});
                        SDoctor.current_row = {};
                    }, function(){
                        // 外键错误 todo
                        
                    });
                }

            }
        ])
        .controller('CPageDoctorEdit',
        [
            '$scope',
            '$state',
            'SBase',
            'SDoctor',
            'SHospital',
            'SDepartment',
            'h',
            'H',
            '$stateParams',
            function ($scope,
                      $state,
                      SBase,
                      SDoctor,
                      SHospital,
                      SDepartment,
                      h,
                      H,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SDoctor;
                SDoctor.init();

                $scope.createForHopistal = $stateParams.hid;

                $scope.getLastId = SDoctor.getLastId;

                $scope.save = function(data){
                    $scope.SIns.cu(data).then(function(res){
                    	$state.go('base.doctor.detail', {id: $scope.SIns.current_row.id});
                        /*if ($stateParams.hid) {
                            $state.go('base.hospital.department_doctor', {hid: $stateParams.hid});
                        }else{
                            $state.go('base.doctor.list');
                        };*/
                        SDoctor.current_row = {};
                    }, function(){
                        // 外键错误 todo
                        
                    });
                }

                $scope.disable = function(data){
                    if (!$scope.SIns.current_row.id) {
                        return;
                    };
                    H.p(cook('doctor/disable'), {id: $scope.SIns.current_row.id}).then(function(res){
                    	$state.go('base.doctor.detail', {id: $scope.SIns.current_row.id});
                        /*if ($stateParams.hid) {
                            $state.go('base.hospital.department_doctor', {hid: $stateParams.hid});
                        }else{
                            $state.go('base.doctor.list');
                        };*/
                    });
                }
                
                $scope.recover = function(data){
                    if (!$scope.SIns.current_row.id) {
                        return;
                    };
                    H.p(cook('doctor/recover'), {id: $scope.SIns.current_row.id}).then(function(res){
                    	$state.go('base.doctor.detail', {id: $scope.SIns.current_row.id});
                    });
                }

        }])
          //科室controller
        .controller('CPageDepartment',
        [
            '$scope',
            'SBase',
            'SDepartment',
            'h',
            '$stateParams',
            function ($scope,
                      SBase,
                      SDepartment,
                      h,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SDepartment;
                $scope.SIns.cond.where.hospital_id = parseInt($stateParams.hid);
                SDepartment.init();
                $scope.cond = SDepartment.cond;
                SDepartment.show_search_panel = $stateParams.with_search;
                h.prepare_location_data();

                $scope.$watch('cond', function()
                {
                    $scope.SIns.refresh();
                }, true)
            }
        ])
    //医院详情controller
  .controller('CHospitalDetail',
  [
      '$scope',
      'SBase',
      'SDepartment',
      'h',
      'SDoctor',
      'H',
      '$stateParams',
      function ($scope,
                SBase,
                SDepartment,
                h,
                SDoctor,
                H,
                $stateParams ){
            $scope.hospital_id=parseInt($stateParams.hid);
            $scope.hospital={};
            $scope.departments={};
            $scope.doctors={};
            $scope.robots={};

            $scope.SDoctor = SDoctor;

            SDepartment.cond.where.hospital_id = $scope.hospital_id;
            //获取医院信息
            H.p(cook('hospital/r'), {
                'limit': 0,
                'order_by': 'id desc',
                'id': $scope.hospital_id,
                'log' : $stateParams.log
            }).then(function(r) {
                $scope.hospital = r.data.d.main[0];
            });
            // 获取科室
            SDepartment.refresh().then(function(r) {
                $scope.departments = r.data.d.main;
            });

            //获取医生
            H.p(cook('doctor/r'), {
                'limit': 0,
                'order_by': 'id',
                where: {
                    'hospital_id': $scope.hospital_id
                }
            }).then(function(r) {
                $scope.doctors = r.data.d.main;
                console.log(($scope.doctors));
            });
            
            //获取设备
            H.p(cook('robot/getRobotByHospitalId'), {
                'hospital_id': $scope.hospital_id,
                'recent': 1
            }).then(function(r) {
                $scope.robots = r.data.d.main;
                console.log(($scope.robots));
            });

            $scope.delete_department = function(department) {
                console.log(department);
                var res = SDepartment.d(department.id);
                if (res && res.then) {
                    res.then(function(r){
                        $scope.departments = r.data.d.main;
                    })
                };
            };

        }])

        .controller('CDepartmentEdit',[//科室编辑
              '$scope',
                'H',
                '$state',
                'SDepartment',
              '$stateParams',
              function($scope,
              H,
              $state,
              SDepartment,
              $stateParams){
              $scope.department_id=parseInt($stateParams.did);
              $scope.department={};
              // $scope.hospital_id=1;
              $scope.hospital={};
              $scope.department_old={};
                //获取科室
                H.p(cook('department/r'), {'limit': 0, 'order_by': 'id',
                        where:{'id': $scope.department_id}
                        }).then(function (r){
                        $scope.department_old = r.data.d.main[0];
                        $scope.department=angular.copy($scope.department_old);
                        $scope.hospital_id=$scope.department_old.hospital_id;
                        //获取医院信息
                        H.p(cook('hospital/r'), {'limit': 0, 'order_by': 'id','id':
                        $scope.hospital_id}).then(function (r){
                        $scope.hospital = r.data.d.main[0];
                        });
                });

                $scope.cancel=function(){//重置
                        $scope.department=angular.copy($scope.department_old);
                  };
                $scope.submit=function(){//编辑
                          console.log($scope.department);
                          SDepartment.cu($scope.department);
                          $state.go('base.hospital.department_doctor',{hid:$scope.hospital_id});//返回医院详情页
                };
                $scope.delete=function(){//删除科室
                        SDepartment.d($scope.department.id);
                        $state.go('base.hospital.department_doctor',{hid:$scope.hospital_id});//返回医院详情页
                };
        }])
          .controller('CDepartmentNew',[//新建科室
                '$scope',
                'H',
                '$state',
                'SDepartment',
                '$stateParams',
                function($scope,
                H,
                $state,
                SDepartment,
                $stateParams){
                $scope.hospital_id=parseInt($stateParams.hid);
                $scope.hospital={};

                function zeroFill(number, width) {
                    width -= number.toString().length;
                    if (width > 0) {
                        return new Array(width + (/\./.test(number) ? 2 : 1)).join('0') + number;
                    }
                    return number + ""; // always return a string
                }

                $scope.department={
                    username : $scope.hospital_id + '-' + zeroFill($stateParams.next, 3)
                };
                $scope.department.hospital_id=$scope.hospital_id;
                  //获取科室
                H.p(cook('hospital/r'), {'limit': 0, 'order_by': 'id',
                      'id':$scope.hospital_id})
                      .then(function (r){
                      $scope.hospital = r.data.d.main[0];
                      console.log('aaa'+$scope.hospital_id+$scope.hospital);
                });

                $scope.cancel=function(){//重置
                    $scope.department.name="";
                    $scope.department.username="";
                    $scope.department.password="";
                    $scope.department.memo="";
                };

                $scope.submit=function(){//编辑
                    console.log($scope.department);
                    SDepartment.cu($scope.department);
                    $state.go('base.hospital.department_doctor', {hid:$scope.hospital_id}, {reload: true});//返回医院详情页
                };
          }])
//代理商查询/列表
        .controller('CPageAgency',
        [
            '$scope',
            'SBase',
            'SAgency',
            'h',
            '$stateParams',
            function ($scope,
                      SBase,
                      SAgency,
                      h,
                      $stateParams
            )
            {
                var me = this;
                $scope.h = h;
                $scope.SBase = SBase;
                $scope.SIns = SAgency;
                $scope.current_row = SAgency.current_row;
                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                SAgency.init();
                if(SAgency.current_page_data){
                    SAgency.refresh();
                }

                $scope.cond = SAgency.cond;
                SAgency.show_search_panel = $stateParams.with_search;
                h.prepare_location_data();

                if($stateParams.with_search)
                {
                    SAgency.with_search = 1;
                }
                $scope.equalsId=function(a,b){
                      return a==b;
                   }
                //$scope.$watch('current_row', function()
                //{
                //    h.prepare_current_row.call(me);
                //}, true)
            }
        ])
        .controller('AgencyHome', ['deps', '$scope', 'SAgency', 'SRobot', 'SMark', 'H', 'ngDialog', '$state', function(deps, $scope, SAgency, SRobot, SMark, H, ngDialog, $state){
            $scope.data = deps[0];
            $scope.marks = deps[1];
            
            $scope.SIns = SRobot;
            $scope.SMark = SMark;
            $scope.SAgency =SAgency;
            
            H.p(cook('agency/me')).then(function(res){
                $scope.agency_status = '正常';
                $scope.agency_status_danger = 0;
                var me = $scope.me = res.data.d;

                if (!me.started_at) {
                    $scope.agency_status = '无代理权';
                };

                var dur = moment.duration(moment(me.ended_at).diff(moment()));
                console.log('dur: ', dur, me.ended_at);
                if (dur < 0) {
                    $scope.agency_status = '已过期';
                    $scope.agency_status_danger = 1;
                }else if(me.ended_at==null){
                	$scope.agency_status = '无代理权';
                    $scope.agency_status_danger = 0;
                }else if(dur <= 3600*24*30*1000){
                    $scope.agency_status = '即将过期';
                    $scope.agency_status_danger = 1;
                };

            });

            $scope.info = function(item){
                if (item.lease_ended_at) {
                      var end = moment(item.lease_ended_at),
                        now = moment(),
                        dur = moment.duration(now.diff(end)).days();
                    if (dur < 0 && Math.abs(dur) < 30) {
                        return '租期快要结束';
                    };
                };

                return '';
            }

            $scope.set_doctor = function(item){
                var dialog = ngDialog.open({
                    templateUrl : 'assign_doc.html',
                    resolve : {
                        doctors: function(H){
                            return H.p(cook('doctor/r'), {where: {'hospital_id' : item.hospital_id}}).then(function(res){
                                return res.data.status == 1 ? res.data.d.main : [];
                            });
                        },
                        mark : function(){
                            return item.id;
                        }
                    },
                    controller : function($scope, H, doctors, mark){
                        $scope.doctors = doctors;
                        $scope.save = function(){
                            H.p(cook('mark/cu'), {'doctor_id': $scope.doctor_id, id: mark}).then(function(res){
                                if (res.data.status == 1) {
                                    $scope.closeThisDialog(true);
                                };
                            });
                        }

                        $scope.close = function(){
                            $scope.closeThisDialog();
                        }
                    }
                });

                dialog.closePromise.then(function(val){
                    $state.reload();
                });
            }
        }])
        .controller('CAgencyDetail',[
            '$scope',
            'SBase',
            'SAgency',
            'SRobot',
            'h',
            'H',
            '$state',
            '$stateParams',
            function ($scope,
              SBase,
              SAgency,
              SRobot,
              h,
              H,
              $state,
              $stateParams
            ){
            var me = this;
            $scope.h = h;
            $scope.SBase = SBase;
            $scope.SIns = SAgency;
            $scope.SRobot = SRobot;
            $scope.agency={};
            h.prepare_location_data();
            // $scope.current_row = SAgency.current_row;
            // $scope.SIns.cond.where.hospital_id = $stateParams.hid;
            // SAgency.init();
            // $scope.cond = SAgency.cond;
            // SAgency.show_search_panel = $stateParams.with_search;
            $scope.agency_id=parseInt($stateParams.aid);
           
            $scope.toggle = function(){
                var text = $scope.SIns.current_row.status == 0 ? '启用' : '禁用', 
                    conf = confirm('确认'+text+'当前代理商?');
                if (!conf) {
                    return;
                };
                
                H.p(cook('agency/toggle'), {s : $scope.SIns.current_row.status, id : $scope.agency_id}).then(function(res){
                    if (res.data.status == 1) {
                        $scope.SIns.current_row.status = res.data.d;
                    };
                });
            }

            $scope.save = function(){
                var data = {
                    id : SAgency.current_row.id,
                    started_at : SAgency.current_row.started_at,
                    ended_at : SAgency.current_row.ended_at,
                    memo : SAgency.current_row.memo,
                }

                if ($scope.password) {
                    data.password = $scope.password;
                };
                $scope.SIns.cu(data, SAgency).then(function(res){
                    console.log(res);
                    if (res.data.status == 1) {
                        $state.go('base.agency.detail', {aid : SAgency.current_row.id});
                    }else{
                        toastr.error('服务器错误');
                    };
                });
            }
        }])
        .controller('CPageRobot',
        [
            '$scope',
            '$state',
            '$stateParams',
            'SRobot',
            'SHospital',
            'SAgency',
            'SEmployee',
            'SBase',
            'h',
            function ($scope,
                $state
                , $stateParams
                , SRobot
                , SHospital
                , SAgency
                , SEmployee
                , SBase
                , h
            )
            {
                SRobot.current_page_data = [];
                $scope.h = h;
                $scope.SBase = SBase;
                $scope.SEmployee = SEmployee;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SRobot;
                $scope.current_row = SRobot.current_row;
                // 医院id
                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                SRobot.init();
                $scope.cond = SRobot.cond;

                $scope.with_search = $stateParams.with_search;

                $scope.simpleQuery = true;
                $scope.type = $stateParams.type;
                switch($stateParams.type){
                    case 'sale' : 
                        SRobot.cond.where.lease_type_id = [-1];
                        SRobot.cond.where.action_type_id = [0];
                        $scope.SIns.refresh();
                        break;
                    default : 
                        SRobot.cond.where.lease_type_id = []
                        SRobot.cond.where.action_type_id = []
                        $scope.simpleQuery = false;
                        break;
                }

                if($stateParams.with_search)
                {
                    SRobot.with_search = 1;
                }
                //  $scope.$watch('cond', function()
                // {
                //     SRobot.refresh();
                // }, true)
            }
        ])
        .controller('CPageRobotNew', [
            '$scope',
            '$stateParams',
            'SRobot',
            'SHospital',
            'SAgency',
            'SEmployee',
            'SBase',
            'h',
            '$filter',
            '$state',
            function ($scope
                , $stateParams
                , SRobot
                , SHospital
                , SAgency
                , SEmployee
                , SBase
                , h
                , $filter
                , $state
            ){
                $scope.SEmployee = SEmployee;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SRobot;
                $scope.memo = '';
                $scope.employees = SEmployee.all;

                if (!$stateParams.id) {
                    SRobot.current_row = { status : 0};
                }else{
                    // 
                    $scope.currentStatus = SRobot.current_row.status;
                };

                $scope.$watch('SIns.current_row.status', function(n, o) {
                    if (n != $scope.currentStatus && $scope.SIns.current_row.lease_type_id != -1 && n == 2) {
                        $scope.SIns.current_row.status = o;
                        alert('当前设备没有在库, 不能作废');
                        return;
                    };

                    // 强制 memo
                    if ($scope.currentStatus == 2 && n == 0) {
                        $scope.memoRequired = true;
                    }else{
                        $scope.memoRequired = false;
                    };
                })

                $scope.save = function(){
                    // 判断
                    if ($scope.SIns.current_row.status == 2) {
                        var conf = confirm('确认作废当前设备?');
                        if (!conf) {
                            return;
                        };
                    };

                    if ($scope.memoRequired && !$scope.memo) {
                        alert('Memo必选填写');
                        return;
                    };
                    
                    var data = {
                        id : $scope.SIns.current_row.id,
                        cust_id : $scope.SIns.current_row.cust_id,
                        employee_id : $scope.SIns.current_row.employee_id,
                        production_date : $scope.SIns.current_row.production_date,
                        status : Number($scope.SIns.current_row.status)
                    }

                    if ($scope.memoRequired) {
                        var memo = ($scope.SIns.current_row.memo ? $scope.SIns.current_row.memo + '\n\n' : '') + $scope.memo;
                        memo += '['+$filter('date')(new Date(), 'yyyy-MM-dd')+' 设备被设置为 "正常"]';
                        data.memo = memo;
                    }

                    $scope.SIns.cu_(data).then(function(res){
                        // 跳转到详情 todo
                        if (res.data.status ==1 ) {
                            $state.go('base.robot.detail', {'id' : res.data.d.id});
                            $scope.SIns.current_row = {};
                            console.log('创建成功: ', res.data.d);
                        }else{
                            $scope.errors = res.data.d.additional_info;
                        };
                    });
                }

        }])
        .controller('CPageRobotLease', ['$scope', 'sIns', 'SAgency', 'SHospital', 'H', '$state', function ($scope, sIns, SAgency, SHospital, H, $state) {
            $scope.SIns = sIns;
            
            $scope.SAgency = SAgency;            
            $scope.SHospital = SHospital;

            $scope.data = {
                robot_id : $scope.SIns.current_row.id
            } 

            // 
            $scope.lease = function(){
                if (!$scope.data.memo && SIns.current_row.lease_type_id > 1 && !moment(SIns.current_row.log_lease_lease_ended_at).isAfter(moment())) {
                    alert('租赁/合作时间未到，如需强行修改租售状态，必须填写备注');
                    return;
                };

                var data = {};
                angular.extend(data, $scope.data);
                data['write_data'] = 1;

                if (SIns.current_row.lease_type_id > 1) {
                    data['memo'] += '\n 【该操作为提前操作】';
                };

                H.p(cook('robotLeaseLog/c'), data).then(function(res){
                    if(res.data.status == 1){
                        $state.go('base.robot.detail', {id : $scope.SIns.current_row.id});
                    }else{

                    }
                })
            }           
        }])
        .controller('CPageRobotDetail', ['$scope', 'sIns', 'SAgency', 'SHospital', 'H', '$state', function ($scope, sIns, SAgency, SHospital, H, $state) {
            $scope.SIns = sIns;
            
            $scope.SAgency = SAgency;            
            $scope.SHospital = SHospital;

            $scope.data = {
                robot_id : $scope.SIns.current_row.id
            } 
            for (var i=0; i<$scope.SIns.current_row.robot_lease_log.length; i++) {
            	var robot_lease_log = $scope.SIns.current_row.robot_lease_log[i];
                if(robot_lease_log.recent == 1) {
                	$scope.endLeaseDate = robot_lease_log.lease_ended_at;
                }
            }
            var date = new Date($scope.endLeaseDate);
            var currentDate = new Date();
            var milisecondsDiff = date-currentDate;
            var daysDiff = Math.round(milisecondsDiff/(24*60*60*1000));
            $scope.endLeaseTip = "";
            if(daysDiff<30) {
            	$scope.endLeaseTip = "还有"+daysDiff+"天过期";
            }
            //获取上次usb数据采集时间
            H.p(cook('robot/getLeaseUploadByRobotId'), {
                'robot_id': $scope.SIns.current_row.id,
            }).then(function(r) {
                $scope.usbUploadDate = r.data.d.main[0].upload_at;
                milisecondsDiff = currentDate-new Date($scope.usbUploadDate);
                daysDiff = Math.round(milisecondsDiff/(24*60*60*1000));
                $scope.usbUploadTip = "";
                if($scope.usbUploadDate!=null) {
                	if(daysDiff>90) {
                    	$scope.usbUploadTip = "距离上次USB数据采集已经过去"+daysDiff+"天";
                    }
                }
                else {
                	$scope.usbUploadTip = "从未采集过USB数据";
                }
            });
            $scope.lease = function(){
                var data = {};
                angular.extend(data, $scope.data);
                data['write_data'] = 1;
                H.p(cook('robotLeaseLog/c'), data).then(function(res){
                    if(res.data.status == 1){
                        $state.go('base.robot.detail', {id : $scope.SIns.current_row.id});
                    }else{

                    }
                })
            }           
        }])
        
        .controller('CPageRobotLog', ['$scope', 'SRobot', '$state', 'H', function ($scope, SRobot, $state, H) {
            $scope.SIns = SRobot;
            $scope.data = {
                robot_id : SRobot.current_row.id, 
                action_type : 1
            }

            $scope.save = function () {
                H.p(cook('robotLog/c'), $scope.data).then(function(res){
                    if (res.data.status == 1) {
                        $state.go('base.robot.detail', {id : SRobot.current_row.id});
                    }else{

                    };
                });
            }
        }])
        .controller('CPageMark',
        [
            '$scope',
            '$stateParams',
            'SMark',
            'SHospital',
            'SAgency',
            'SEmployee',
            'SBase',
            'Upload',
            'SDoctor',
            'h',
            '$filter',
            function ($scope
                , $stateParams
                , SMark
                , SHospital
                , SAgency
                , SEmployee
                , SBase
                , Upload
                , SDoctor
                , h
                , $filter
            )
            {
                $scope.h = h;
                $scope.SBase = SBase;
                $scope.SEmployee = SEmployee;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SMark;
                $scope.SDoctor = SDoctor;
                $scope.current_row = SMark.current_row;
                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                SMark.init();
                $scope.cond = SMark.cond;
                $scope.with_search = $stateParams.with_search;
                //$scope.cu_bat_data_mark_list = SMark.cu_bat_data.mark_list;
                h.prepare_location_data();

                $scope.uploadFiles = function(file) {
                    $scope.f = file;
                    if (file && !file.$error) {
                        file.upload = Upload.upload({
                            url: cook($scope.SIns.ins_name + '/import_data'),
                            file: file
                        });

                        file.upload.then(function (response) {

                        }, function (response) {
                            if (response.status > 0)
                                $scope.errorMsg = response.status + ': ' + response.data;
                        });

                        file.upload.progress(function (evt) {
                            file.progress = Math.min(100, parseInt(100.0 *
                                evt.loaded / evt.total));
                        });
                    }
                }

                if($stateParams.with_search)
                {
                    SMark.with_search = 1;
                }
                // $scope.$watch('cond', function(){
                //     SMark.refresh();
                // }, true)
                // 
                $scope.time = function(time){
                    return $filter('laDate')(time);
                }
            }
        ])
        .controller('CPageMarkNew',
        [
            '$scope',
            '$stateParams',
            'SMark',
            'SAgency',
            'SBase',
            'Upload',
            'SDoctor',
            'h',
            'SHospital',
            'H',
            '$state',
            function ($scope
                , $stateParams
                , SMark
                , SAgency
                , SBase
                , Upload
                , SDoctor
                , h
                , SHospital
                , H
                , $state
            )
            {
            $scope.h = h;
            $scope.SBase = SBase;
            $scope.SIns = SMark;
            $scope.SAgency = SAgency;
            $scope.SHospital = SHospital;

            SMark.cu_bat_data.a = undefined;
            SMark.cu_bat_data.b = undefined;
            SMark.cu_bat_data.c = undefined;

            if($state.current.name == 'base.mark.bind'){
                H.p(cook('agency/valid')).then(function(res){
                    $scope.agencys = res.data.d;
                })
            }

            $scope.add = function(){
                SMark.bat_mark('add', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                    c : SMark.cu_bat_data.c,
                }).then(function(res){
                    $('#resultLog').html(res.data.d);
                });
            }

            $scope.bind = function(prefix){
                if (!confirm('确认要绑定'+SMark.cu_bat_data.a+'个Mark给'+$scope.targetSelected.name+'?')) {
                    return;
                };

                SMark.bat_mark('bind', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                    c : SMark.cu_bat_data.c,
                }).then(function(res){
                    $('#resultLog').html(res.data.d);
                });
            }

            $scope.unbind = function(prefix){
                if (!confirm('确认要解除当前 Mark?')) {
                    return;
                };

                SMark.bat_mark('unbind', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                }).then(function(res){
                    $('#resultLog').html(res.data.d);
                });
            }
            $scope.checkout = function(){
                SMark.bat_mark('checkout', {
                    a : SMark.cu_bat_data.a,
                }).then(function(res){
                    if (res.status != 200) {
                        toastr.error("服务器错误");
                        return;
                    };
                	if(res.data.status == 1){
                        try{
                            var data = JSON.parse(res.data.d);
                            $('#resultLog').html(data.msg);
                            $scope.current_page_data = data.data;
                        }catch(e){
                            
                        }
                        
                	}
                });
            }
            
            $scope.ck_mark = function(){
            	H.p(cook('mark/ck_mark'), {d: SMark.cu_bat_data.a}).then(function(res){
                    if (res.data.status == 1) {
                        //$state.go('base.robot.detail');
                        toastr.success('归档成功');
                    }else{

                    };
                });
            }

        }])
        .controller('CMarkDetail', ['$scope', 'iMark', 'ngDialog', function ($scope, iMark, ngDialog) {
            $scope.SIns = iMark;

            $scope.bind = function(){
                var d = ngDialog.open({
                    templateUrl: 'mark_bind_agency',
                    size: 'md',
                    controller: 'MarkModify',
                    data : {
                        'type' : 'bind',
                        'mark' : iMark.current_row.id
                    }
                });

                d.closePromise.then(function (data) {
                    if (data) {
                        $scope.SIns.one($scope.SIns.current_row.id);
                    };
                });
            }

            $scope.unbind = function(){
                var d = ngDialog.open({
                    templateUrl: 'mark_unbind_agency',
                    size: 'md',
                    controller: 'MarkModify',
                    data : {
                        'type' : 'unbind',
                        'mark' : iMark.current_row.id
                    }
                });

                d.closePromise.then(function (data) {
                    if (data) {
                        $scope.SIns.one($scope.SIns.current_row.id);
                    };
                });
            }

            $scope.recycle = function(){
                var d = ngDialog.open({
                    templateUrl: 'mark_recycle_agency',
                    size: 'md',
                    controller: 'MarkModify',
                    data : {
                        'type' : 'recycle',
                        'mark' : iMark.current_row.id
                    }
                });

                d.closePromise.then(function (data) {
                    console.log(data.id + ' has been dismissed.');
                    if (data) {
                        $scope.SIns.current_row.status = 3;
                    };
                });
            }

            $scope.replace = function(){
                var d = ngDialog.open({
                    templateUrl: 'mark_replace_agency',
                    size: 'md',
                    controller: 'MarkModify',
                    data : {
                        'type' : 'replace',
                        'mark' : iMark.current_row.id
                    }
                });

                d.closePromise.then(function (data) {
                    console.log(data.id + ' has been dismissed.');
                    if (data) {
                        $scope.SIns.current_row.status = 4;
                        $scope.SIns.current_row.cmid = data.value;
                    };
                });
            }
        }])
        .controller('MarkModify', ['$scope', 'SAgency', '$timeout', 'H', 'SMark', 'ngDialog', function ($scope, SAgency, $timeout, H, SMark, ngDialog) {
            $scope.data = $scope.ngDialogData;
            $scope.SAgency = SAgency;

            $timeout(function(){
                $('select.chosen+.chosen-container').css({'width': '200px'})
            }, 100);
            $scope.bind = function(action, agency_id){
                var data = {
                    'mark': $scope.data.mark,
                    'action': action
                };

                if (agency_id) {
                    data.agency_id = agency_id;
                };
                H.p(cook('mark/modify'), data).then(function(res){
                    if (res.data && res.data.status == 1) {
                        $scope.closeThisDialog(true);
                    };
                })
            }

            $scope.close = function(){
                ngDialog.closeAll();
            }

            $scope.recycle = function(){
                H.p(cook('mark/recycle'), {'id': $scope.data.mark}).then(function(res){
                    if (res.data && res.data.d == 1) {
                        $scope.closeThisDialog(true);
                    };
                })
            }

            $scope.replace = function(){
                H.p(cook('mark/replace'), {'id': $scope.data.mark, 'cmid': $scope.cmid}).then(function(res){
                	if (res.data && res.data.d == 1) {
                        $scope.closeThisDialog($scope.cmid);
                    }
                    else {
                    	$scope.isError = true;
                    }
                })
            }
        }])
        .controller('CMarkUsb', ['$scope', 'Log', function ($scope, Log) {
            console.log('log: ', Log && Log.data && Log.data.d.message);
            $scope.result = Log && Log.data && Log.data.d.message;
            $('#resultUsb').html($scope.result);

            $scope.redirect = location.protocol+'//'+location.host+(location.port&&(':'+location.port)) + '/#/mark/usb';
        }])
        .controller('CPageEmployee',
        [
            '$scope',
            '$stateParams',
            'SMark',
            'SHospital',
            'SAgency',
            'ngDialog', 
            'SEmployee',
            'SBase',
            'h',
            function ($scope
                , $stateParams
                , SMark
                , SHospital
                , SAgency
                , ngDialog
                , SEmployee
                , SBase
                , h
            )
            {
                $scope.h = h;
                $scope.SBase = SBase;
                $scope.SEmployee = SEmployee;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SEmployee;
                $scope.current_row = SEmployee.current_row;

                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                $scope.cond = SEmployee.cond;
                $scope.with_search = $stateParams.with_search;
                //$scope.cu_bat_data_mark_list = SEmployee.cu_bat_data.mark_list;
                SEmployee.init();

                //h.prepare_location_data();
                $scope.$watch('SIns.cond', function()
                {
                    SEmployee.refresh();
                }, true);

                $scope.toggle_status = function(row){
                    var text = row.status ? '设为离职' : '恢复职位',
                        confirm = ngDialog.openConfirm({
                        template: '\
                            <div class="col-md-12 panel panel-default"><div class="panel-body"><h4>确认将'+row.name + text+ '</h4>\
                            <div class="ngdialog-buttons">\
                                <button type="button" class="ngdialog-button ngdialog-button-secondary" ng-click="closeThisDialog(0)">取消</button>\
                                <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirm(1)">确定</button>\
                            </div></div></div>',
                        plain: true
                    });

                    // confirm
                    confirm.then(function (data) {
                        $scope.SIns.cu({id: row.id, status: !row.status, toggle: true});
                    });
                }
            }
        ])
        .controller('CPageEmployeeNew', ['$scope', 'SEmployee', '$state', '$stateParams', function ($scope, SEmployee, $state, $stateParams) {
            $scope.SIns = SEmployee;

            if(!$stateParams.id){
                $scope.SIns.current_row = {};
            }

            $scope.save = function(){
                // 去掉无关字段
                var data = {};
                angular.extend(data, SEmployee.current_row);
                delete data['deleted_at'] && delete data['updated_at'] && delete data['created_at'];

                if ($scope.password) {
                    data.password = $scope.password;
                };

                SEmployee.cu(data).then(function(res){
                    if (res.data.status == 1) {
                        $state.go('base.employee.list');
                    };
                });
            }
        }])
        .controller('CPageMe',
        [
            '$scope',
            '$stateParams',
            'SMark',
            'SHospital',
            'SAgency',
            'SMe',
            'SBase',
            'h',
            'H',
            'UserSession',
            function ($scope
                , $stateParams
                , SMark
                , SHospital
                , SAgency
                , SMe
                , SBase
                , h
                , H
                , session
            )
            {

                $scope.h = h;
                $scope.SBase = SBase;
                $scope.SMe = SMe;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SMe;
                $scope.current_row = SMe.current_row;
                $scope.cond = SMe.cond;
                $scope.with_search = $stateParams.with_search;
                //$scope.cu_bat_data_mark_list = SMe.cu_bat_data.mark_list;
                // 修改类型
                var role = session.get('his_chara')[0];
                SMe.ins_name = role;
                SMe.init();

                $scope.$watch('current_password', function()
                {
                    H.p(cook(role+'/r'), {where: {'id': SMe.uid, password: $scope.current_password}})
                        .then(function(r)
                        {
                            if(r.data.d.count)
                            {
                                var current = r.data.d.main[0];
                                SMe.me_row.phone = current.phone;
                                SMe.me_row.email = current.email;

                                $scope.valid_old_password  = true;
                            }
                            else
                            {
                                $scope.valid_old_password  = false;
                            }
                        })
                }, true)

                //h.prepare_location_data();

                if($stateParams.with_search)
                {
                    SMe.with_search = 1;
                }

                //$scope.$watch('cond', function()
                //{
                //    SMe.refresh();
                //}, true)
            }
        ])
        .controller('ReportCtrl', ['$scope', '$http', function ($scope, $http) {
            $scope.cond = {};

            $scope.query = function(){
                var url = $('form#report-form').eq(0).attr('action');
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    transformRequest: function(obj) {
                        var str = [];
                        for(var p in obj)
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                        return str.join("&");
                    },
                    data: $scope.cond
                })
                .success(function(res){
                    $("#report-result").html(res);
                });

                return false;
            }
        }])
        .controller('PMCtrl', ['$scope', 'H', '$rootScope', '$stateParams', '$state', 'UserSession', 
                function($scope, H, $rootScope, $stateParams, $state, session){
            // 默认获取
            $stateParams.type ? $scope.toMe = -1 :  $scope.toMe = 1;
            var type = ['employee', 'agency', 'doctor'],
                role = session.get('his_chara')[0],
                roleType = type.indexOf(role)+1;

            console.log(roleType);

            $scope.getMessage = function(){
                $scope.loading = true;
                var cond = {
                    where : {},
                    order_by : 'sendtime desc'
                };
                if ($scope.toMe == 1) {
                    cond.where = {
                        recipientid : $rootScope._user_session_data.uid,
                        recipienttype : roleType
                    };
                };

                if ($scope.toMe == -1) {
                    cond.where = {
                        senderid : $rootScope._user_session_data.uid,
                        sendertype : roleType
                    };
                };

                H.p(cook('message/r'), cond).then(function(res){
                    $scope.messages = res.data.d.main;
                    $scope.loading = false;
                })
            }

            $scope.read = function(item){
                item.read = 1;
                $state.go('base.pm.read', {id: item.id});
            }

            if ($state.current.name == 'base.pm.list') {
                $scope.getMessage();

                $scope.$watch('toMe', function(me){
                    $scope.getMessage();
                });
            }else if ($state.current.name == 'base.pm.read') {
                // 获取内容

            }else if ($state.current.name == 'base.pm.new') {
                // 发送消息
                
            };
            
        }])
        .controller('PMIns', ['$scope', 'H', '$state', function ($scope, H, $state) {
            $scope.$watch('data.recipienttype', function(n){
                // in ['agency', 'doctor', 'employe'];
                if (n) {
                    $scope.get_user_list(n);
                };
            });
            $scope.users = [];
            $scope.get_user_list = function(type){
                H.p(cook(type+'/_user_list')).then(function(res){
                    if (res.data.status == 1) {
                        $scope.users = res.data.d;
                    }else{
                        $scope.users = [];
                    };
                });
            }

            $scope.send = function(){
                console.log($scope.data);
                H.p(cook('message/cu'), $scope.data).then(function(res){
                    if (res.data.status == 1) {
                        $state.go('base.pm.list');
                    };
                });
            }
        }])
        .controller('LogCtrl', ['$scope', '$state', 'H', function ($scope, $state, H) {
            $scope.items_per_page = 20;
            $scope.cond = {where: {}, pagination: 1, limit: $scope.items_per_page};
            $scope.init = function(){
                H.p(cook('log/r'), $scope.cond).then(function(res){
                    $scope.logs = res.data.d;
                })
            }

            $scope.init();
            $scope.$watch('cond.pagination', function(n){
                if (n) {
                    // 刷新
                    $scope.init();
                };
            });
        }])
})();
