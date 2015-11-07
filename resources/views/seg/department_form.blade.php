{{-- 新建科室页面
router:
controller:
url:
--}}
<div class="container panel-default panel" style="padding:0px">
    <div class="panel-heading">
        <h3 class="panel-title pull-right">所在医院: [:hospital.name:]</h3>
        <h3 class="panel-title">新建科室</h3>
    </div>
    <div class="panel-body black-border">
    </div>
    <br/>
    <form name="form_department" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-1">科室名称</label>
            <div class="col-md-6">
                <input class="form-control" ng-model="department.name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1">登录名</label>
            <div class="col-md-6">
                <input class="form-control" name="username" ng-model="department.username" la-exist="department.username">
                <p ng-show="form_department.username.$error.laExist" class="text-danger mt10">该用户名已存在</p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1">密码</label>
            <div class="col-md-6">
                <input ng-model="department.password"
                       ng-init="department.password = ''"
                       type="password"
                       class="form-control" >
            </div>
        </div>
      
        <div class="form-group">
            <label class="control-label col-md-1">备注</label>
            <div class="col-md-6">
                <textarea name="memo"
                          ng-model="department.memo"
                          class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="pull-right" style="margin-right: 30px;">
                <a class="btn-custom btn btn-default" ui-sref="base.hospital.department_doctor({'hid' : hospital_id})">取消</a>
                <button  class="btn-custom btn btn-primary " ng-disabled="form_department.$invalid" ng-click="submit()">确定</button>
            </div>
        </div>
        <br/>
        {{-- <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
        </div> --}}
    </form>
</div>

