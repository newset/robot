<div class="col-md-12">

<form ng-submit="SIns.u(SIns.current_row)"
      name="form_mark_unbind"
      class="form-inline container" 
      ng-init="SAgency.get_all_rec();
      @if(he_is('employee'))
              SIns.cu_bat_data.agency_id = 1
      @elseif(he_is('agency'))
              SIns.cu_bat_data.hospital_id = 1
      @endif
              "
      ng-controller="CPageMark">
    {{--[:SIns.current_row:]--}}
    <div class="error form-group">
        <p class="error"
           ng-if="form_mark_unbind.mark_list.$error.laRowNumMatch && form_mark_unbind.mark_list.$touched">
            编号总数与行数不匹配</p>

        <p class="error" ng-if="form_mark_unbind.mark_list.$invalid && form_mark_unbind.$touched">请检查表单输入</p>
    </div>
    <div class="form-group pull-left">
        <label>Mark编号列表</label>
    </div>
    <div class="form-group pull-right">
        <label>Mark输入总数</label>
        <input ng-model="SIns.cu_bat_data.unbind_amount"
               class="form-control"
               type="number"
               name="unbind_amount"
               required>
    </div>
    <div class="form-group col-md-12">
        <textarea ng-model="SIns.cu_bat_data.mark_block"
                  class="form-control"
                  rows="10"
                  cols="180"
                  name="mark_list"
                  array-receiver="SIns.cu_bat_data.mark_list"
                  la-row-num-match="SIns.cu_bat_data.unbind_amount"
                  placeholder="每行一条Mark编号，行数需与总数相等，总数尽量不超过500条"
                  required>
            </textarea>
    </div>
    <div class="form-group pull-right">
        <button type="submit" class="btn btn-primary" ng-disabled="form_mark_unbind.$invalid">解除绑定</button>
    </div>
</form>
</div>