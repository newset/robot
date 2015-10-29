<section id="main-content">
	<!--tiles start-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">查询条件</h3>
					<div class="actions pull-right">
						<i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#mark_query" aria-expanded="false" aria-controls="collapseExample"></i>
					</div>
				</div>
				<div class="panel-body">
					<div role="grid" id="example_wrapper" class="dataTables_wrapper no-footer">
						@if(!he_is('department'))
							<div class="row col-md-12 search_panel" ng-if="SIns.with_search">
								<form class="form-horizontal" id="mark_query">
									<div class="form-group">
										<label class="control-label col-md-2">编号</label>
										<div class="col-md-2">
											<input class="form-control"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.cust_id"
											   placeholder="编号">
										</div>

									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Mark状态</label>
										<div class="col-md-5" ng-init="SIns.cond.where.status=[]">
											<label class="checkbox-inline" ng-repeat="type in SIns.status_type"><input type="checkbox" value="[:type.id:]" multi-check holder="SIns.cond.where.status">[:type.name:]</label>
										</div>
									</div>
									@if(he_is('employee'))
										<div class="form-group" ng-init="SIns.cond.where.sold=[]">
											<label class="control-label col-md-2">销售状态</label>
											<div class="col-md-4">
												<label class="checkbox-inline"><input type="checkbox" value="1" ng-true-value="1" multi-check holder="SIns.cond.where.sold">在库</label>
												<label class="checkbox-inline"><input type="checkbox" value="2" ng-true-value="2" multi-check holder="SIns.cond.where.sold">出货(卖给代理商)</label>
												<label class="checkbox-inline"><input type="checkbox" value="4" ng-true-value="4" multi-check holder="SIns.cond.where.sold">已售(卖给医院)</label>
											</div>
										</div>
									@endif
									@if(he_is('agency'))
									   <div class="form-group" ng-init="SIns.cond.where.sold=[]">
											<label class="control-label col-md-2">销售状态</label>
											<div class="col-md-2">
												<label class="checkbox-inline"><input type="checkbox" value="1" ng-true-value="1" multi-check holder="SIns.cond.where.sold">在销售</label>
												<label class="checkbox-inline"><input type="checkbox" value="2" ng-true-value="2" multi-check holder="SIns.cond.where.sold">已销售</label>
											</div>
										</div>
										<div class="form-group" ng-init="SIns.cond.where.archive=[]">
											<label class="control-label col-md-2">归档状态</label>
											<div class="col-md-2">
												<label class="checkbox-inline"><input type="checkbox" value="1" ng-true-value="1" multi-check holder="SIns.cond.where.archive">已归档</label>
												<label class="checkbox-inline"><input type="checkbox" value="2" ng-true-value="2" multi-check holder="SIns.cond.where.archive">未归档</label>
											</div>
										</div>
									@endif
									@if(!he_is('agency'))
									<div class="form-group">
										<label class="control-label col-md-2">代理商</label>
										 <div class="col-md-2">
										 <select 
									 		chosen
									 		class="form-control" 
									 		ng-options="l.id as l.name for l in SAgency.all_rec"
									 		ng-model="SIns.cond.where.agency_id">
									 		<option value="">不限</option>
									 	</select>
									  </div>
									</div>
									@endif
									<div class="form-group row">
										<label class="control-label col-md-2">医院</label>
										 <div class="col-md-2">
										 	<select 
										 		chosen
										 		class="form-control" 
										 		ng-options="l.id as l.name for l in SHospital.all_rec"
										 		ng-model="SIns.cond.where.hospital_id">
										 		<option value="">不限</option>
										 	</select>
									  </div>
									</div>

								<!--     <div class="form-group">
										<label class="control-label col-md-2">出货给代理商时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_created_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_created_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">卖出给医院时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_sold_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_sold_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">医生扫码时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_used_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_used_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">损坏时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_damaged_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_damaged_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">归档时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_archive_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_archive_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">手术时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.from_surgery_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.to_surgery_at"
											   placeholder="">
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">生产时间</label>
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.create_at"
											   placeholder="">
										至
										<input class="form-control"
											   type="date"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.create_at"
											   placeholder="">
									</div> -->

									<div class="form-group">
										<button class="btn btn-info" style="float: right" ng-click="SIns.refresh()">查询</button>
									</div>
								</form>
							</div>
						@endif
						@if(he_is('department'))
							全院Mark库存：<span class="bold">[:SIns.marks_not_used:] </span>个
						@endif
						<div class="col-md-12" ng-show="SIns.total_items!=undefined">
						  <table
								  id="example"
								  class="table
								 table-striped
								 table-bordered
								 table-hover
								 dataTable
								 no-footer"
								  cellspacing="0"
								  width="100%"
								  aria-describedby="example_info"
								  style="width: 100%;">
							  <thead>
							  <tr role="row" class="info">
								  <th>编号</th>
								  @if(he_is('employee'))
									  <th>销售状态</th>
								  	  <th>使用状态</th>
									  <th>操作</th>
								  @endif
								  @if(he_is('agency'))
								  	  <th>状态</th>
									  <th>医院</th>
									  <th>医生</th>
								      <th>销售时间</th>
								      <th>后续Mark编号</th>
								  @endif
							  </tr>
							  </thead>
							  <tbody>
							  <tr class="odd"
								  ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
								  <td>[:row.cust_id:]</td>
								  @if(he_is('employee'))
									  	<td>
											<span ng-if="row.agency_id==-1 && row.hospital_id==-1">在库</span>
						                	<span ng-if="row.agency_id!=-1 && row.hospital_id==-1">出货</span>
						                	<span ng-if="row.hospital_id != -1">已售</span>
							  		  	</td>
										<td>
										  <span ng-if="row.status == 1">未使用</span>
										  <span ng-if="row.status == 2">使用完毕</span>
										  <span ng-if="row.status == 3">已绑定</span>
										  <span ng-if="row.status == 4">损坏报废</span>
										  <span ng-if="row.status == 5">损坏更换</span>
									  	</td>
									  	<td class="edit col-md-2">
										  <span class="tool_wrapper">
											  
												 <a class="btn btn-default btn-sm" ui-sref="base.mark.show({id : row.id})">
												  查看
												  </a>
												   
										  </span>
									  	</td>
								  @endif
								  @if(he_is('agency'))
									  <td>
										  <span ng-if="row.status == 1">未使用</span>
										  <span ng-if="row.status == 2">使用完毕</span>
										  <span ng-if="row.status == 3">已绑定</span>
										  <span ng-if="row.status == 4">损坏报废</span>
										  <span ng-if="row.status == 5">损坏更换</span>
									  </td>
									  <td>[:row.hospital_name:]</td>
									  <td>[:row.doctor_name || '-' :]</td>
								      <td>[:row.sold_at:]</td>
								      <td>[:row.cmid:]</td>
								  @endif
							  </tr>
							  </tbody>
						  </table>
						  <div class="">
							  <div class="pagination_wrapper">
								  
                                	<span class="pull-left">记录: [:(SIns.cond.pagination||1)*SIns.items_per_page-SIns.items_per_page+(SIns.total_items&&1):] / [:SIns.total_items:]</span>

								  	<pagination
										  boundary-links="true"
										  total-items="SIns.total_items"
										  items-per-page="SIns.items_per_page"
										  ng-model="SIns.cond.pagination"
										  ng-change="SIns.change_page(SIns.cond.pagination)"
										  class="pagination-md"
										  rotate="false"
										  max-size="10"
										  previous-text="<"
										  next-text=">"
										  first-text="第一页"
										  {{--items-per-page="5"--}}
										  last-text="最后一页"
										  >
								  </pagination>
							  </div>
						  </div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

