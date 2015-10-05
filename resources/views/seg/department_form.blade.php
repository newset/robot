<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_hospital"
      ng-controller="CPageDepartment">
    <span ng-if="SIns.current_row.hospital_id" ng-repeat="h in SIns.all_hospital | filter: {id: SIns.current_row.hospital_id}:true">医院：[:h.name:]</span>
    <div class="form-group">
        <label>科室名</label>
        <input ng-model="SIns.current_row.name"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>登录名</label>
        <input ng-model="SIns.current_row.username"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-default" ng-click="change_password = !change_password">密码</button>
        <div ng-if="change_password">
            <label>密码</label>
            <input ng-model="SIns.current_row.password"
                   ng-init="SIns.current_row.password = ''"
                   type="password"
                   class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label>所在医院</label>
        <select class="form-control"
                name="hospital_id"
                ng-init="SIns.current_row.hospital_id = SIns.current_row.hospital_id || SIns.cond.where.hospital_id"
                ng-model="SIns.current_row.hospital_id"
                ng-options="l.id as l.name for l in SIns.all_hospital"
                required>
            <option value="">所在省份</option>
        </select>
    </div>
    <div class="form-group">
        <label>备注</label>
        <textarea name="memo"
                  ng-model="SIns.current_row.memo"
                  class="form-control"></textarea>
    </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div>
</form>