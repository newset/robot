<div>
	<div class="panel panel-default">
		<div class="panel-body" style="line-height: 40px;">
			归档时间： [:time:]
			<a ui-sref="base.mark.ck_mark_history" class="btn btn-default pull-right">返回</a>
		</div>
	</div>

	<p>[:detail.d.msg:]</p>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class="info">
				<th>医院</th>
				<th>医生名字</th>
				<th>历史归档</th>
				<th>本次归档</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="item in detail.d.data">
				<td>[:item.a:]</td>
				<td>[:item.b:]</td>
				<td>[:item.c:]</td>
				<td>[:item.d:]</td>
			</tr>
		</tbody>
	</table>
</div>