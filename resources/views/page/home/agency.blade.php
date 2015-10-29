<div>
	<div class="panel panel-default">
		<div class="panel-body">
			代办事项
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<h4>设备</h4>
			<hr>

			<table class="table table-bordered">
				<thead>
					<tr>
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
						<td>[:SIns.lease_type[item.lease_type_id].name:]</td>
						<td>[:item.agency_name:]</td>
						<td>[:item.hospital_name:]</td>
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

	<div class="panel panel-default">
		<div class="panel-body">
			<h4>Mark</h4>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="col-md-2">Mark编号</th>
						<th class="col-md-1">状态</th>
						<th>医院</th>
						<th class="col-md-1">医生</th>
						<th class="col-md-1">销售时间</th>
						<th class="col-md-1">使用时间</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in marks">
						<td>[:item.id:]</td>
						<td>[:SMark.status_type[item.status-1].name:]</td>
						<td>[:item.hospital_name:]</td>
						<td ng-if="item.doctor_id">[:item.doctor_name:]</td>
						<td ng-if="!item.doctor_id">
							<a href="" title="设定" ng-click="set_doctor(item)" class="btn btn-sm btn-info">设定</a>
						</td>
						<td>[:item.sold_at|laDate:]</td>
						<td>[:item.used_at| laDate: 'yyyy-MM-dd hh:mm' :]</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>