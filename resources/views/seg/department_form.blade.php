{{-- 新建科室页面
router:
controller:
url:
 --}}
<div class="panel panel-default">
    <div class="panel-body black-border">
        <div class="row col-md-12">
            <div class="col-md-2 pull-right">
                <span>当前医院: [:hospital.name:]</span>
            </div>
            <div class="col-md-1　col-md-offset-10 pull-left">
                <h3 class="panel-title">新建科室</h3>
            </div>
        </div>
    </div>
    <br/>
    <form   name="form_department"  class="form-horizontal">
        {{-- <span ng-if="department.hospital_id" ng-repeat="h in SIns.all_hospital | filter: {id: department.hospital_id}:true">医院：[:h.name:]</span> --}}
        <div class="form-group">
            <label class="control-label col-md-2">科室名称</label>
            <div class="col-md-8">
                <input ng-model="department.name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">登录名</label>
            <div class="col-md-8">
                <input ng-model="department.username">
            </div>
        </div>
        <div class="form-group">
            {{-- <button type="button" class="btn btn-default" ng-click="change_password = !change_password">密码</button> --}}
            {{-- <div ng-if="change_password"> --}}
            <label class="control-label col-md-2">密码</label>
                <div class="col-md-8">
                    <input ng-model="department.password"
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
            <label class="control-label col-md-2">备注</label>
            <div class="col-md-3">
                <textarea name="memo"
                          ng-model="department.memo"
                          class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 col-md-offset-10">
                <button  class="btn-custom  " ng-disabled="form_department.$invalid" ng-click="cancel()">取消</button>
                <button  class="btn-custom  " ng-disabled="form_department.$invalid" ng-click="submit()">确定</button>
            </div>
        </div>
        <br/>
        {{-- <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
        </div> --}}
    </form>


</div>
