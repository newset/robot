<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            代理商医院情况表
        </h3>
    </div>
    <div class="panel-body">
        <form action="/report/hospital__condition" method="post" id="report-form" class="form-horizontal">

            <div class="row">
                <div class="form-group">
                    <label class="col-md-1 control-label" for="agencyid">代理商</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" id="agencyid" placeholder="" name="agencyid"
                               ng-model="cond.agencyid" required>
                    </div>
                </div>
            </div>
            <div class="form-group text-right col-md-12">
                <button class="btn btn-primary" type="button" ng-click="query()">查询
                </button>
            </div>
        </form>
    </div>

    <div class="clearfix" id="report-result"></div>
</div>



