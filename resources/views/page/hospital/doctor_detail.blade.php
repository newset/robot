<div class="">
	<div class="panel">
		<div class="panel-heading">
		<h3 class="panel-title">医生详情</h3>
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
					<dt>姓名</dt>
					<dd>[:SIns.current_row.name:]</dd>
					<dt>医院</dt>
					<dd>[:SIns.current_row.hospital.name:]</dd>
					<dt>科室</dt>
					<dd>
					   <span ng-if="SIns.current_row.department_id == 0">无</span>
					   <span ng-if="SIns.current_row.department_id != 0">[:SIns.current_row.department.name:]</span>
					</dd>
					<dt>性别</dt>
					<dd>
					   <span ng-if="SIns.current_row.gender == 1">男</span>
					   <span ng-if="SIns.current_row.gender == 2">女</span>
					</dd>
					<dt>职务</dt>
					<dd>[:SIns.current_row.title:]</dd>
					<dt>等级</dt>
					<dd>[:SIns.current_row.level:]</dd>
					<dt>授权码</dt>
					<dd>[:SIns.current_row.cust_id:]</dd>
					<dt>电话</dt>
					<dd>[:SIns.current_row.phone:]</dd>
					<dt>Email</dt>
					<dd>[:SIns.current_row.email:]</dd>
					<dt>状态</dt>
					<dd>
					   <span ng-if="SIns.current_row.status == 0">正常未培训</span>
					   <span ng-if="SIns.current_row.status == 1">培训完毕未绑定微信</span>
					   <span ng-if="SIns.current_row.status == 2">绑定微信</span>
					   <span ng-if="SIns.current_row.status == -1">禁用</span>
					</dd>
					<dt>添加时间</dt>
					<dd>[:SIns.current_row.created_at | laDate:]</dd>
				</dl>
			</div>
			<div class="col-md-12">
				<a class="btn btn-primary pull-right" ui-sref="base.doctor.edit({id : SIns.current_row.id, hid: hospital.id})">修改</a>
			</div>
		</div>
	</div>

	<!-- <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-left">
				 Mark使用统计
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<dl class="dl-horizontal">
					<dt>累计使用Mark总数</dt>
					<dd>[:SIns.current_row.cust_id:]</dd>
					<dt>已归档Mark总数</dt>
					<dd>
						<span ng-if="SIns.current_row.lease_type_id == -1">进入库存</span>
						<span ng-if="SIns.current_row.lease_type_id == 1">出售</span>
						<span ng-if="SIns.current_row.lease_type_id == 2">出租</span>
						<span ng-if="SIns.current_row.lease_type_id == 3">免费合作</span>
					</dd>
					<dt>未归档Mark总数</dt>
					<dd>[:SIns.current_row.production_date | date : 'yyyy-MM-dd':]</dd>
					
				</dl>
			</div>
		</div>
	</div> -->
</div>