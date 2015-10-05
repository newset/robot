<section id="main-content" ng-controller="CPageMe">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">个人设置</h3>
                </div>
                <div class="panel-body">
                    <div class="section col-md-6">
                        <h4>修改密码</h4>
                        <form ng-submit="SIns.change_password(SIns.me_row)"
                              ng-init="SIns.me_row.id = SIns.uid"
                              name="form_me_password">
                            <div class="form-group">
                                <label>当前密码</label>
                                <input ng-model="current_password"
                                       ng-model-options="{debounce: 300}"
                                       class="form-control"
                                       type="password"
                                       ng-minlength="5"
                                       ng-maxlength="64"
                                       name="current_password"
                                       required>
                                <label class="error" ng-if="!valid_old_password && form_me_password.current_password.$touched">密码有误</label>
                            </div>
                            <div class="wrap" ng-if="valid_old_password && form_me_password.current_password.$valid">
                                <div class="form-group">
                                    <label>新密码</label>
                                    <input ng-model="SIns.me_row.password"
                                           class="form-control"
                                           type="password"
                                           ng-minlength="5"
                                           ng-maxlength="64"
                                           name="password"
                                           required>
                                    <label class="error"
                                           ng-if="form_me_password.password.$invalid && form_me_password.password.$touched">密码长度需在5至64位之间</label>
                                </div>
                                <div class="form-group">
                                    <label>确认密码</label>
                                    <input ng-model="SIns.me_row.password2"
                                           class="form-control"
                                           type="password"
                                           ng-minlength="5"
                                           ng-maxlength="64"
                                           name="password2"
                                           compare-to="SIns.me_row.password"
                                           required>
                                    <label class="error"
                                           ng-if="form_me_password.password2.$invalid && form_me_password.password2.$touched">两次输入不一致</label>
                                </div>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" ng-disabled="form_me_password.$invalid">修改</button>
                            </div>
                        </form>

                    </div>
                    <div class="section col-md-6">
                        <h4>修改个人信息</h4>
                        <form ng-submit="SIns.cu(SIns.me_row)"
                              name="form_me">
                            <div class="form-group">
                                <label>手机号</label>
                                <input ng-model="SIns.me_row.phone"
                                       class="form-control"
                                       type="number"
                                       name="phone">
                                <label class="error"
                                       ng-if="form_me.phone.$invalid && form_me.phone.$touched">输入有误</label>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input ng-model="SIns.me_row.email"
                                       class="form-control"
                                       type="email"
                                       name="email">
                                <label class="error"
                                       ng-if="form_me.email.$invalid && form_me.email.$touched">输入有误</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" ng-disabled="form_me.$invalid">修改</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>