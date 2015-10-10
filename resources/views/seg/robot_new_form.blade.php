<div class="panel container">
  <div class="panel-body">
    <form ng-submit="SIns.cu(SIns.current_row)"
          name="form_robot"
          ng-init="SEmployee.r({limit: 0}); SIns.current_row = {}"
          class="col-md-6 form-horizontal" style="float:none; margin:0 auto">
        <div class="form-group">
            <label class="control-label col-md-2">编号</label>
            <div class="col-md-6">
              <input class="form-control"
                   name="cust_id"
                   ng-model="SIns.current_row.cust_id"
                   la-exist="robot.cust_id"
                   required>
            </div>
            <label class="error" ng-if="form_robot.cust_id.$error.laExist">编号已存在</label>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">负责人</label>
            <div class="col-md-4">
              <md-select ng-model="SIns.current_row.employee_id" required class="" style="margin: 0px;">
                <md-option ng-repeat="l in SEmployee.all" value="[:l.id:]">
                  [:l.name:]
                </md-option>
              </md-select>
            </div>
            
           <!--  <select class="form-control"
                    name="province_id"
                    ng-model="SIns.current_row.employee_id"
                    ng-options="l.id as l.name for l in SEmployee.all"
                    required>
            </select> -->
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">生产日期</label>
            <div class="">
              <md-datepicker ng-model="SIns.current_row.production_date" md-placeholder="生产日期"></md-datepicker>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right" ng-disabled="form_hospital.$invalid">提交</button>
        </div>
    </form>
    
  </div>
</div>