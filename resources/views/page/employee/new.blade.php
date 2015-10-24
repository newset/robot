<div>
	<div class="panel panel-default">
		<div class="panel-body text-right">
			<a ui-sref="base.employee.list" class="btn btn-danger">取消</a>
			<button type="button" class="btn btn-primary" ng-click="save()">保存</button>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal" name="employee">
				<div class="form-group">
					<label class="control-label col-md-1">登录名</label>
					<div class="col-md-2">
						<input type="text" class="form-control" ng-model="SIns.current_row.username" ng-disabled="SIns.current_row.id">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-1">密码</label>
					<div class="col-md-2">
						<input type="password" class="form-control" ng-model="password">
						<input type="hidden" class="form-control" ng-model="SIns.current_row.password">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-1">真实姓名</label>
					<div class="col-md-2">
						<input type="text" class="form-control" ng-model="SIns.current_row.name">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-1">电话</label>
					<div class="col-md-2">
						<input type="text" class="form-control" ng-model="SIns.current_row.phone">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-1">Email</label>
					<div class="col-md-2">
						<input type="text" class="form-control" ng-model="SIns.current_row.email">
					</div>
				</div>
			</form>
			<br>
			<h4>权限</h4>
			<hr>
			<div class="col-md-8">
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 管理设备
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> Mark管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 代理商管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 医院管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 医生管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 病患管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 员工管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 查看日志
					</label>
				</div>
				<div class="col-md-4">
					<label for="" class="checkbox-inline">
						<input type="checkbox"> 系统设置
					</label>
				</div>
			</div>

		</div>
	</div>
</div>