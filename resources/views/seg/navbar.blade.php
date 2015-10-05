<header id="header">
    <!--logo start-->
    <div class="brand">
        <a href="" ui-sref="base.home" class="logo"><span>Space</span>Lab</a>
    </div>
    <!--logo end-->
    <div class="toggle-navigation toggle-left">
        <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right"
                title="Toggle Navigation">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="user-nav">
        <ul>
            <li class="reg_item"><a href="">首页</a></li>
            <li class="reg_item"><a href="" ui-sref="base.mark({with_search: 1})">Mark管理</a></li>
            @if(he_is('agency'))
            <li class="reg_item"><a href="" ui-sref="base.mark_checkout">Mark归档</a></li>
            @endif
            @if(he_is('employee'))
                <li class="reg_item"><a href="" ui-sref="base.hospital_menu">医院管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.hospital_menu">医生/科室管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.robot({with_search: 1})">设备管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.agency({with_search: 1})">代理商管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.employee({with_search: 1})">员工管理</a></li>
                <li class="reg_item"><a href="" ui-sref="base.hospital_menu">病患管理</a></li>
            @endif

            <li class="dropdown messages">
                <span class="badge badge-danager animated bounceIn" id="new-messages">5</span>
                <button type="button" class="btn btn-default dropdown-toggle options" id="toggle-mail"
                        data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                </button>
                <ul class="dropdown-menu alert animated fadeInDown">
                    <li>
                        <h1>You have <strong>5</strong> new messages</h1>
                    </li>
                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="assets/img/avatar.gif" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">James Bagian</span>
                                <span class="time">30 mins</span>

                                <div class="message-content">Lorem ipsum dolor sit amet, elit rutrum felis sed erat
                                    augue fusce...
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="assets/img/avatar1.gif" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">Jeffrey Ashby</span>
                                <span class="time">2 hour</span>

                                <div class="message-content">hendrerit pellentesque, iure tincidunt, faucibus vitae
                                    dolor aliquam...
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="assets/img/avatar2.gif" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">John Douey</span>
                                <span class="time">3 hours</span>

                                <div class="message-content">Penatibus suspendisse sit pellentesque eu accumsan
                                    condimentum nec...
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="assets/img/avatar3.gif" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">Ellen Baker</span>
                                <span class="time">7 hours</span>

                                <div class="message-content">Sem dapibus in, orci bibendum faucibus tellus, justo
                                    arcu...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="assets/img/avatar4.gif" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">Ivan Bella</span>
                                <span class="time">6 hours</span>

                                <div class="message-content">Curabitur metus faucibus sapien elit, ante molestie
                                    sapien...
                                </div>
                            </div>
                        </a>
                    </li>
                    <li><a href="#">Check all messages <i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>

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