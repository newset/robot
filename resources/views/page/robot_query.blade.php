<section id="main-content" ng-controller="CPageRobot">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#robot_query" aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel">
                            
                            <form class="form-horizontal collapse" id="robot_query">
                                <div class="form-group">
                                    <label class="control-label col-md-1">编号</label>
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.cust_id"
                                           placeholder="编号">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">地区</label>
                                    <select class="form-control"
                                            name="province_id"
                                            ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"
                                            ng-model="SIns.cond.where.province_id"
                                            ng-options="l.id as l.name for l in SBase._.location.province"
                                            required>
                                        <option value="" selected>不限</option>
                                    </select>
                                    <select class="form-control"
                                            name="city_id"
                                            ng-init="SIns.current_row.city_id = SIns.current_row.city_id || options[0].id"
                                            ng-model="SIns.cond.where.city_id"
                                            ng-options="l.id as l.name for l in SBase._.location.city | filter: {parent_id: SIns.current_row.province_id}"
                                            required>
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">销售状态</label>
                                    <input type="checkbox" value="number:1" ng-true-value="1" ng-model="SIns.cond.where.lease_type_id[0]">在库
                                    <input type="checkbox" value="number:2" ng-true-value="2" ng-model="SIns.cond.where.lease_type_id[1]">已租出
                                    <input type="checkbox" value="number:3" ng-true-value="3" ng-model="SIns.cond.where.lease_type_id[2]">已售出
                                    <input type="checkbox" value="number:4" ng-true-value="4" ng-model="SIns.cond.where.lease_type_id[3]">免费合作中
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">设备状态</label>
                                    <input type="checkbox" value="number:1" ng-true-value="1" ng-model="SIns.cond.where.action_type_id[0]">正常
                                    <input type="checkbox" value="number:2" ng-true-value="2" ng-model="SIns.cond.where.action_type_id[1]">维修
                                    <input type="checkbox" value="number:3" ng-true-value="3" ng-model="SIns.cond.where.action_type_id[2]">作废
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">代理商</label>
                                    <select class="form-control"
                                            name="log_lease_agency_id"
                                            ng-model="SIns.cond.where.agency_id"
                                            ng-options="l.id as l.name for l in SAgency.all_rec">
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">医院</label>
                                    <select class="form-control"
                                            name="log_lease_hospital_id"
                                            ng-model="SIns.cond.where.hospital_id"
                                            ng-options="l.id as l.name for l in SHospital.all_rec">
                                        <option value="" selected>不限</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">维修记录</label>
                                    <input type="radio" value="number:1" ng-true-value="1" ng-model="SIns.cond.where.log_action_tid">不限
                                    <input type="radio" value="number:2" ng-true-value="2" ng-model="SIns.cond.where.log_action_tid">有维修记录
                                    <input type="radio" value="number:3" ng-true-value="3" ng-model="SIns.cond.where.log_action_tid">无维修记录
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">生产日期</label>
                                    <div style="display: inline-block;">
                                      <md-datepicker ng-model="SIns.cond.where.created_start" md-placeholder="生产日期"></md-datepicker>
                                    </div>
                                    到
                                    <div style="display: inline-block;">
                                      <md-datepicker ng-model="SIns.cond.where.created_end" md-placeholder="生产日期"></md-datepicker>
                                    </div>
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
                                <th>设备状态</th>
                                <th>销售方式</th>
                                <th>医院</th>
                                <th>代理商</th>
                                <th>负责人</th>
                                <th>维护记录</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td>[:row.cust_id:]</td>
                                <td>
                                    <span>[: SIns.robot_action_type[row.action_type_id - 1].name:]</span>
                                </td>
                                <td>
                                    <span ng-if="!row.lease_type_id">-</span>
                                    <span>[: SIns.lease_type[row.lease_type_id - 1].name :]</span>
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
                                        <button class="btn btn-primary btn-sm" href="" ng-click="SIns.popup_edit(row)">
                                            设置销售状态
                                        </button>
                                        <button class="btn btn-default btn-sm" href=""
                                                ng-click="SIns.h.popup_detail()">
                                            查看
                                        </button>
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
                                        max-size="10"
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