<div class="panel panel-default">
    <div class="panel-body">
        <h3 class="panel-title">
            医生Mark使用情况表
        </h3>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <form action="/report/doctor_mark" method="post" id="report-form" class="form-horizontal">
            <div class="row">
                {!! csrf_field() !!}
                <label class="col-md-2 control-label">时间：</label>
                <label class="pull-left report-from"></label>
                <div class="col-md-3">
                    <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                        <input type="text" name="starttime" ng-model="cond.starttime" class="form-control">
                    </datepicker>
                </div>
                <label class="pull-left report-to">到</label>
                <div class="col-md-3">
                    <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                        <input type="text" name="endtime" ng-model="cond.endtime" class="form-control">
                    </datepicker>
                </div>
            </div>

            <div class="row">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="provinceid">省份</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="provinceid"  placeholder="" name="provinceid" ng-model="cond.provinceid" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cityid">城市</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="cityid"  placeholder="" name="cityid" ng-model="cond.cityid" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="hospitalid">医院</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="hospitalid"  placeholder="" name="hospitalid" ng-model="cond.hospitalid" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="agencyid">代理商</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="agencyid"  placeholder="（可为空）" name="agencyid" ng-model="cond.agencyid" required>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <button  class="btn btn-primary pull-right

                    " type="button" ng-click="query()">查询</button>
            </div>
        </form>
    </div>

    <div class="clearfix" id="report-result"></div>
</div>



