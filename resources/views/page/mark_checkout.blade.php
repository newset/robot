<section id="main-content" ng-controller="CPageMark" ng-init="SIns.include_archived = false;">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mark归档</h3>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                        </div>
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
                                    <th>医生</th>
                                @endif
                                <th>使用状态</th>
                                <th>操作</th>
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
                                    <td>[:row.doctor_name:]</td>
                                @endif
                                <td>
                                    <span ng-if="row.damaged_at">已损坏</span>
                                    <span ng-if="row.archive_at && !row.damaged_at">已归档</span>
                                    <span ng-if="row.used_at && !row.damaged_at && !row.archive_at">已使用</span>
                                    <span ng-if="!row.used_at && !row.damaged_at && !row.archive_at">未使用</span>
                                </td>
                                <td class="edit col-md-1">
                                    <span class="tool_wrapper">
                                        {{--<button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">--}}
                                        {{--编辑--}}
                                        {{--</button>--}}
                                        <button class="btn btn-default" href="" ng-click="SIns.cu({id: row.id, archive_at: Date.now()})">
                                            归档
                                        </button>
                                        @if(he_is('employee'))
                                            <span href="" class="curp delete"
                                                  ng-click="SIns.d(row.id)">删除</span>
                                        @endif
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

