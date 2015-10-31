  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title" ng-if="!SIns.current_row.id">
         新建设备
      </h3>
      <h3 class="panel-title" ng-if="SIns.current_row.id">
         编辑设备信息
         <a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="pull-right"> 编号 : [:SIns.current_row.cust_id:]</a>
      </h3>
    </div>
    <div class="panel-body">
      <form
            name="form_robot"
            ng-init="SEmployee.r({limit: 0}); "
            class="col-md-12 form-horizontal" style="float:none;">

          <div class="row"  ng-if="!SIns.current_row.id">
            <div class="form-group">
              <label class="control-label col-md-1">编号</label>
              <div class="col-md-6 col-sm-12">
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
            <div class="form-group">
              <label class="control-label col-md-1">负责人</label>
              <div class="col-md-6">
                <select class="form-control"
                  ng-model="SIns.current_row.employee_id"
                  chosen
                  update="SEmployee.all"
                  ng-options="l.id as l.name for l in SEmployee.all">
                  <option value="">请选择</option>
                </select>
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
            <div class="form-group">
              <label class="control-label col-md-1">生产日期</label>
              <div class="col-md-6">
                <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.current_row.production_date || '{{date("Y-m-d",time())}}' :]" selector="form-control">
                      <input ng-model="SIns.current_row.production_date" type="text" class="form-control"/>
                </datepicker>
                <p ng-repeat="error in errors.production_date" class="text-danger">
                  [:error:]
                </p>
              </div>
            </div>
          </div>



          <div class="row" ng-if="SIns.current_row.id">
            <div class="form-group">
              <label for="" class="control-label col-md-1">状态</label>
              <div class="col-md-6">
                <label class="radio-inline"><input type="radio" value="0" ng-checked="SIns.current_row.status ==0"
                  ng-model="SIns.current_row.status" />正常</label>
                <label class="radio-inline"><input type="radio" value="2" ng-checked="SIns.current_row.status ==2"
                  ng-model="SIns.current_row.status" />作废</label>
              </div>
            </div>
          </div>
          <div class="form-group text-right col-md-12">
              <button type="submit" ng-click="save()" class="btn btn-info" ng-if="!SIns.current_row.id">新建</button>
              <a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="btn btn-default" ng-if="SIns.current_row.id">取消</a>
              <button type="submit" ng-click="save()" class="btn btn-info" ng-if="SIns.current_row.id">保存</button>
          </div>
      </form>

    </div>
  </div>