<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_hospital"
      ng-controller="CPageDoctor">
    <div class="form-group">
        <label>姓名</label>
        <input ng-model="SIns.current_row.name"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>性别</label>
        <select class="form-control"
                ng-model="SIns.current_row.gender"
                ng-options="l.id as l.name for l in [{id: 1, name: '男'}, {id: 0, name: '女'}]"
                ng-init="SIns.current_row.gender = SIns.current_row.gender">
        </select>
    </div>
    <div class="form-group">
        <label>等级</label>
        <select class="form-control"
                ng-model="SIns.current_row.level"
                ng-options="l.id as l.name for l in
                    [
                        {id: 1, name: '1级'},
                        {id: 2, name: '2级'},
                        {id: 3, name: '3级'},
                        {id: 4, name: '4级'},
                        {id: 5, name: '5级'},
                    ]">
        </select>
    </div>
    <div class="form-group">
        <label>职务</label>
        <input ng-model="SIns.current_row.title"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>授权码</label>
        <input ng-model="SIns.current_row.cust_id"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label>所在医院</label>
        {{--[:SIns.current_row:]--}}
        <select class="form-control"
                name="city_id"
                ng-model="SIns.current_row.hospital_id"
                ng-options="l.id as l.name for l in SIns.all_hospital"
                required>
            {{--<option value="">所在省份</option>--}}
        </select>
    </div>
    <div class="form-group">
        <label>备注</label>
        <textarea name="memo"
                  ng-model="SIns.current_row.memo"
                  class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>手机号</label>
        <input ng-model="SIns.current_row.phone"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input ng-model="SIns.current_row.email"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>状态</label>
        {{--<select class="form-control" ng-model="Ins.current_row.status">--}}
            {{--<option value="1">正常</option>--}}
            {{--<option value="0">冻结</option>--}}
        {{--</select>--}}
        <select class="form-control"
                ng-model="SIns.current_row.status"
                ng-options="l.id as l.name for l in SIns.status_type"
                >
        </select>

    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div>
</form>