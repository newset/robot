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
            '$stateParams',
            function ($scope,
                      SBase,
                      SHospital,
                      h,
                      $stateParams
            )
            {
                $scope.SBase = SBase;
                $scope.SIns = SHospital;
                $scope.SIns.init();
                $scope.condTmp = $scope.SIns.cond;

                $scope.SIns.show_search_panel = $stateParams.with_search;
                h.prepare_location_data();
                $scope.hospitalQuery=function(){
                        //人工点击的时候才对被监视的条件变量进行深拷贝，实现搜索
                        $scope.cond=JSON.parse(JSON.stringify($scope.condTmp));//深拷贝
                };
                $scope.$watch('cond', function()
                {
                    $scope.SIns.refresh();
                }, true)
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
                h,H,
                $stateParams ){
        $scope.hospital_id=parseInt($stateParams.hid);
        $scope.hospital={};
        $scope.departments={};
        $scope.doctors={};

        //获取医院信息
        H.p(cook('hospital/r'), {'limit': 0, 'order_by': 'id','id':
              $scope.hospital_id}).then(function (r){
                $scope.hospital = r.data.d.main[0];
          });
        //获取科室
        H.p(cook('department/r'), {'limit': 0, 'order_by': 'id',
                where:{'hospital_id': $scope.hospital_id}
                }).then(function (r){
                $scope.departments = r.data.d.main;
          });
        //获取医生
        H.p(cook('doctor/r'), {'limit': 0, 'order_by': 'id',
                where:{'hospital_id': $scope.hospital_id}
              }).then(function (r){
                $scope.doctors = r.data.d.main;
                  console.log(($scope.doctors));
          });
        $scope.delete_department=function(department){
          console.log(department);
              SDepartment.d(department.id);
            $scope.departments.splice($scope.departments.indexOf(department), 1);
      };
      }])

        .controller('CDepartmentEdit',[
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
              $scope.department_old={};
                //获取科室
                H.p(cook('department/r'), {'limit': 0, 'order_by': 'id',
                        where:{'id': $scope.department_id}
                        }).then(function (r){
                        $scope.department_old = r.data.d.main[0];
                        $scope.department=angular.copy($scope.department_old);
                        $scope.hospital_id=$scope.department.hospital_id;
                  });
                $scope.cancel=function(){//重置
                         $scope.department.name=$scope.department_old.name;
                          $scope.department.username=$scope.department_old.username;
                          $scope.department.password=$scope.department_old.password;
                          $scope.department.memo=$scope.department_old.memo;
                  };
                $scope.submit=function(){//编辑
                          console.log($scope.department);
                          SDepartment.cu($scope.department);
                          $state.go('base.department_doctor',{hid:$scope.hospital_id});//返回医院详情页
                };
                $scope.delete=function(){//删除科室
                        SDepartment.d($scope.department.id);
                        $state.go('base.department_doctor',{hid:$scope.hospital_id});//返回医院详情页
                };
        }])
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
                $scope.cond = SAgency.cond;
                SAgency.show_search_panel = $stateParams.with_search;
                h.prepare_location_data();

                if($stateParams.with_search)
                {
                    SAgency.with_search = 1;
                }

                //$scope.$watch('current_row', function()
                //{
                //    h.prepare_current_row.call(me);
                //}, true)
            }
        ])

        .controller('CPageRobot',
        [
            '$scope',
            '$stateParams',
            'SRobot',
            'SHospital',
            'SAgency',
            'SEmployee',
            'SBase',
            'h',
            function ($scope
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
                $scope.SIns.cond.where.hospital_id = $stateParams.hid;
                SRobot.init();
                $scope.cond = SRobot.cond;

                $scope.with_search = $stateParams.with_search;
                h.prepare_location_data();

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

                $scope.save = function(){
                    $scope.SIns.cu($scope.SIns.current_row).then(function(res){
                        // 跳转到详情 todo
                        $scope.SIns.current_row = {};
                        console.log('创建成功: ', res.data.d);
                    });
                }

        }])
        .controller('CPageRobotDetail', ['$scope', 'sIns', function ($scope, sIns) {
            $scope.SIns = sIns;


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
        .controller('CMarkDetail', ['$scope', 'iMark', function ($scope, iMark) {
            $scope.SIns = iMark;
            console.log(iMark.current_row);
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
