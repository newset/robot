<div class="panel container">
    <div class="panel-heading">
        <div class="col-md-8 col-md-offset-2">
        <h3 class="panel-title">医院Mark使用情况表</h3>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-8 col-md-offset-2">
            <form action="hospital_mark_name.php" method="post"  class="form-horizontal">
                <div class="row">
                    <div class="form-group">
                    <label class="col-md-2 control-label">时间:</label>
                    <label class="pull-left" style="margin:5px 0 0 10px;">从</label>
                    <div class="col-md-3">
                        <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                            <input type="text" name="starttime" class="form-control">
                        </datepicker>
                    </div>
                    <label class="pull-left" style="margin-top: 5px;">到</label>
                    <div class="col-md-3">
                        <datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
                            <input type="text" name="endtime" class="form-control">
                        </datepicker>
                    </div>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="provinceid">省份id:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="provinceid"  placeholder="" name="provinceid" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cityid">城市id:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="cityid"  placeholder="" name="cityid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="agencyid">代理商id:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="agencyid"  placeholder="（可为空）" name="agencyid">
                        </div>
                    </div>
                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">查询</button>
                </div>
            </form>

        </div>

    </div>
</div>
