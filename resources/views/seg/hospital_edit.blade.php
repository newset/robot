<div class="col-md-offset-2 col-md-8">
    <div class="container panel-default panel" style="padding:0px">
        <div class="panel-heading">
            <h3 class="panel-title">编辑医院</h3>
        </div>
        <div class="panel-body">
            <form ng-submit="SIns.cu(SIns.current_row)"
                  name="form_hospital"
                  class="form-horizontal"
            >
                <div class="form-group">
                    <label class="control-label col-md-3">医院名称</label>
                    <div class="col-md-8">
                        <input ng-model="SIns.current_row.name"
                               class="form-control"
                               required>
                    </div>
                </div>
                <div class="form-group md-select-group">
                    <label class="control-label col-md-3">所在省市</label>
                    <div class="col-md-2">
                        <select name="province_id" 
                            chosen 
                            class="form-control" 
                            update="SBase._.location.province"
                            ng-model="SIns.current_row.province_id" 
                            ng-options="l.id as l.name for l in SBase._.location.province">
                            <option value="">所在省份</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="city_id" 
                            chosen 
                            class="form-control" 
                            update="SIns.current_row.province_id" 
                            ng-model="SIns.current_row.city_id" 
                            ng-options="l.id as l.name for l in SIns.current_row.province_id&&SBase._.location.city|| []| filter: {parent_id: SIns.cond.where.province_id}:true">
                            <option value="">所在城市</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">详细地址</label>
                    <div class="col-md-8">
                        <input name="location_detail"
                               ng-model="SIns.current_row.location_detail"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">备注</label>
                    <div class="col-md-8">
                        <textarea name="memo"
                                  ng-model="SIns.current_row.memo"
                                  class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-8">
                        <button  class="btn btn-primary  pull-right" ng-disabled="form_hospital.$invalid" ng-click="SIns.cu(hospital)">提交</button>
                    </div>
            </form>
                </div>
                {{-- <div class="panel-footer" ng-controller="CPageHospital as cPageHospital">
                <button  class="btn  pull-right" ng-disabled="form_hospital.$invalid" ng-click="SIns.cu(SIns.current_row)">提交</button>
                </div> --}}
        </div>
    </div>
