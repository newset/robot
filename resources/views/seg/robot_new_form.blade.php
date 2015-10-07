<form ng-submit="SIns.cu(SIns.current_row)"
      name="form_robot"
      ng-init="SEmployee.r({limit: 0}); SIns.current_row = {}"
      ng-controller="CPageRobot"
      class="col-md-6" style="float:none; margin:0 auto">
    <div class="form-group">
        <label>编号</label>
        <input class="form-control"
               name="cust_id"
               ng-model="SIns.current_row.cust_id"
               la-exist="robot.cust_id"
               required>
        <label class="error" ng-if="form_robot.cust_id.$error.laExist">编号已存在</label>
    </div>
    <div class="form-group">
        <label>负责人</label>
        <select class="form-control"
                name="province_id"
                ng-model="SIns.current_row.employee_id"
                ng-options="l.id as l.name for l in SEmployee.all"
                required>
        </select>
    </div>
    <div class="form-group">
        <label>生产日期</label>
        <input ng-model="SIns.current_row.production_date"
               type="date"
               class="form-control"
               required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
    </div>
</form>