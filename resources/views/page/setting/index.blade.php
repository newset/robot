<div class="panel panel-default">
	<div class="panel-body text-right">
		<button type="button" class="btn btn-primary" ng-click="save()">保存</button>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
	   	<h5>用户配置</h5>
	   	<hr>
	   	<div class="row">
			<div class="col-md-6">
				<form action="" method="POST" role="form" class="form-inline" name="setting">
					<div class="form-group">
						<label for="">登录保存时间</label>
						<input type="number" class="form-control" name="session_expire" placeholder="" ng-model="settings.user.session_expire" min="1" max="240">
						<span>小时 (最小1小时, 最大为240小时)</span>
						<span ng-show="setting.session_expire.$error.max" class="text-danger">不能大于240小时</span>
						<span ng-show="setting.session_expire.$error.min" class="text-danger">不能小于1小时</span>
					</div>
					<div class="form-group">
						<label for="">每页列表行数</label>
						<input type="number" class="form-control" name="per_page" ng-model="settings.user.per_page">
					</div>
				</form>
			</div>
	   	</div>

		@if( he_is('employee') && username() == 'admin')
	   	<h5>系统配置</h5>
	   	<hr>
	   	<div class="row">
			<div class="col-md-6">
				<form action="" method="POST" role="form" class="form-horizontal">
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">代理商结束时间在多少天内，则显示“即将过期”标识</p>
						</label>
						<div class="col-md-2">
							<input type="number" class="form-control" name="agency_end" ng-model="settings.system.agency_end">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">租期结束时间在多少天内，则显示“租期快要结束”标识</p>
						</label>
						<div class="col-md-2">
							<input type="number" class="form-control" name="lease_end" ng-model="settings.system.lease_end">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">医院的Mark存量在多少以内，会提示管理员</p>
						</label>
						<div class="col-md-2">
							<input type="number" class="form-control" name="mark_storage" ng-model="settings.system.mark_storage">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">设备租赁到期，提前多少天发送站内信通知</p>
						</label>
						<div class="col-md-2">
							<input type="number" class="form-control" name="robot_end" ng-model="settings.system.robot_end">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">多少天提醒一次该采集USB数据</p>
						</label>
						<div class="col-md-2">
							<input type="number" class="form-control" name="collect_usb" ng-model="settings.system.collect_usb">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">USB数据当前密码</p>
						</label>
						<div class="col-md-3">
							<input type="text" class="form-control" name="usb_password" ng-model="settings.system.usb_password">
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<h5>邮件服务器配置</h5>
	   	<hr>
	   	<div class="row">
			<div class="col-md-6">
				<form action="" method="POST" role="form" class="form-horizontal">
					<div class="form-group">
						<label for="" class="control-label col-md-6">
							<p class="text-left">服务器地址</p>
						</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="server_address" ng-model="settings.email.server_address">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-6">
							<p class="text-left">服务器端口</p>
						</label>
						<div class="col-md-5">
							<input type="number" class="form-control" name="server_port" ng-model="settings.email.server_port">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-6">
							<p class="text-left">发件人账号</p>
						</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="server_account" ng-model="settings.email.server_account">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-6">
							<p class="text-left">发件人密码</p>
						</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="server_password" ng-model="settings.email.server_password">
						</div>
					</div>
				</form>
			</div>
		</div>
	   @endif
	</div>
</div>