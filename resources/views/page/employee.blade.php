<section id="main-content" ng-controller="CPageEmployee">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">员工管理</h3>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dataTables_length" id="example_length">
                                    <button class="btn btn-default fr"
                                            ng-click="SIns.popup_edit(null)">创建
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table
                                id="example"
                                class="table
                               table-striped
                               table-bordered
                               dataTable
                               no-footer"
                                cellspacing="0"
                                width="100%"
                                aria-describedby="example_info"
                                style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>登录名</th>
                                <th>姓名</th>
                                <th>电话</th>
                                <th>Email</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-hide="row.username == 'admin'"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td>[:row.username:]</td>
                                <td>[:row.name:]</td>
                                <td>[:row.phone || '-':]</td>
                                <td>[:row.email || '-':]</td>
                                <td class="edit col-md-2">
                                    <span class="tool_wrapper">
                                        {{--<button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">--}}
                                        {{--编辑--}}
                                        {{--</button>--}}
                                        <button class="btn btn-default" href=""
                                                ng-click="SIns.popup_reset_pass()">
                                            重置密码
                                        </button>
                                        {{--<button class="btn btn-default" href=""--}}
                                                {{--ng-click="SIns.h.popup_detail(row, SIns, 'agency/r', {relation: ['robotLeaseLog', 'mark', 'hospital'], where: {id: row.id}})">--}}
                                            {{--设置权限--}}
                                        {{--</button>--}}
                                        <button class="btn btn-default" href=""
                                                ng-click="SIns.cu({id: row.id, status: !row.status})">
                                            <span ng-if="row.status">设为离职</span>
                                            <span ng-if="!row.status">恢复职位</span>
                                        </button>
                                        <span href="" class="curp delete"
                                              ng-click="SIns.d(row.id)">删除</span>
                                    </span>
                                </td>
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