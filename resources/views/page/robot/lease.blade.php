<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title">
				修改设备租售状态
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
						<label class="control-label col-md-2">设置状态</label>
						<div class="col-md-6">
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="1">出租
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="2">出售
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="2">免费合作
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.action_type" value="2">返回库存
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-2">维修类型</label>
						<div class="col-md-6">
							<textarea name="" ng-model="data.memo" class="col-md-6 form-control" rows="12"></textarea>
						</div>
					</div>
				</div>

				<div class="form-group text-right">
					<a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="btn btn-default">取消</a>
					<button type="submit" ng-click="lease()" class="btn btn-info">设置</button>
			  	</div>
			</form>
		</div>
	</div>
</div>