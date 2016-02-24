<div>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-body">
			<div class="col-md-2 pull-left">
				<select name="" chosen class="form-control" style="width:150px" ng-model="toMe" data-placeholder="接收的消息">
					<option value="1" ng-selected="toMe == 1">接收的消息</option>
					<option value="0" ng-selected="toMe == 0">发送的消息</option>
				</select>
			</div>
			
			<a ui-sref="base.pm.new" title="" class="btn btn-primary pull-right">发送站内信</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr class="info">
						<th class="col-md-1">
							
						</th>
						<th class="col-md-1 no-animate" ng-if="toMe == 1">发件人</th>
						<th class="col-md-1 no-animate" ng-if="toMe == 0">收件人</th>
						<th class="col-md-2">时间</th>
						<th class="col-md-2">内容</th>
						<th class="col-md-1 text-center"></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in messages.main" ng-show="!loading">
						<td class="text-center">
							<span ng-if="!item.read" class="text-primary no-animate"><i class="fa fa-circle"></i></span>
						</td>
						<td class="col-md-1 no-animate" ng-show="toMe == 1">[:item.org:]</td>
						<td class="col-md-1 no-animate" ng-show="toMe == 0">[:item.recipientname:]</td>
						<td>[:item.sendtime:]</td>
						<td ng-bind="item.messagecontent | trim |limitTo: 60 | unBreak"></td>
						<td class="text-center">
							<a href="" class="btn btn-primary btn-sm" ng-click="read(item)">查看</a>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="pagination_wrapper" ng-init="pagination = 1">
            	<span class="pull-left">记录: [:(pagination-1)*default_paginataion_limit+(messages.count&&1):] / [:messages.count:]</span>

			  	<pagination
					  boundary-links="true"
					  total-items="messages.count"
					  items-per-page="default_paginataion_limit"
					  ng-model="pagination"
					  ng-change="getMessage();"
					  class="pagination-md"
					  rotate="false"
					  max-size="10"
					  previous-text="<"
					  next-text=">"
					  first-text="第一页"
					  last-text="最后一页"
					  >
			  </pagination>
		  </div>
		</div>
	</div>

</div>