<div class="container panel-default panel" style="padding:0px">
    <div class="panel-heading">
        <h3 class="panel-title">[:SIns.current_row.name:]</h3>
    </div>
    <div class="panel-body">
        <form ng-submit="SIns.cu(SIns.current_row)"
              name="memo_hospital"
              class="form-horizontal"
              ng-controller="CPageHospital as cPageHospital">
            <div class="form-group">
                <label class="control-label col-md-3">名称</label>
                <div class="col-md-8">
                    <input ng-model="SIns.current_row.name"
                       class="form-control"
                       required>
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

        </form>
    </div>
</div>
