<div class="panel panel-default">
	<div class="panel-body text-right">
		<button type="button" class="btn btn-primary">保存</button>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
	   	<h5>用户配置</h5>
	   	<hr>
	   	<div class="row">
			<div class="col-md-6">
				<form action="" method="POST" role="form" class="form-inline">
				
					<div class="form-group">
						<label for="">登录保存时间</label>
						<input type="text" class="form-control" id="" placeholder="">
						<span>小时 (0为不保存，最大为240小时)</span>
					</div>
					<div class="form-group">
						<label for="">每页列表行数</label>
						<input type="text" class="form-control" id="" placeholder="">
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
							<input type="text" class="form-control" id="" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">医院的Mark存量在多少以内，会提示管理员</p>
						</label>
						<div class="col-md-2">
							<input type="text" class="form-control" id="" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">设备租赁到期，提前多少天发送站内信通知</p>
						</label>
						<div class="col-md-2">
							<input type="text" class="form-control" id="" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">多少天提醒一次该采集USB数据</p>
						</label>
						<div class="col-md-2">
							<input type="text" class="form-control" id="" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-md-8">
							<p class="text-left">USB数据当前密码</p>
						</label>
						<div class="col-md-3">
							<input type="text" class="form-control" id="" placeholder="">
						</div>
					</div>
				</form>
			</div>
		</div>
	   @endif
	</div>
</div>