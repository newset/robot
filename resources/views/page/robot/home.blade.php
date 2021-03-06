<div>
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">
				待办事项
			</h3>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
						<th>提示信息</th>
						<th>编号</th>
						<th>设备状态</th>
						<th>销售状态</th>
						<th>医院</th>
						<th>代理商</th>
						<th>负责人</th>
						<th>维护记录</th>
						<th>生产日期</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data.s">
						<!-- <td>[:info(item):]</td> -->
						<td>租期快要结束</td>
						<td>[:item.cust_id:]</td>
						<td>[:SIns.robot_action_type[item.status].name:]</td>
						<td>[:SIns.lease_type[item.lease_type_id-1].name:]</td>
						<td>[:item.hospital_name:]</td>
						<td>[:item.agency_name:]</td>
						<td>[:item.employee_name:]</td>
						<td>[:item.log_count || 0:]</td>
						<td>[:item.production_date | laDate:]</td>
						<td class="text-center">
							<a ui-sref="base.robot.detail({id : item.id})" title="" class="btn btn-sm btn-primary">查看</a>
						</td>
					</tr>
					<tr ng-if="!data.s.length">
						<td colspan="10" class="text-center">暂无相关数据</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
						<th>提示信息</th>
						<th>编号</th>
						<th>设备状态</th>
						<th>销售状态</th>
						<th>医院</th>
						<th>代理商</th>
						<th>负责人</th>
						<th>维护记录</th>
						<th>生产日期</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data.c">
						<td>该采集USB数据</td>
						<td>[:item.cust_id:]</td>
						<td>[:SIns.robot_action_type[item.status].name:]</td>
						<td>
							<span ng-if="item.lease_type_id==-1">在库</span>
							<span ng-if="item.lease_type_id!=-1">[:SIns.lease_type[item.lease_type_id].name:]</span>
						</td>
						<td>[:item.hospital_name:]</td>
						<td>[:item.agency_name:]</td>
						<td>[:item.employee_name:]</td>
						<td>[:item.log_count || 0:]</td>
						<td>[:item.production_date | laDate:]</td>
						<td class="text-center">
							<a ui-sref="base.robot.detail({id : item.id})" title="" class="btn btn-sm btn-primary">查看</a>
						</td>
					</tr>
					<tr ng-if="!data.c.length">
						<td colspan="10" class="text-center">暂无相关数据</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
						<th>提示信息</th>
						<th>编号</th>
						<th>设备状态</th>
						<th>销售状态</th>
						<th>医院</th>
						<th>代理商</th>
						<th>负责人</th>
						<th>维护记录</th>
						<th>生产日期</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data.e">
						<td>USB数据导出错误</td>
						<td>[:item.cust_id:]</td>
						<td>[:SIns.robot_action_type[item.status].name:]</td>
						<td>
							<span ng-if="item.lease_type_id==-1">在库</span>
							<span ng-if="item.lease_type_id!=-1">[:SIns.lease_type[item.lease_type_id].name:]</span>
						</td>
						<td>[:item.hospital_name:]</td>
						<td>[:item.agency_name:]</td>
						<td>[:item.employee_name:]</td>
						<td>[:item.log_count || 0:]</td>
						<td>[:item.production_date | laDate:]</td>
						<td class="text-center">
							<a ui-sref="base.robot.detail({id : item.id})" title="" class="btn btn-sm btn-primary">查看</a>
						</td>
					</tr>
					<tr ng-if="!data.e.length">
						<td colspan="10" class="text-center">暂无相关数据</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>