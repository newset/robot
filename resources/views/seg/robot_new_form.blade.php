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
            ng-init="SEmployee.r({limit: 0}); "
            class="col-md-12 form-horizontal" style="float:none;">
  
          <div class="row"  ng-if="!SIns.current_row.id">
            <div class="form-group col-md-6">
              <label class="control-label col-md-2">编号</label>
              <div class="col-md-4 col-sm-12">
                <input class="form-control"
                     name="cust_id"
                     ng-model-options="{ updateOn: 'blur' }"
                     ng-model="SIns.current_row.cust_id"
                     >
                <p ng-repeat="error in errors.cust_id" class="text-danger">
                  [:error:]
                </p>
              </div>
              <label class="error" ng-if="form_robot.cust_id.$error.laExist">编号已存在</label>
            </div>
          </div>
  
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label col-md-2">负责人</label>
              <div class="col-md-4">
                <md-select ng-model="SIns.current_row.employee_id" class="" style="margin: 0px;">
                  <md-option ng-repeat="l in SEmployee.all" value="[:l.id:]">
                    [:l.name:]
                  </md-option>
                </md-select>
                <p ng-repeat="error in errors.employee_id" class="text-danger">
                  [:error:]
                </p>
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
                <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.current_row.production_date:]" selector="form-control">
                  <div class="input-group">
                      <input ng-model="SIns.current_row.production_date" type="text" placeholder="yyyy-MM-dd" class="form-control"/>
                  </div>
                </datepicker>
                <p ng-repeat="error in errors.production_date" class="text-danger">
                  [:error:]
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="" class="control-label col-md-2">状态</label>
              <div class="col-md-4">
                <label class="radio-inline"><input type="radio" value="0" ng-checked="SIns.current_row.status ==0"
                  ng-model="SIns.current_row.status" />正常</label>
                <label class="radio-inline"><input type="radio" value="2" ng-checked="SIns.current_row.status ==2"
                  ng-model="SIns.current_row.status" />作废</label>
              </div>
            </div>
          </div>
          <div class="form-group">
              <button type="submit" ng-click="save()" class="btn btn-info pull-right" ng-if="!SIns.current_row.id">新建</button>
              <button type="submit" ng-click="save()" class="btn btn-info pull-right" ng-if="SIns.current_row.id">保存</button>
          </div>
      </form>
      
    </div>
  </div>
</div>