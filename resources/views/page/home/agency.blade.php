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
		    			ng-options="l.id as l.name for l in doctors | filter:{status: '!0'}" 
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
		<div class="panel-heading">
			<h3 class="panel-title">代办事项
				<span class="pull-right" ng-class="{'text-danger': agency_status_danger}">[:agency_status:]</span>
			</h3>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<h4>设备</h4>
			<hr>

			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
						<th>提示信息</th>
						<th>编号</th>
						<th>设备状态</th>
						<th>销售状态</th>
						<th>医院</th>
						<th>负责人</th>
						<th>生产日期</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in data">
						<td>[:info(item):]</td>
						<td>[:item.cust_id:]</td>
						<td>[:SIns.robot_action_type[item.status].name:]</td>
						<td>
						  <span ng-if="item.lease_type_id==2">[:SIns.lease_type[item.lease_type_id].name:]([:item.lease_started_at | laDate:]至[:item.lease_ended_at | laDate:])
						  </span>
						  <span ng-if="item.lease_type_id!=2">[:SIns.lease_type[item.lease_type_id].name:]</span>
						</td>
						<td>[:item.hospital_name:]</td>
						<td>[:item.employee_name:]</td>
						<td>[:item.production_date:]</td>
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
			<h4>已使用未扫码的Mark列表</h4>
			<hr>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr class="info">
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
						<td>[:item.cust_id:]</td>
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