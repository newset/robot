<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-body">
      <h3 class="panel-title">
         新建设备
      </h3>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <form
            name="form_robot"
            ng-init="SEmployee.r({limit: 0}); SIns.current_row = {}"
            class="col-md-12 form-horizontal" style="float:none;">
  
          <div class="row">
            <div class="form-group col-md-6">
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
          </div>
  
          <div class="row">
            <div class="form-group col-md-6">
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
          </div>
          
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label col-md-2">生产日期</label>
              <div class="col-md-6">
                <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.current_row.production_date:]">
                  <input ng-model="SIns.current_row.production_date" type="text" class="form-control" required/>
                </datepicker>
              </div>
            </div>
          </div>

          <div class="form-group">
              <button type="submit" ng-click="save()" class="btn btn-info pull-right" ng-disabled="form_robot.$invalid">新建</button>
          </div>
      </form>
      
    </div>
  </div>
</div>