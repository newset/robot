<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title">
				添加设备维护信息
				<a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="pull-right"> 编号 : [:SIns.current_row.cust_id:]</a>
			</h3>
		</div>
	</div>

	<!-- body -->
	<div class="panel panel-default">
		<div class="panel-body">
			<form
				name="form_robot"
				ng-init="SEmployee.r({limit: 0}); "
				class="col-md-12 form-horizontal" style="float:none;">
					
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-1">维修类型</label>
						<div class="col-md-6">
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="1">USB数据导出损坏
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="2">客户报修
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="3">作废
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="4">维修完毕
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-1">备注信息</label>
						<div class="col-md-6">
							<textarea name="" ng-model="data.memo" class="col-md-6 form-control" rows="12"></textarea>
						</div>
					</div>
				</div>

				<div class="form-group text-right">
					<a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="btn btn-default">取消</a>
					<button type="submit" ng-click="save()" class="btn btn-info">保存</button>
			  	</div>
			</form>
		</div>
	</div>
</div>