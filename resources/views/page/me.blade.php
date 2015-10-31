<section id="main-content" ng-controller="CPageMe">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="section col-md-12">
                        <h4>修改密码</h4>
                        <hr>
                        <form ng-submit="SIns.change_password(SIns.me_row)"
                              ng-init="SIns.me_row.id = SIns.uid"
                              class="form-horizontal"
                              name="form_me_password">
                            <div class="form-group row">
                                <label class="col-md-1 control-label">旧密码</label>

                                <div class="col-md-6">
                                    <input ng-model="current_password"
                                           ng-model-options="{debounce: 300}"
                                           class="form-control"
                                           type="password"
                                           ng-minlength="5"
                                           ng-maxlength="64"
                                           name="current_password"
                                           required>
                                </div>

                                <label class="error"
                                       ng-if="!valid_old_password && form_me_password.current_password.$touched">密码有误
                                </label>
                            </div>
                            {{--<div class="wrap" ng-if="valid_old_password && form_me_password.current_password.$valid">--}}
                            <div class="form-group row">
                                <label class="control-label col-md-1">新密码</label>

                                <div class="col-md-6">
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
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-1">再输一遍</label>

                                <div class="col-md-6">
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

                            <div class="form-group  col-md-12 text-right">
                                <button type="submit" class="btn btn-primary"
                                        ng-disabled="form_me_password.$invalid" style="margin-right: -10px;">修改
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="section col-md-12">
                        <h4>修改个人信息</h4>
                        <hr>
                        <form ng-submit="SIns.cu(SIns.me_row)"
                              name="form_me">
                            <div class="form-group row">
                                <label class="col-md-1 control-label">手机号</label>

                                <div class="col-md-6">
                                    <input ng-model="SIns.me_row.phone"
                                           class="form-control"
                                           type="text"
                                           name="phone">
                                    <label class="error"
                                           ng-if="form_me.phone.$invalid && form_me.phone.$touched">输入有误</label>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-1 control-label">Email</label>

                                <div class="col-md-6">
                                    <input ng-model="SIns.me_row.email"
                                           class="form-control"
                                           type="text"
                                           name="email">
                                    <label class="error"
                                           ng-if="form_me.email.$invalid && form_me.email.$touched">输入有误</label>
                                </div>
                            </div>

                            <div class="form-group col-md-12 text-right">
                                <button type="submit" class="btn btn-primary" ng-disabled="form_me.$invalid">
                                    修改
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>