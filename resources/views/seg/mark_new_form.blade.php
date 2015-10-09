<div class="panel container">
  <div class="panel-body">
    <form ng-submit="SIns.u(SIns.current_row)"
          name="form_mark_unbind"
          class="form-inline" 
          ng-init="SAgency.get_all_rec();
          @if(he_is('employee'))
                  SIns.cu_bat_data.agency_id = 1
          @elseif(he_is('agency'))
                  SIns.cu_bat_data.hospital_id = 1
          @endif
                  "
          ng-controller="CPageMark">
        <div class="form-group">
            {{--[:SIns.current_row:]--}}
            <div class="error form-group">
                <p class="error"
                   ng-if="form_mark_unbind.mark_list.$error.laRowNumMatch && form_mark_unbind.mark_list.$touched">
                    编号总数与行数不匹配</p>

                <p class="error" ng-if="form_mark_unbind.mark_list.$invalid && form_mark_unbind.$touched">请检查表单输入</p>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                      <label>Mark编号列表</label>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label>Mark输入总数</label>
                        <input ng-model="SIns.cu_bat_data.unbind_amount"
                               class="form-control"
                               type="number"
                               name="unbind_amount"
                               required>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label class="pull-left" style="margin-top: 10px;">生产日期</label>
                        <md-datepicker ng-model="SIns.cu_bat_data.production_date" md-placeholder="生产日期"></md-datepicker>
                    </div>
                    
                </div>

            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <textarea ng-model="SIns.cu_bat_data.mark_block"
                          class="form-control"
                          rows="12"
                          name="mark_list"
                          style="width:100%" 
                          array-receiver="SIns.cu_bat_data.mark_list"
                          la-row-num-match="SIns.cu_bat_data.unbind_amount"
                          placeholder="每行一条Mark编号，行数需与总数相等，总数尽量不超过500条"
                          required>
                    </textarea>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right" ng-disabled="form_mark_unbind.$invalid">提交</button>
        </div>
    </form>
    
  </div>
</div>