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

        .controller('CHome', [
            function ()
            {
                console.log('CHome');
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
            'SBase',
            function ($http
                , $scope
                , H
                , h
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
            }
        ])
        .controller('CHospitalEdit',
        [//医院编辑
            '$scope',
            'SBase',
            'SHospital',
            'h','H',
            '$stateParams',
            function ($scope,
                      SBase,
                      SHospital,
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

                $scope.getLastId();

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
      'H',
      '$stateParams',
      function ($scope,
                SBase,
                SDepartment,
                h,
                H,
                $stateParams ){
            $scope.hospital_id=parseInt($stateParams.hid);
            $scope.hospital={};
            $scope.departments={};
            $scope.doctors={};

            SDepartment.cond.where.hospital_id = $scope.hospital_id;
            //获取医院信息
            H.p(cook('hospital/r'), {
                'limit': 0,
                'order_by': 'id',
                'id': $scope.hospital_id
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
        .controller('CAgencyDetail',[
            '$scope',
            'SBase',
            'SAgency',
            'SRobot',
            'h',
            'H',
            '$stateParams',
            function ($scope,
              SBase,
              SAgency,
              SRobot,
              h,
              H,
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
                H.p(cook('agency/toggle'), {s : $scope.SIns.current_row.status, id : $scope.agency_id}).then(function(res){
                    if (res.data.status == 1) {
                        $scope.SIns.current_row.status = res.data.d;
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
            '$state',
            function ($scope
                , $stateParams
                , SRobot
                , SHospital
                , SAgency
                , SEmployee
                , SBase
                , h
                , $state
            ){
                $scope.SEmployee = SEmployee;
                $scope.SHospital = SHospital;
                $scope.SAgency = SAgency;
                $scope.SIns = SRobot;
                console.log('em: ', SEmployee.all);
                $scope.employees = SEmployee.all;

                if (!$stateParams.id) {
                    SRobot.current_row = { status : 0};
                }else{
                    // 如果没有数据，则先获取
                };

                $scope.save = function(){
                    var data = {
                        id : $scope.SIns.current_row.id,
                        cust_id : $scope.SIns.current_row.cust_id,
                        employee_id : $scope.SIns.current_row.employee_id,
                        production_date : $scope.SIns.current_row.production_date,
                        status : Number($scope.SIns.current_row.status)
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
        .controller('CPageRobotDetail', ['$scope', 'sIns', 'SAgency', 'SHospital', 'H', '$state', function ($scope, sIns, SAgency, SHospital, H, $state) {
            $scope.SIns = sIns;
            
            $scope.SAgency = SAgency;            
            $scope.SHospital = SHospital;

            $scope.data = {
                robot_id : $scope.SIns.current_row.id
            } 

            $scope.lease = function(){
                H.p(cook('robotLeaseLog/c'), $scope.data).then(function(res){
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

            $scope.add = function(){

                SMark.bat_mark('add', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                    c : SMark.cu_bat_data.c,
                }).then(function(res){
                    $('#resultLog').html(res.data);
                });
            }

            $scope.bind = function(prefix){
                SMark.bat_mark('bind', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                    c : SMark.cu_bat_data.c,
                }).then(function(res){
                    $('#resultLog').html(res.data);
                });
            }

            $scope.unbind = function(prefix){
                SMark.bat_mark('unbind', {
                    a : SMark.cu_bat_data.a,
                    b : SMark.cu_bat_data.b,
                }).then(function(res){
                    $('#resultLog').html(res.data);
                });
            }
            $scope.checkout = function(){
                SMark.bat_mark('checkout', {
                    a : SMark.cu_bat_data.a,
                }).then(function(res){
                	if(res.data.data){
                		$scope.current_page_data = res.data.data;
                		$('#resultLog').html(res.data.msg);
                	}else{
                		if(res.data.msg){
                			$('#resultLog').html(res.data.msg);
                		}else{
                			$('#resultLog').html(res.data.data);
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
            }

            $scope.unbind = function(){
                var d = ngDialog.open({
                    templateUrl: 'mark_bind_agency',
                    size: 'md',
                    controller: 'MarkModify',
                    data : {
                        'type' : 'unbind',
                        'mark' : iMark.current_row.id
                    }
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
                        $scope.SIns.current_row.status = 4;
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
                        $scope.SIns.current_row.status = 5;
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
            $scope.bind = function(){
                SMark.bat_mark('bind', {
                    a: '1', 
                    b: $scope.data.mark,
                    c: $scope.agency_id
                }).then(function(res){
                    console.log(res);
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
                    };
                })
            }

            $scope.unbind = function(){

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
            'SEmployee',
            'SBase',
            'h',
            function ($scope
                , $stateParams
                , SMark
                , SHospital
                , SAgency
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

                if($stateParams.with_search)
                {
                    SEmployee.with_search = 1;
                }

                $scope.$watch('cond', function()
                {
                    SEmployee.refresh();
                }, true)
            }
        ])

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
            function ($scope
                , $stateParams
                , SMark
                , SHospital
                , SAgency
                , SMe
                , SBase
                , h
                , H
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
                SMe.init();

                $scope.$watch('current_password', function()
                {
                    H.p(cook('employee/r'), {where: {'id': SMe.uid, password: $scope.current_password}})
                        .then(function(r)
                        {
                            if(r.data.d.count)
                            {
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
})();
