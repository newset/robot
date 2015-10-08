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
                        <div class="row col-md-12 search_panel" ng-if="with_search">
                            <h4>检索</h4>

                            <form>
                                <div class="form-group">
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.cust_id"
                                           placeholder="编号">
                                </div>
                                <div class="form-group">
                                    <select class="form-control"
                                            name="province_id"
                                            ng-model="SIns.cond.where.log_lease_lease_type_id"
                                            ng-options="l.id as l.name for l in SIns.lease_type">
                                        <option value="" selected>销售状态</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control"
                                            name="province_id"
                                            ng-model="SIns.cond.where.log_action_type_id"
                                            ng-options="l.id as l.name for l in SIns.robot_action_type">
                                        <option value="" selected>设备状态</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control"
                                            name="log_lease_agency_id"
                                            ng-model="SIns.cond.where.log_lease_agency_id"
                                            ng-options="l.id as l.name for l in SAgency.all_rec">
                                        <option value="" selected>代理商</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control"
                                            name="log_lease_hospital_id"
                                            ng-model="SIns.cond.where.log_lease_hospital_id"
                                            ng-options="l.id as l.name for l in SHospital.all_rec">
                                        <option value="" selected>医院</option>
                                    </select>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<select class="form-control"--}}
                                            {{--name="log_lease_hospital_id"--}}
                                            {{--ng-model="SIns.cond.where.log_lease_hospital_id"--}}
                                            {{--ng-options="l.id as l.name for l in SHospital.all_rec">--}}
                                        {{--<option value="" selected>维修记录</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<select class="form-control"--}}
                                            {{--name="province_id"--}}
                                            {{--ng-model="SIns.cond.log_where.robotLeaseLog.province_id"--}}
                                            {{--ng-options="l.id as l.name for l in SBase._.location.province"--}}
                                            {{--required>--}}
                                        {{--<option value="" selected>所在省份</option>--}}
                                    {{--</select>--}}
                                    {{--<select class="form-control"--}}
                                            {{--ng-model="SIns.cond.where_has.agency.city_id"--}}
                                            {{--ng-options="l.id as l.name for l in SBase._.location.city--}}
                                                    {{--| filter: {parent_id: SIns.cond.where.province_id}"--}}
                                            {{--name="province"--}}
                                            {{--required>--}}
                                        {{--<option value="" selected>所在市区</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                {{--<div>--}}
                                {{--代理类型：--}}
                                {{--<label for="robot_type_any">不限--}}
                                {{--<input ng-model="SIns.cond.where_has.robot." id="robot_type_any" type="radio" name="robot_type" value="1"--}}
                                {{--checked>--}}
                                {{--</label>--}}

                                {{--<label for="robot_type_self">自营--}}
                                {{--<input ng-model="SIns.cond.where_has.robot." id="robot_type_self" type="radio" name="robot_type" value="2">--}}
                                {{--</label>--}}

                                {{--<label for="robot">代理--}}
                                {{--<input ng-model="SIns.cond.where_has.robot." id="robot" type="radio" name="robot_type" value="3">--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dataTables_length" id="example_length">
                                    <button class="btn btn-default fr"
                                            ng-click="SIns.popup_new(null)">创建
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