<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_hospital"
      ng-controller="CPageAgency">
    <div class="form-group">
        <label>公司名称</label>
        <input {{--ng-model="SIns.current_row.name"--}}
                disabled
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>负责人</label>
        <input ng-model="SIns.current_row.name_in_charge"
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
        <label>手机号</label>
        <input ng-model="SIns.current_row.phone"
               type="number"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>开始时间</label>
        <input ng-model="SIns.current_row.started_at"
               type="date"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <label>结束时间</label>
        <input ng-model="SIns.current_row.ended_at"
               type="date"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label>所在省</label>
            <select class="form-control"
                    name="province_id"
                    ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"
                    ng-model="SIns.current_row.province_id"
                    ng-options="l.id as l.name for l in SBase._.location.province"
                    required>
                {{--<option value="">所在省份</option>--}}
            </select>
        </div>
        <div class="form-group">
            <label>所在城市</label>
            {{--[:SIns.current_row:]--}}
            <select class="form-control"
                    name="city_id"
                    ng-init="SIns.current_row.city_id = SIns.current_row.city_id || options[0].id"
                    ng-model="SIns.current_row.city_id"
                    ng-options="l.id as l.name for l in SBase._.location.city | filter: {parent_id: SIns.current_row.province_id}:true"
                    required>
                {{--<option value="">所在省份</option>--}}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>备注</label>
        <textarea name="memo"
                  ng-model="SIns.current_row.memo"
                  class="form-control"></textarea>
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