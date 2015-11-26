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
						<p ng-repeat="error in errors.username" class="text-danger">
						  [:error:]
						</p>
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
					<label for="permission0" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[0]" id="permission0"> 管理设备
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission1" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[1]" id="permission1"> Mark管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission2" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[2]" id="permission2"> 代理商管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission3" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[3]" id="permission3"> 医院管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission4" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[4]" id="permission4"> 医生管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission5" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[5]" id="permission5"> 病患管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission6" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[6]" id="permission6"> 员工管理
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission7" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[7]" id="permission7"> 查看日志
					</label>
				</div>
				<div class="col-md-4">
					<label for="permission8" class="checkbox-inline">
						<input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="SIns.current_row.permissions[8]" id="permission8"> 系统设置
					</label>
				</div>
			</div>

		</div>
	</div>
</div>