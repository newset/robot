<section id="main-content" ng-controller="CPageEmployee">

    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-2">
                        <select chosen ng-model="SIns.cond.where.status" class="form-control">
                            <option value="">全部</option>
                            <option value="1">在职</option>
                            <option value="0">离职</option>
                        </select>
                    </div>
                    <div class="col-md-2 pull-right text-right">
                        <a class="btn btn-primary" ui-sref="base.employee.new">新建用户</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <table
                                id="example"
                                class="table
                               table-striped
                               table-bordered
                               dataTable
                               table-hover
                               no-footer"
                                cellspacing="0"
                                width="100%"
                                aria-describedby="example_info"
                                style="width: 100%;">
                            <thead>
                            <tr role="row" class="info">
                                <th>登录名</th>
                                <th>姓名</th>
                                <th>电话</th>
                                <th>Email</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td>[:row.username:]</td>
                                <td>[:row.name:]</td>
                                <td>[:row.phone || '-':]</td>
                                <td>[:row.email || '-':]</td>
                                <td class="edit col-md-2">
                                    <span class="tool_wrapper" ng-hide="row.username == 'admin'">
                                        <a class="btn btn-primary btn-sm" ui-sref="base.employee.new({id : row.id})" >
                                        编辑
                                        </a>
                                        <button class="btn btn-sm" href="" ng-class="{'btn-primary' : row.status, ' btn-default' : !row.status}"
                                                ng-click="toggle_status(row)">
                                            <span ng-if="row.status">设为离职</span>
                                            <span ng-if="!row.status">恢复</span>
                                        </button>
                                    </span>
                                </td>
                                {{--<td>[:row.updated_at:]</td>--}}
                            </tr>
                            </tbody>
                        </table>
                        <div class="pagination_wrapper" ng-init="pagination = SIns.cond.pagination || 1">
                            <span class="pull-left">记录: [:(pagination-1)* default_paginataion_limit +  (SIns.total_items/SIns.total_items) || 0:] / [:SIns.total_items || 0:]</span>

                            <pagination
                                    boundary-links="true"
                                    total-items="SIns.total_items"
                                    items-per-page="default_paginataion_limit"
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
</section>