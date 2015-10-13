<div class="">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-12">
				<h3 class="panel-title pull-left">设备信息</h3>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-left">
				 基本信息
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<dl class="dl-horizontal">
					<dt>编号</dt>
					<dd>[:SIns.current_row.cust_id:]</dd>
					<dt>状态</dt>
					<dd></dd>
					<dt>生产日期</dt>
					<dd>[:SIns.current_row.production_date | date : 'yyyy-MM-dd':]</dd>
					<dt>代理商</dt>
					<dd>[:SIns.current_row.last_agency.name:]</dd>
					<dt>医院</dt>
					<dd>[:SIns.current_row.last_hospital.name:]</dd>
					<dt>已用Mark</dt>
					<dd>[:SIns.current_row.employee.name:]</dd>
					<dt>负责人</dt>
					<dd>[:SIns.current_row.employee.name:]</dd>
					<dt>提示</dt>
					<dd>无</dd>
				</dl>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-left">
				维修记录
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
	
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-left">
				 租售记录
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
	
			</div>
		</div>
	</div>

</div>