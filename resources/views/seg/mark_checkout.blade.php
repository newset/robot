<section id="main-content">
	<!--tiles start-->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
						@if(he_is('agency'))
							<div class="row col-md-12 search_panel">
								<form class="form-horizontal" id="mark_query">
									<div class="form-group">
										<label class="control-label col-md-2">时间</label>
										 <div class="col-md-2">
										 <datepicker class="pull-left text-left" style="width:auto;" date-set="{{date('Y-m-d')}}"  date-format="yyyy-MM-dd">
        									<input ng-model="SIns.cu_bat_data.a"
        												 type="text"
        												 class="form-control"
        												 required>
        								</datepicker>
									  </div>
										  <button class="btn btn-info" style="float: right" ng-click="checkout()">生成结账清单</button>
									</div>
								</form>
							</div>
						@endif
						<div id="resultLog" class="form-group pull-left col-md-8"></div>
						<div class="col-md-12"  ng-show="current_page_data">
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
								  <th>医院</th>
								  <th>医生名字</th>
								  <th>历史结账</th>
								  <th>未结账</th>
							  </tr>
							  </thead>
							  <tbody>
							  <tr class="odd"
								  ng-repeat="row in current_page_data | orderBy: row.id ">
								  <td>[:row.a:]</td>
								  <td>[:row.b:]</td>
								  <td>[:row.c:]</td>
								  <td>[:row.d:]</td>
							  </tr>
							  </tbody>
						  </table>
						  <div class="row">
							  <div class="col-xs-6">
							  </div>
							  <div class="pagination_wrapper">
							     <button class="btn btn-info" style="float: right" ng-click="ck_mark()">确认归档</button>
							  </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

