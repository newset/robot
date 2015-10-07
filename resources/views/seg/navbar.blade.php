<header id="header">
    <div class="toggle-navigation toggle-left">
        <a class="btn btn-default pull-left" id="toggle-left" data-toggle="tooltip" data-placement="right" href="#/" 
                title="Toggle Navigation" style="line-height: 30px;margin-right: 10px;">
            <i class="fa fa-home"></i>
        </a>
        <div class="page-nav pull-left" ng-if="$state.includes('base.robot')" ng-cloak>
             <ul class="nav nav-pills">
                <li><a href="" ui-sref="base.robot.new" title="">新增设备</a></li>
                <li><a href="" ui-sref="base.robot.list"  title="">设备销售</a></li>
                <li><a href="" title="">设备作废</a></li>
                <li><a href="" title="">终止合作</a></li>
                <li><a href="" title="">设备查询</a></li>
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
                <li><a href="" ui-sref="base.mark_bind" title="">新增Mark</a></li>
                <li><a href="" title="">Mark查询</a></li>
                <li><a href="" ui-sref="base.mark_bind" title="">Mark绑定</a></li>
                <li><a href="" ui-sref="base.mark_unbind" title="">Mark解绑</a></li>
                <li><a href="" ngf-select="uploadFiles($file)" title="">USB数据上传</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                        报表 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="" title="">Mark情况统计表</a></li>
                        <li><a href="" title="">医院Mark使用情况表</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="page-nav pull-left" ng-if="$state.includes('base.hospital_menu')" ng-cloak>
            <ul class="nav nav-pills">
                <li><a href="" ui-sref="base.hospital_new" title="">新建医院</a></li>
                <li><a href="" ui-sref="base.hospital({with_search: 1})" title="">医院查询</a></li>
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

    </div>
 
    <div class="user-nav">
        <ul>
            <!-- <li class="reg_item"><a href="">首页</a></li> -->
            
            <!-- <li class="reg_item"><a href="" ui-sref="base.mark({with_search: 1})">Mark管理</a></li> -->
            @if(he_is('agency'))
            <!-- <li class="reg_item"><a href="" ui-sref="base.mark_checkout">Mark归档</a></li> -->
            @endif
            @if(he_is('employee'))
                <!-- <li class="reg_item"><a href="" ui-sref="base.hospital_menu">医院管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.hospital_menu">医生/科室管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.robot({with_search: 1})">设备管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.agency({with_search: 1})">代理商管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.employee({with_search: 1})">员工管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.hospital_menu">病患管理</a></li> -->
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
            </li>
            <li class="dropdown settings" dropdown is-open="isopen">
                <a class="dropdown-toggle" dropdown-toggle>
                    {{username()}} <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu animated fadeInDown">
                   
                    <li>
                        <a href="" ui-sref="base.me"><i class="fa fa-user"></i>个人设置</a>
                    </li>
                    <li>
                        <a href="{{url('logout')}}"><i class="fa fa-power-off"></i> 登出</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
