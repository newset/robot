<script type="text/ng-template" id="assign_doc.html">
	<div class="panel panel-default">
		<div class="panel-body">
		   <br>
		    <form action="" method="get" class="dialog-chosen" accept-charset="utf-8">
		    	<div class="form-group">
		    		<label for="">医生</label>
		    		<select 
		    			name="doctor" 
		    			ng-model="doctor_id" 
		    			chosen
		    			update="doctors" 
		    			ng-options="l.id as l.name for l in doctors" 
		    			class="form-control"
		    			>
		    			<option value="">请选择</option>
		    		</select>
		    	</div>
		    </form>
		    <br>
			<div class="panel-heading text-right">
				<button type="button" class="btn btn-primary" ng-click="save()">确定</button>
				<button type="button" class="btn btn-default" ng-click="close()">取消</button>
			</div>
		</div>
	</div>
</script>
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
					<tr ng-if="!data.length">
						<td colspan="9" class="text-center">暂无相关数据</td>
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
						<th class="col-md-2">使用时间</th>
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
					<tr ng-if="!marks.length">
						<td colspan="7" class="text-center">暂无相关数据</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>