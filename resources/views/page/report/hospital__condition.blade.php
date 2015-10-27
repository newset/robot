<div class="panel panel-default">
    <div class="panel-body">
        <h3 class="panel-title">
            代理商医院情况表
        </h3>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <form action="/report/hospital__condition" method="post" id="report-form" class="form-horizontal">

            <div class="row">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="agencyid">代理商id:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="agencyid"  placeholder="" name="agencyid" ng-model="cond.agencyid" required>
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



