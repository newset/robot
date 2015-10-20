<div class="panel container">
  <div class="panel-body">
    <form
          name="form_mark_new"
          class="form-inline" 
          ng-init="SAgency.get_all_rec();
          @if(he_is('employee'))
                  SIns.cu_bat_data.agency_id = 1
          @elseif(he_is('agency'))
                  SIns.cu_bat_data.hospital_id = 1
          @endif
                  "
          >
        <div class="form-group">
            {{--[:SIns.current_row:]--}}
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                      <label>Mark编号列表</label>
                    </div>
                    <div class="col-md-4 pull-right text-right">
                        <label>Mark输入总数</label>
                        <input ng-model="SIns.cu_bat_data.a"
                               class="form-control"
                               type="text"
                               name="new_amount"
                               required>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label class="pull-left" style="margin-top: 10px;">生产日期</label>
                        <div class="col-md-2">
                          <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.cu_bat_data.production_date:]">
                            <input type="text" ng-model="SIns.cu_bat_data.c" class="form-control">
                          </datepicker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <textarea ng-model="SIns.cu_bat_data.b"
                          class="form-control mt20"
                          rows="12"
                          name="mark_list"
                          style="width:100%" 
                          array-receiver="SIns.cu_bat_data.mark_list"
                          la-row-num-match="SIns.cu_bat_data.a"
                          placeholder="每行一条Mark编号，行数需与总数相等，总数尽量不超过1000条"
                          required>
                    </textarea>
            </div>
        </div>
        <div class="form-group" id="resultLog">
        
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info pull-right" ng-click="add()">提交</button>
        </div>
    </form>
    
  </div>
</div>