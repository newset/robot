<div class="panel panel-default">
	<div class="panel-body">
	   <form method="get" accept-charset="utf-8" class="form-inline">
			<div class="form-group">
				<div class="pull-left mr10" style="">
                    <datepicker date-format="yyyy-MM-dd" date-max-limit="[:SIns.cond.where.created_end:]" date-set="[:SIns.cond.where.created_start:]">
                        <input type="text" ng-model="SIns.cond.where.created_start" class="form-control">
                    </datepicker>
                </div>
                <span class="pull-left report-to mr10">到</span>
                <div class="pull-left mr10">
                    <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.cond.where.created_end:]" date-min-limit="[:SIns.cond.where.created_start:]">
                        <input type="text" ng-model="SIns.cond.where.created_end" class="form-control ">
                    </datepicker>
                </div>
                <input type="text" name="" value="" class="form-control" placeholder="关键字过滤">
                <button type="button" class="btn btn-primary pull-right">查看</button>
			</div>
	   </form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
	   <table class="table table-bordered">
	   	<thead>
	   		<tr>
	   			<th class="col-md-2">时间</th>
	   			<th>事件</th>
	   		</tr>
	   	</thead>
	   	<tbody>
	   		<tr ng-repeat="log in logs">
	   			<td ng-bind="log.at"></td>
	   			<td ng-bind="log.memo"></td>
	   		</tr>
	   	</tbody>
	   </table>
	</div>
</div>