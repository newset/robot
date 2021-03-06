<div class="panel container">
  <div class="panel-body">
      
    <form 
          name="form_mark_bind"
          class="form-inline" >
        @if(he_is('agency'))
            <input type="hidden" ng-init="SIns.cu_bat_data.agency_id = {{uid()}}">
        @elseif(he_is('employee'))
            <input type="hidden" ng-init="SHospital.get_all_rec()">
        @endif

        {{--[:SIns.current_row:]--}}
       
        <div class="form-group pull-left">
            <label class="control-label">Mark编号列表</label>
        </div>
        <div class="form-group pull-right">
            <label class="control-label">Mark输入总数</label>
            <input ng-model="SIns.cu_bat_data.a"
                   class="form-control"
                   type="text"
                   name="bind_amount"
                   required>
        </div>
        <div class="form-group">
            <textarea ng-model="SIns.cu_bat_data.b"
                      class="form-control col-md-12 mt20"
                      rows="10"
                      name="mark_list"
                      style="width:100%" 
                      cols="175"
                      array-receiver="SIns.cu_bat_data.mark_list"
                      placeholder="每行一条Mark编号，行数需与总数相等，总数尽量不超过1000条"
                      required>
                </textarea>
        </div>
        <div class="form-group pull-left col-md-8" id="resultLog">
        
        </div>
        @if(he_is('employee'))
            <div class="form-group pull-right">
                <select class="form-control"
                        name="agency_id"
                        ng-model="targetSelected"
                        chosen
                        ng-change="SIns.cu_bat_data.c = targetSelected.id"
                        data-placeholder="请选择代理商"
                        update="agencys"
                        ng-options="l as l.name for l in agencys | orderBy: 'id'"
                        style="width: 200px"
                        required>
                </select>
                <label class="control-label">
                  <button type="submit" class="btn btn-info" ng-click="bind()">绑定</button>
                </label>
            </div>
        @endif
        @if(he_is('agency'))
            <div class="form-group pull-right">
                <label class="control-label">
                  <button type="submit" class="btn btn-info" ng-click="bind('a')">绑定</button>
                </label>
                <select class="form-control"
                        name="agency_id"
                        chosen
                        data-placeholder="请选择医院"
                        ng-model="targetSelected"
                        ng-change="SIns.cu_bat_data.c = targetSelected.id"
                        ng-options="l as l.name for l in SHospital.all_rec | orderBy: 'id'"
                        style="width: 200px" 
                        required>
                </select>
            </div>
        @endif
    </form>
  </div>
</div>
