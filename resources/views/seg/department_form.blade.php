{{-- 新建科室ｍｏｄａｌ --}}
<div class="container panel-default panel" style="padding:0px">
    <div class="panel-heading">
        <h3 class="panel-title">新建科室</h3>
    </div>
    <div class="panel-body">
        <form ng-submit="SIns.cu(SIns.current_row)"
              name="form_hospital"
          class="form-horizontal"
              ng-controller="CPageDepartment">
            <span ng-if="SIns.current_row.hospital_id" ng-repeat="h in SIns.all_hospital | filter: {id: SIns.current_row.hospital_id}:true">医院：[:h.name:]</span>
            <div class="form-group">
                <label class="control-label col-md-3">科室名</label>
                <div class="col-md-8">
                    <input ng-model="SIns.current_row.name"
                           class="form-control"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">登录名</label>
                <div class="col-md-8">
                    <input ng-model="SIns.current_row.username"
                           class="form-control"
                           required>
                </div>
            </div>
            <div class="form-group">
                {{-- <button type="button" class="btn btn-default" ng-click="change_password = !change_password">密码</button> --}}
                {{-- <div ng-if="change_password"> --}}
                        <div>
                    <label class="control-label col-md-3">密码</label>
                    <div class="col-md-8">
                        <input ng-model="SIns.current_row.password"
                               ng-init="SIns.current_row.password = ''"
                               type="password"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">所在医院</label>
                <div class="col-md-8">
                    <select class="form-control"
                            name="hospital_id"
                            ng-init="SIns.current_row.hospital_id = SIns.current_row.hospital_id || SIns.cond.where.hospital_id"
                            ng-model="SIns.current_row.hospital_id"
                            ng-options="l.id as l.name for l in SIns.all_hospital"
                            required>
                        <option value="">所在省份</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">备注</label>
                <div class="col-md-8">
                    <textarea name="memo"
                              ng-model="SIns.current_row.memo"
                              class="form-control"></textarea>
                </div>
            </div>
            {{-- <div class="form-group">
                <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
            </div> --}}
        </form>
    </div>　{{--   panel-body --}}
    <div class="panel-footer" ng-controller="CPageDepartment as cPageDepartment">
        <button  class="btn  pull-right" ng-disabled="form_hospital.$invalid" ng-click="SIns.cu(SIns.current_row)">提交</button>
    </div>
</div>
