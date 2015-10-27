<section id="main-content">
	<!--tiles start-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
						<div id="resultLog" class="form-group pull-left col-md-8" ng-init="SIns.mark_checkout_history()"></div>
						<div class="col-md-12"  >
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
								  <th>结账时间</th>
								  <th>Mark数量</th>
								  <th></th>
							  </tr>
							  </thead>
							  <tbody>
							  <tr class="odd"
								  ng-repeat="row in SIns.history_page_data | orderBy: row.archive_at ">
								  <td>[:row.archive_at:]</td>
								  <td>[:row.mark_count:]</td>
								  <td class="edit col-md-2">
                                    <span class="tool_wrapper">
                                        <button class="btn btn-primary btn-sm" ui-sref="base.mark.ck_mark_history_detail({time:row.archive_at})">
                                            查看
                                        </button>
                                    </span>
                                </td>
							  </tr>
							  </tbody>
						  </table>
						  <div class="row">
							  <div class="col-xs-6">
							  </div>
							  <div class="pagination_wrapper">
							     <pagination
										  boundary-links="true"
										  total-items="SIns.history_items"
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

