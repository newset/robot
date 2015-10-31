{{--
编辑科室页面
router:base.department.new
url: /#/department/new
controller:CDepartmentEdit
--}}
    <div class="container panel-default panel" style="padding:0px">
        <div class="panel-heading">
            {{-- <div class="row col-md-12"> --}}
            <h3 class="panel-title pull-right">当前医院: [:hospital.name:]</h3>
            <h3 class="panel-title">编辑科室</h3>
        </div>
    <div class="panel-body black-border">
    </div>
<form name="form_department" class="form-horizontal">
            <div class="form-group">
        <label class="control-label col-md-1">科室名</label>
        <div class="col-md-6">
            <input class="form-control" ng-model="department.name"  required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-1">登录名</label>
        <div class="col-md-6">
            <input  class="form-control" ng-model="department.username"  required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-1">密码</label>
        <div class="col-md-6">
            <input  class="form-control" ng-model="department.password"
                   ng-init="department.password = ''"
                   type="password"
                   class="">
        </div>
    </div>
    {{-- <div class="form-group">
    <label class="control-label col-md-2">所在医院</label>
    <div class="col-md-8">
    <select class=""
    name="hospital_id"
    ng-init="department.hospital_id = department.hospital_id || SIns.cond.where.hospital_id"
    ng-model="department.hospital_id"
    ng-options="l.id as l.name for l in SIns.all_hospital"
    required>
    <option value="">所在省份</option>
    </select>
    </div>
    </div> --}}
    <div class="form-group">
        <label class="control-label col-md-1">备注</label>
        <div class="col-md-6">
            <textarea name="memo"   ng-model="department.memo"  class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group col-md-12 text-right">
            <button  class="btn-custom btn btn-default  " ng-disabled="form_department.$invalid" ng-click="delete()">删除该科室</button>
            <button  class="btn-custom btn btn-primary  " ng-disabled="form_department.$invalid" ng-click="cancel()">取消</button>
            <button  class="btn-custom btn btn-primary  " ng-disabled="form_department.$invalid" ng-click="submit()">确定</button>
    </div>
    <br/>
    {{-- <div class="form-group">
    <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div> --}}
</form>
</div>
<br/>

    {{-- <span ng-if="department.hospital_id" ng-repeat="h in SIns.all_hospital | filter: {id: department.hospital_id}:true">医院：[:h.name:]</span> --}}
