<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            Mark情况统计表
        </h3>
    </div>
    <div class="panel-body">
    <form action="/report/mark_count" method="post" id="report-form">
        {!! csrf_field() !!}
        <label class="col-md-1 control-label text-center" style="margin-top:10px;">时间</label>

        <div class="col-md-3">
            <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                <input type="text" name="starttime" ng-model="cond.starttime" class="form-control">
            </datepicker>
        </div>
        <label class="pull-left" style="margin-top: 10px;">到</label>

        <div class="col-md-3">
            <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                <input type="text" name="endtime" ng-model="cond.endtime" class="form-control">
            </datepicker>
        </div>
        <div class="form-group text-right col-md-12">
            <input class="btn btn-primary" type="submit" ng-click="query()" value="查询"/>
        </div>
    </form>
    </div>
    <div class="clearfix" id="report-result"></div>
</div>




