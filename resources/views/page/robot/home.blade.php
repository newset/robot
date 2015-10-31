<div>
	<div class="panel panel-default">
		<div class="panel-body">
			设备管理
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
						<th>提示信息</th>
						<th>编号</th>
						<th>状态</th>
						<th>销售状态</th>
						<th>医院</th>
						<th>代理商</th>
						<th>负责人</th>
						<th>维护记录</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data">
						<td>[:info(item):]</td>
						<td>[:item.cust_id:]</td>
						<td>[:SIns.robot_action_type[item.status].name:]</td>
						<td>[:SIns.lease_type[item.lease_type_id-1].name:]</td>
						<td>[:item.hospital_name:]</td>
						<td>[:item.agency_name:]</td>
						<td>[:item.employee_name:]</td>
						<td>[:item.log_count || 0:]</td>
						<td class="text-center">
							<a ui-sref="base.robot.detail({id : item.id})" title="" class="btn btn-sm btn-primary">查看</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>