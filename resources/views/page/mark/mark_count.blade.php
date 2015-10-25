<div class="panel container">
    <div class="panel-heading">
        <h3 class="panel-title">Mark情况统计表</h3>
    </div>
    <div class="panel-body">
    <form action="mark_count.php" method="post">
        <label class="pull-left" style="margin-top: 10px;">时间：从</label>
        <div class="col-md-2">
            <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                <input type="text" name="starttime" class="form-control">
            </datepicker>
        </div>
        <label class="pull-left" style="margin-top: 10px;">到</label>
        <div class="col-md-2">
            <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                <input type="text" name="endtime" class="form-control">
            </datepicker>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">查询</button>
        </div>
    </form>
</div>
</div>
