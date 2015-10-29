<div>
	<div class="panel panel-default">
		<div class="panel-body">
			经销商状态
		</div>
	</div>

	 <div class="panel panel-default">
	 	<div class="panel-body">
	 	   <table class="table table-bordered">
	 	   	<thead>
	 	   		<tr>
	 	   			<th class="col-md-1"></th>
	 	   			<th class="col-md-1">编号</th>
	 	   			<th class="col-md-2">名称</th>
	 	   			<th class="col-md-1">地区</th>
	 	   			<th class="col-md-1">代理状态</th>
	 	   			<th class="col-md-1">代理开始</th>
	 	   			<th class="col-md-1">代理结束</th>
	 	   			<th class="col-md-1"></th>
	 	   		</tr>
	 	   	</thead>
	 	   	<tbody>
	 	   		<tr ng-repeat="item in data">
	 	   			<td>[:info(item):]</td>
	 	   			<td>[:item.id:]</td>
	 	   			<td>[:item.name:]</td>
	 	   			<td>[:place('province', item.province_id) + '-' + place('city', item.city_id):]</td>
	 	   			<td>[:SIns.status(item):]</td>
	 	   			<td>[:item.started_at:]</td>
	 	   			<td>[:item.ended_at:]</td>
	 	   			<td class="text-center">
	 	   				<a href="" title="查看" class="btn btn-sm btn-primary" ui-sref="base.agency.detail({aid: item.id})">查看</a>
	 	   			</td>
	 	   		</tr>
	 	   	</tbody>
	 	   </table>
	 	</div>
	 </div>
</div>