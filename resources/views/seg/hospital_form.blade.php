<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_hospital"
      ng-controller="CPageHospital as cPageHospital">
    <div class="form-group">
        <label>名称</label>
        <input ng-model="SIns.current_row.name"
               class="form-control"
               required>
    </div>
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
                ng-options="l.id as l.name for l in SBase._.location.city | filter: {parent_id: SIns.current_row.province_id}"
                required>
            {{--<option value="">所在省份</option>--}}
        </select>
    </div>
    <div class="form-group">
        <label>详细地址</label>
        <input name="location_detail"
               ng-model="SIns.current_row.location_detail"
               class="form-control">
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