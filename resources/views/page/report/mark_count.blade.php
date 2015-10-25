<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title">
				Mark情况统计表
			</h3>
		</div>
			<form action="/report/mark_count" method="post" id="report-form">
				<label class="pull-left" style="margin:10px 0 0 20px;">时间：从</label>
				<div class="col-md-2">
					<datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
						<input type="text" name="starttime" ng-model="cond.starttime" class="form-control">
					</datepicker>
				</div>
				<label class="pull-left" style="margin-top: 10px;">到</label>
				<div class="col-md-2">
					<datepicker date-format="yyyy-MM-dd 00:00:00" date-set="[:SIns.cu_bat_data.production_date:]">
						<input type="text" name="endtime" ng-model="cond.endtime" class="form-control">
					</datepicker>
				</div>
				<div class="form-group">
					<button  class="btn btn-primary" type="button" ng-click="query()">查询</button>
				</div>

			</form>
		<div class="clearfix" id="report-result"></div>
	</div>
</div>



