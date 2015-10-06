<header id="header">
    <!--logo start-->
    <div class="brand">
        <a href="" ui-sref="base.home" class="logo"><span>Space</span>Lab</a>
    </div>
    <!--logo end-->
    <div class="toggle-navigation toggle-left">
        <a class="btn btn-default pull-left" id="toggle-left" data-toggle="tooltip" data-placement="right" href="#/" 
                title="Toggle Navigation" style="line-height: 30px;">
            <i class="fa fa-bars"></i>
        </a>

        <div class="page-nav pull-left" ui-view="actions">
            
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

<!-- ngtemplate -->
<script type="text/ng-template" id="templates/device-nav.html">
    <ul>
        <li><a href="" title="">新增设备</a></li>
        <li><a href="" title="">设备销售</a></li>
        <li><a href="" title="">设备作废</a></li>
        <li><a href="" title="">终止合作</a></li>
        <li><a href="" title="">设备查询</a></li>
    </ul>
</script>
<script type="text/ng-template" id="templates/empty-nav.html"></script>