<section id="main-content" ng-controller="CPageRobot">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">设备管理</h3>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel">
                            <h4>检索</h4>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-3">编号</label>
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.cust_id"
                                           placeholder="编号">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">地区</label>
                                    <select class="form-control"
                                            name="province_id"
                                            ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"
                                            ng-model="SIns.current_row.province_id"
                                            ng-options="l.id as l.name for l in SBase._.location.province"
                                            required>
                                        <option value="" selected>不限</option>
                                    </select>
                                    <select class="form-control"
                                            name="city_id"
                                            ng-init="SIns.current_row.city_id = SIns.current_row.city_id || options[0].id"
                                            ng-model="SIns.current_row.city_id"
                                            ng-options="l.id as l.name for l in SBase._.location.city | filter: {parent_id: SIns.current_row.province_id}"
                                            required>
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">销售状态</label>
                                    <input type="checkbox" value="number:1" ng-model="SIns.cond.where.log_lease_lease_type_id1">自营
                                    <input type="checkbox" value="number:2" ng-model="SIns.cond.where.log_lease_lease_type_id2">租赁
                                    <input type="checkbox" value="number:3" ng-model="SIns.cond.where.log_lease_lease_type_id3">出售
                                    <input type="checkbox" value="number:4" ng-model="SIns.cond.where.log_lease_lease_type_id4">免费合作
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">设备状态</label>
                                    <input type="checkbox" value="number:1" ng-model="SIns.cond.where.log_action_type_id1">ok
                                    <input type="checkbox" value="number:2" ng-model="SIns.cond.where.log_action_type_id2">维修中
                                    <input type="checkbox" value="number:3" ng-model="SIns.cond.where.log_action_type_id3">已报废
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">代理商</label>
                                    <select class="form-control"
                                            name="log_lease_agency_id"
                                            ng-model="SIns.cond.where.log_lease_agency_id"
                                            ng-options="l.id as l.name for l in SAgency.all_rec">
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">医院</label>
                                    <select class="form-control"
                                            name="log_lease_hospital_id"
                                            ng-model="SIns.cond.where.log_lease_hospital_id"
                                            ng-options="l.id as l.name for l in SHospital.all_rec">
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">维修记录</label>
                                    <input type="checkbox" value="number:1" ng-model="SIns.cond.where.log_action_tid1">不限
                                    <input type="checkbox" value="number:2" ng-model="SIns.cond.where.log_action_tid2">有维修记录
                                    <input type="checkbox" value="number:3" ng-model="SIns.cond.where.log_action_tid3">无维修记录
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">生产日期</label>
                                    <input class="form-control" type="date">到<input class="form-control" type="date">
                                </div>


                                <div class="form-group">
                                    <button class="btn btn-primary" style="float: right">查询</button>
                                </div>
                            </form>
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
                                <th>编号</th>
                                <th>销售方式</th>
                                <th>设备状态</th>
                                <th>医院ID</th>
                                <th>代理商ID</th>
                                <th>负责人</th>
                                <th>维护记录</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td>[:row.cust_id:]</td>
                                <td>
                                    <span ng-if="!row.log_lease_lease_type_id">-</span>
                                    <span>[: SIns.lease_type[row.log_lease_lease_type_id - 1].name :]</span>
                                </td>
                                <td>
                                    <span ng-if="!row.log_action_type_id">ok</span>
                                    <span>[: SIns.robot_action_type[row.log_action_type_id - 1].name:]</span>
                                </td>
                                {{--<td>--}}
                                {{--<span ng-if="!row.log_lease_hospital_id">-</span>--}}
                                {{--<span>[: SHospital.all_rec[row.log_lease_hospital_id - 1].name:]</span>--}}
                                {{--</td>--}}
                                <td>
                                    <span ng-if="!row.log_lease_agency_id">-</span>
                                    <span ng-repeat="rec in SHospital.all_rec | where:{id: row.log_lease_hospital_id}:true">[: rec.name :]</span>
                                </td>
                                <td>
                                    <span ng-if="!row.log_lease_agency_id">-</span>
                                    <span ng-repeat="rec in SAgency.all_rec | where:{id: row.log_lease_agency_id}:true">[: rec.name :]</span>
                                </td>
                                <td>[:row.employee.name:]</td>
                                <td>[:row.robot_lease_log.length:]</td>
                                <td class="edit col-md-2">
                                    <span class="tool_wrapper">
                                        <button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">
                                            编辑
                                        </button>
                                        <button class="btn btn-default" href=""
                                                ng-click="SIns.h.popup_detail()">
                                            详细
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