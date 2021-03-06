<section id="main-content" ng-controller="CPageMark">
	<!--tiles start-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Mark管理</h3>
				</div>
				<div class="panel-body">
					<div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
						@if(!he_is('department'))
							<div class="row col-md-12 search_panel" ng-if="SIns.with_search">
								<h4>检索</h4>

								<form>
									<div class="form-group">
										<input class="form-control"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.id"
											   placeholder="编号">
									</div>
									{{--<div class="form-group">--}}
									{{--<input class="form-control"--}}
									{{--ng-model-options="{debounce: 300}"--}}
									{{--ng-model="SIns.cond.where_has.doctor.name"--}}
									{{--placeholder="名称搜索">--}}
									{{--</div>--}}
									<div class="form-group">
										<select class="form-control"
												name="status_type_id"
												ng-model="SIns.cond.where.status_type_id"
												ng-options="l.id as l.name for l in SIns.status_type">
											<option value="" selected>使用状态</option>
										</select>
									</div>
									@if(he_is('employee'))
										<div class="form-group">
											<select class="form-control"
													name="selling_status_type_id"
													ng-model="SIns.cond.where.selling_status_type_id"
													ng-options="l.id as l.name for l in SIns.selling_status_type">
												<option value="" selected>销售状态</option>
											</select>
										</div>
									@endif
									<div class="form-group">
										<input class="form-control"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.doctor_name"
											   placeholder="医生姓名">
									</div>
									<div class="form-group">
										<input class="form-control"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.hospital_name"
											   placeholder="医院名称">
									</div>
									<div class="form-group">
										<input class="form-control"
											   ng-model-options="{debounce: 300}"
											   ng-model="SIns.cond.where.agency_name"
											   placeholder="代理名称">
									</div>
									<div class="form-group">
										<label>出货时间</label>
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
										<label>卖出时间</label>
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
										<label>扫码时间</label>
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
										<label>损坏时间</label>
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
										<label>归档时间</label>
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
										<label>手术时间</label>
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
								</form>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="dataTables_length" id="example_length">
										@if(he_is('employee'))
											<button class="btn btn-default fr"
													ng-click="SIns.popup_mark_bind(null)">创建/绑定
											</button>
											<button class="btn btn-default fr"
													{{--ng-click="SIns.popup_mark_unbind(null)">导入数据--}}
													type="file"
													ngf-select="uploadFiles($file)"
													{{--accept="image/*"--}}
													ngf-max-size="10MB">
												导入数据
											</button>
										@endif
										<button class="btn btn-default fr"
												ng-click="SIns.popup_mark_update(null)">更新
										</button>
										@if(he_is('employee'))
											<button class="btn btn-default fr"
													ng-click="SIns.popup_mark_unbind(null)">解绑
											</button>
										@endif

									</div>
								</div>
							</div>
						@endif

						@if(he_is('department'))
							全院Mark库存：<span class="bold">[:SIns.marks_not_used:] </span>个
						@endif
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
								@endif
								@if(he_is('agency'))
									<th>医院</th>
								@endif
								@if(he_is('agency') || he_is('department'))
									<th>医生</th>
								@endif
								<th>使用状态</th>
								@if(!he_is('department'))
									<th>操作</th>
								@endif
							</tr>
							</thead>
							<tbody>
							<tr class="odd"
								ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
								<td>[:row.cust_id:]</td>
								@if(he_is('employee'))
									<td>
										<span ng-if="row.agency_id == 1">未卖出</span>
										<span ng-if="row.agency_id != 1">已卖出</span>
									</td>
								@endif
								@if(he_is('agency'))
									<td>[:row.hospital_name:]</td>
								@endif
								@if(he_is('agency') || he_is('department'))
									<td>[:row.doctor_name || '-' :]</td>
								@endif
								<td>
									<span ng-if="row.damaged_at">已损坏</span>
									<span ng-if="row.archive_at && !row.damaged_at">已归档</span>
									<span ng-if="row.used_at && !row.damaged_at && !row.doctor_id && !row.archive_at">已使用</span>
									<span ng-if="row.used_at && !row.damaged_at && row.doctor_id && !row.archive_at">已绑定</span>
									<span ng-if="!row.used_at && !row.damaged_at && !row.archive_at">未使用</span>
								</td>
								@if(!he_is('department'))
									<td class="edit col-md-2">
									<span class="tool_wrapper">
										{{--<button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">--}}
										{{--编辑--}}
										{{--</button>--}}
										<button class="btn btn-default"
												ng-click="SIns.h.popup_detail(row, SIns, 'agency/r', {relation: ['robotLeaseLog', 'mark', 'hospital'], where: {id: row.id}})">
											详细
										</button>
										<button class="btn btn-default" ng-click="SIns.popup_edit(row)"
												@if(he_is('agency'))
												ng-if="row.used_at && !row.damaged_at && !row.archive_at && !row.doctor_id"
													@endif
												>
											编辑
										</button>
										@if(he_is('employee'))
											<span class="curp delete"
												  ng-click="SIns.d(row.id)">删除</span>
										@endif
									</span>
									</td>
								@endif
								{{--<td>[:row.updated_at:]</td>--}}
							</tr>
							</tbody>
						</table>
						<div class="row">
							<div class="col-xs-6">
							</div>
							<div class="pagination_wrapper">
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
</section>

