<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">医生管理</h3>
        <div class="actions pull-right">
            <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#doctor_query" aria-expanded="false" aria-controls="collapseExample"></i>
        </div>
    </div>
    <div class="panel-body">
        <div role="grid" id="example_wrapper" class="dataTables_wrapper no-footer">
            <div class="col-md-12 search_panel" id="doctor_query">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="" class="control-label col-md-1">医院</label>
                        <div class="col-md-2">
                          <select 
                            class="form-control"
                            chosen
                            update="SIns.all_hospital"
                            ng-options="l.id as l.name for l in SIns.all_hospital"
                            ng-model="SIns.cond.where.hospital_id">
                              <option value="">请选择医院</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-1">姓名</label>
                        <div class="col-md-2">
                            <input class="form-control"
                               ng-model="SIns.cond.whereLike.name"
                               placeholder="姓名">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-1">手机</label>
                        <div class="col-md-2">
                            <input class="form-control"
                                   ng-model="SIns.cond.whereLike.phone"
                                   placeholder="手机">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info pull-right" ng-click="SIns.refresh()">查询</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row" ng-show="SIns.total_items!=undefined">
    <div class="col-md-12">
        <table
        id="example"
        class="table table-striped table-bordered dataTable no-footer table-hover"
        cellspacing="0"
        width="100%"
        aria-describedby="example_info"
        style="width: 100%;">
            <thead>
                <tr role="row" class="info">
                    <th>状态</th>
                    <th>医院</th>
                    <th>科室</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>职务</th>
                    <th>等级</th>
                    <th>授权码</th>
                    <th>电话</th>
                    <th>Email</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>

            <tr class="odd"
                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                <td ng-repeat="t in SIns.status_type | filter:{'id':  row.status}:true">
                    [:t.name:]
                </td>
                <td>[:row.hospital.name:]</td>
                <td>[:row.department.name:]</td>
                <td>[:row.name:]</td>
                <td>
                    <div ng-if="row.gender == 1">男</div>
                    <div ng-if="row.gender != 1">女</div>
                </td>
                <td>[:row.title:]</td>
                <td>[:row.level:]</td>
                <td>[:row.cust_id:]</td>
                <td>[:row.phone:]</td>
                <td>[:row.email:]</td>
                <td class="edit col-md-2">
                    <span class="tool_wrapper">
                        <button class="btn btn-primary btn-sm" href="">
                            编辑
                        </button>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div ng-if="!SIns.current_page_data.length" class="col-md-12">暂无结果</div>
    <div class="pagination_wrapper col-md-12">
        <span class="pull-left">记录: [:(SIns.cond.pagination+1-1)* SIns.items_per_page +  (SIns.total_items/SIns.total_items) || 0:] / [:SIns.total_items:]</span>

        <pagination max-size="10"
                    boundary-links="true"
                    total-items="SIns.total_items"
                    items-per-page="SIns.items_per_page"
                    ng-model="SIns.cond.pagination"
                    ng-change="SIns.change_page(SIns.cond.pagination)"
                    class="pagination-md"
                    previous-text="<<"
                    next-text=">>"
                    first-text="第一页"
                    items-per-page="5"
                    last-text="最后一页"
                >
        </pagination>
    </div>
</div>
