<form ng-submit="SIns.cu(SIns.current_row_copy)"
      name="form_hospital"
      ng-init="SDoctor.get_all_rec();
      SIns.current_row_copy.id = current_row.id;
      SIns.current_row_copy.agency_id = current_row.agency_id;
      SIns.current_row_copy.hospital_id = current_row.hospital_id;
      SIns.current_row_copy.doctor_id = current_row.doctor_id;"
      ng-controller="CPageMark">
    <div class="form-group">
        <div class="form-group">
            <label>医生</label>
            <select class="form-control"
                    name="doctor_id"
                    ng-init="SIns.current_row.doctor_id = SIns.current_row.doctor_id || options[0].id"
                    ng-model="SIns.current_row_copy.doctor_id"
                    ng-options="l.id as l.name for l in SDoctor.all_rec"
                    required>
                {{--<option value="">所在省份</option>--}}
            </select>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div>
</form>