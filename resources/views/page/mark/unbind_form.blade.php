<div class="panel container">
  <div class="panel-body">
    <form
          name="form_mark_unbind"
          class="form-inline" 
          ng-init="SAgency.get_all_rec();
          @if(he_is('employee'))
              SIns.cu_bat_data.agency_id = 1
          @elseif(he_is('agency'))
              SIns.cu_bat_data.hospital_id = 1
          @endif
                  ">
        {{--[:SIns.current_row:]--}}
       
        <div class="form-group pull-left">
            <label>Mark编号列表</label>
        </div>
        <div class="form-group pull-right">
            <label>Mark输入总数</label>
            <input ng-model="SIns.cu_bat_data.a"
                   class="form-control"
                   type="text"
                   name="unbind_amount"
                   required>
        </div>
        <div class="form-group">
            <textarea ng-model="SIns.cu_bat_data.b"
                      class="form-control mt20"
                      rows="10"
                      cols="175"
                      style="width:100%" 
                      name="mark_list"
                      array-receiver="SIns.cu_bat_data.mark_list"
                      placeholder="每行一条Mark编号，行数需与总数相等，总数尽量不超过1000条"
                      required>
                </textarea>
        </div>
        <div class="form-group" id="resultLog">
        
        </div>
        <div class="form-group pull-right">
          @if(he_is('employee'))
            <button type="submit" class="btn btn-info" ng-click="unbind()">解除绑定</button>
          @elseif(he_is('agency'))
            <button type="submit" class="btn btn-info" ng-click="unbind('a')">解除绑定</button>
          @endif
        </div>
    </form>

  </div>
</div>