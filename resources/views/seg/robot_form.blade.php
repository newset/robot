<form ng-submit="SIns.cu_(SIns.current_row)"
      name="form_hospital"
      ng-init="SAgency.get_all_rec()"
      ng-controller="CPageRobot">
    <div class="form-group">
        <label>租售状态</label>
        {{--[:SIns.current_row:]--}}
        <select class="form-control"
                name="lease_type"
                ng-init="SIns.prepare_current_row()"
                ng-model="SIns.current_row.lease_type_id"
                ng-options="l.id as l.name for l in SIns.lease_type"
                required>
        </select>
        {{--<select class="form-control"--}}
                {{--name="province_id"--}}
                {{--ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"--}}
                {{--ng-model="SIns.current_row.province_id"--}}
                {{--ng-options="l.id as l.name for l in SBase._.location.province"--}}
                {{--required>--}}
    </div>
    <div class="form-group">
        <label>代理商</label>
        <select class="form-control"
                name="agency_id"
                ng-model="SIns.current_row.agency_id"
                ng-options="l.id as l.name for l in SAgency.all_rec | orderBy: 'id'"
                required>
       </select>
    </div>
    <div class="form-group">
        <label>医院</label>
        <select class="form-control"
                name="hospital_id"
                ng-model="SIns.current_row.hospital_id"
                ng-options="l.id as l.name for l in SHospital.all_rec | orderBy: 'id'"
                required>
       </select>
    </div>
    <div class="form-group">
        <label>起租时间</label>
        <input ng-model="SIns.current_row.lease_started_at"
               type="date"
               class="form-control"
               required>
        至
        <input ng-model="SIns.current_row.lease_ended_at"
               type="date"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div>
</form>