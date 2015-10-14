<header id="header">
    <div class="toggle-navigation toggle-left">
        <a class="btn btn-default pull-left" id="toggle-left" data-toggle="tooltip" data-placement="right" href="#/"
                title="Toggle Navigation" style="line-height: 30px;margin-right: 10px;">
            <i class="fa fa-home"></i>
        </a>
        <div class="page-nav pull-left" ng-if="$state.includes('base.robot')" ng-cloak>
             <ul class="nav nav-pills">
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.new')]">
                    <a href="" ui-sref-opts="{reload:true}" ui-sref="base.robot.new" title="">新增设备</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query') && $state.params.type == 'sale']">
                    <a ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : 'sale'})">设备销售</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query') && $state.params.type == 'abort']">
                    <a ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : 'abort'})">设备作废</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query') && $state.params.type == 'end']">
                    <a ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : 'end'})">中止合作</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.robot.query')&& $state.params.type == '']">
                    <a href="" ui-sref-opts="{reload:true}" ui-sref="base.robot.query({type : ''})" title="">设备查询</a>
                </li>
                 <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                      报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="" title="">设备状态清单</a></li>
                        <li><a href="" title="">销售情况表</a></li>
                    </ul>
                  </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.mark')" ng-cloak>
            <ul class="nav nav-pills">
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.new" title="">新增Mark</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.query')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.query" title="">Mark查询</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.bind')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.bind" title="">Mark绑定</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.unbind')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.unbind" title="">Mark解绑</a></li>
                <li  ng-class="{true:'active',false:'inactive'}[$state.includes('base.mark.usb')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark.usb" title="">USB数据上传</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="" title="">Mark情况统计表</a></li>
                        <li><a href="" title="">医院Mark使用情况表</a></li>
                        <li><a href="" title="">医生Mark使用情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.hospital')" ng-cloak>
            <ul class="nav nav-pills">
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.new" title="">新建医院</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.hospital.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital.list({with_search: 1})" title="">医院查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="" title="">设备状态清单</a></li>
                        <li><a href="" title="">销售情况表</a></li>
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
                        <li><a href="" title="">设备状态清单</a></li>
                        <li><a href="" title="">销售情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="page-nav pull-left" ng-if="$state.includes('base.doctor')" ng-cloak>
            <ul class="nav nav-pills">
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.doctor.new')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.doctor.new" title="">新建医生</a></li>
                <li ng-class="{true:'active',false:'inactive'}[$state.includes('base.doctor.list')]"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.doctor.list({with_search: 1})" title="">医生查询</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="" title="">医生情况统计表</a></li>
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
                        <li><a href="" title="">代理商Mark情况统计表</a></li>
                        <li><a href="" title="">代理情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="user-nav">
        <ul>
            <!-- <li class="reg_item"><a href="">首页</a></li> -->

            <!-- <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark({with_search: 1})">Mark管理</a></li> -->
            @if(he_is('agency'))
            <!-- <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.mark_checkout">Mark归档</a></li> -->
            @endif
            @if(he_is('employee'))
                <!-- <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital_menu">医院管理</a></li>
                <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital_menu">医生/科室管理</a></li>
                <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.robot({with_search: 1})">设备管理</a></li>
                <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.agency({with_search: 1})">代理商管理</a></li>
                <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.employee({with_search: 1})">员工管理</a></li>
                <li class="reg_item"><a href="" ui-sref-opts="{reload:true}" ui-sref="base.hospital_menu">病患管理</a></li> -->
            @endif

            <!-- <li class="dropdown messages">
                <span class="badge badge-danager animated bounceIn" id="new-messages">5</span>
                <button type="button" class="btn btn-default dropdown-toggle options" id="toggle-mail"
                        data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                </button>
            </li> -->
            <li>
                当前登录用户:
            <!--      <md-menu md-position-mode="target-right target" ng-cloak>
                  <md-button aria-label="Open demo menu" class="md-icon-button" ng-click="$mdOpenMenu($event)">
                    {{username()}} <i class="fa fa-angle-down"></i>
                  </md-button>
                  <md-menu-content width="4" >
                    <md-menu-item>
                      <md-button>
                        <a href="" ui-sref-opts="{reload:true}" ui-sref="base.me"><i class="fa fa-user"></i>个人设置</a>
                      </md-button>
                    </md-menu-item>
                    <md-menu-item>
                      <md-button>
                        <a href="{{url('logout')}}"><i class="fa fa-power-off"></i> 登出</a>
                      </md-button>
                    </md-menu-item>
                  </md-menu-content>
                </md-menu> -->
            </li>

            <li class="dropdown settings" dropdown is-open="isopen">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    {{username()}} <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li>
                        <a href="" ui-sref-opts="{reload:true}" ui-sref="base.me"><i class="fa fa-user"></i>个人设置</a>
                    </li>
                    <li>
                        <a href="{{url('logout')}}"><i class="fa fa-power-off"></i> 登出</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
