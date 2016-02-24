<header id="header" ng-cloak>
    <div class="toggle-navigation toggle-left">
        <a id="toggle-left" data-toggle="tooltip" data-placement="right" href="#/" title="Toggle Navigation">
            <img class="pull-left" src="/assets/img/main-logo.png" alt="logo">
        </a>
        @if(!he_is('agency'))
        <div class="main-title pull-left"  ng-if="$state.includes('base.home')" ng-cloak >
            <h1>Remebot医疗机器人运营管理系统</h1>
        </div>
        @endif
        <div class="page-nav pull-left" ng-if="$state.includes('base.robot')" ng-cloak>
             <ul class="nav nav-pills">
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.new')]">
                    <a href="" ui-sref-opts="{reload:true}" ui-sref="base.robot.new" title="">新建设备</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query') && $state.params.type == 'sale']">
                    <a ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : 'sale'})">设备销售</a>
                </li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query')&& $state.params.type == '']">
                    <a href="" ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : ''})" title="">设备查询</a>
                </li>
                 <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                      报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.robot.report({type: 'device_condition'})" title="">设备状态清单</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.robot.report({type: 'robot_sale'})" href="" title="">销售情况表</a></li>
                    </ul>
                  </li>
            </ul>
        </div>
        @if(he_is('agency'))
        <div class="page-nav pull-left" ng-if="$state.includes('base.mark') || $state.includes('base.home')" ng-cloak>
            <ul class="nav nav-pills">
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.query')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.query({with_search: 1})" title="">Mark查询</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.bind')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.bind" title="">Mark绑定</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.unbind')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.unbind" title="">Mark解绑</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.checkout')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.checkout" title="">Mark归档</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.ck_mark_history')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.ck_mark_history" title="">历史归档清单</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.report')]"><a ui-sref-opts="{reload:true}" ui-sref="base.mark.report({type: 'agency_mark'})" title="">统计报表</a></li>
            </ul>
        </div>
        @else
        <div class="page-nav pull-left" ng-if="$state.includes('base.mark')" ng-cloak>
            <ul class="nav nav-pills">
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.new" title="">新增Mark</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.query')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.query({with_search: 1})" title="">Mark查询</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.bind')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.bind" title="">Mark绑定</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.unbind')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.unbind" title="">Mark解绑</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.usb')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.usb" title="">USB数据上传</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.mark.report({type: 'mark_count'})" href="" title="">Mark情况统计表</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.mark.report({type: 'hospital_mark_name'})" href="" title="">医院Mark使用情况表</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.mark.report({type: 'doctor_mark'})" href="" title="">医生Mark使用情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        @endif
        <div class="page-nav pull-left" ng-if="$state.includes('base.hospital')" ng-cloak>
            <ul class="nav nav-pills">
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.new" title="">新建医院</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.list({with_search: 1})" title="">医院查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.hospital.report({type: 'hospital_condition'})" href="" title="">医院情况表</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.hospital.report({type: 'hospital__condition'})" href="" title="">代理商医院情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.department')" ng-cloak>
            <ul class="nav nav-pills">
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.new" title="">新建医院</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.list({with_search: 1})" title="">医院查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.robot.report({type: 'device_condition'})" href="" title="">设备状态清单</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.robot.report({type: 'robot_sale'})" href="" title="">销售情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.doctor')" ng-cloak>
            <ul class="nav nav-pills">
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.doctor.new')]">
                    <a href="" ui-sref-opts="{reload:true}" ui-sref="base.doctor.new" title="">新建医生</a>
                </li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.doctor.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.doctor.list({with_search: 1})" title="">医生查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.doctor.report({type: 'doctor_condition'})" href="" title="">医生情况统计表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.agency')" ng-cloak>
            <ul class="nav nav-pills">
                {{-- <li><a href="" ui-sref-opts="{reload:true}" ui-sref="base.agency.new" title="">新建代理商</a></li> --}}
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.agency.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.agency.list({with_search: 1})" title="">代理商查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.agency.report({type: 'agency__mark'})" href="" title="">代理商Mark情况统计表</a></li>
                        <li><a ui-sref-opts="{reload:true}" ui-sref="base.agency.report({type: 'agency_condition'})" href="" title="">代理情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="user-nav">
        <ul>
           
            @if(he_is('department'))
                 
                <li class="dropdown settings" dropdown is-open="isopen" style="list-style: none;"> 
                    <a class="dropdown-toggle" data-toggle="dropdown" style="color: grey;"> 
                        {{sess('org')}}<i class="fa fa-angle-down">
                        </i> 
                    </a> 
                    <ul class="dropdown-menu animated fadeInDown dropdown-menu-right">
                        <li>
                            <a href="" ui-sref-opts="{reload:true}" ui-sref="base.me"><i class="fa fa-user"></i>修改密码</a>
                        </li>
                        <li>
                            <a href="{{env('APP_URL').'/logout'}}"><i class="fa fa-power-off"></i> 退出</a>
                        </li>
                    </ul>
                     
                </li>
            @else
            <li>
                当前登录用户:
            </li>

            <li class="dropdown settings" dropdown is-open="isopen">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    @if(sess('org'))
                        {{sess('org')}}
                    @else
                        {{username()}}
                    @endif
                     <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="" ui-sref-opts="{reload:true}" ui-sref="base.me"><i class="fa fa-user"></i> 个人设置</a>
                    </li>
                    <li>
                        <a href="" ui-sref-opts="{reload:true}" ui-sref="base.pm.list"><i class="fa fa-envelope"></i> 站内信</a>
                    </li>
                    <li>
                        <!-- <a href="{{url('logout')}}"><i class="fa fa-power-off"></i> 登出</a> -->
                        <a href="{{env('APP_URL').'/logout'}}"><i class="fa fa-power-off"></i> 登出</a>
                    </li>
                </ul>
            </li>
            <li ng-if="_user_session_data.unread">
               <a ui-sref="base.pm.list" title="" >
                    <span class="badge badge-danger">[:_user_session_data.unread:]</span>
               </a> 
            </li>

            @endif
        </ul>
    </div>
</header>
