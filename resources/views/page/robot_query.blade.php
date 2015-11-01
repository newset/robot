<section id="main-content">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#robot_query" aria-expanded="true" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapperno-footer">
                            <form class="form-horizontal" ng-class="{'collapse': simpleQuery}" id="robot_query" aria-expanded="true">
                                <div class="form-group">
                                    <label class="control-label col-md-1">编号</label>
                                    <div class="col-md-6 row">
                                        <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.cust_id"
                                           placeholder="编号">
                                    </div>
                                    
                                </div>

                                <div class="form-group md-select-group">
                                    <label class="control-label col-md-1">地区</label>
                                    <div class="col-md-3 row">
                                        <select name="provice" class="form-control" chosen ng-model="SIns.cond.where.province_id" ng-options="l.id as l.name for l in SBase._.location.province">
                                            <option value="">不限</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="provice" class="form-control" update="SIns.cond.where.province_id" chosen ng-model="SIns.cond.where.city_id" ng-options="l.id as l.name for l in SBase._.location.city || []|filter: {parent_id: SIns.cond.where.province_id}:true">
                                            <option value="">不限</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">销售状态</label>
                                    <label class="checkbox-inline" ng-if="lease" ng-repeat="lease in SIns.robot_status_type"><input type="checkbox" value="[:lease.id:]" multi-check index="[:$index:]" holder="SIns.cond.where.lease_type_id" />[:lease.name:]</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">设备状态</label>
                                    <label class="checkbox-inline" ng-repeat="action in SIns.robot_action_type"><input type="checkbox" value="[:action.id:]" multi-check index="[:$index:]" holder="SIns.cond.where.action_type_id" />[:action.name:]</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">代理商</label>
                                    <div class="col-md-6 row">
                                        <select name="hospital_id" chosen class="form-control" ng-model="SIns.cond.where.agency_id" ng-options="l.id as l.name for l in SAgency.all_rec">
                                            <option value="">不限</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">医院</label>
                                    <div class="col-md-6 row">
                                        <select name="hospital_id" chosen class="form-control" ng-model="SIns.cond.where.hospital_id" ng-options="l.id as l.name for l in SHospital.all_rec">
                                            <option value="">不限</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">维修记录</label>
                                    <label class="radio-inline"><input type="radio" value="" ng-true-value="" ng-model="SIns.cond.where.log_action_tid">不限</label>
                                    <label class="radio-inline"><input type="radio" value="1" ng-true-value="1" ng-model="SIns.cond.where.log_action_tid">有维修记录</label>
                                    <label class="radio-inline"><input type="radio" value="0" ng-true-value="0" ng-model="SIns.cond.where.log_action_tid">无维修记录</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">生产日期</label>
                                    <div class="col-md-3" style="margin-left:-20px; ">
                                        <datepicker date-format="yyyy-MM-dd" date-max-limit="[:SIns.cond.where.created_end:]" date-set="[:SIns.cond.where.created_start:]">
                                            <input type="text" ng-model="SIns.cond.where.created_start" class="form-control">
                                        </datepicker>
                                    </div>
                                    <span class="pull-left report-to">到</span>
                                    <div class="col-md-3">
                                        <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.cond.where.created_end:]" date-min-limit="[:SIns.cond.where.created_start:]">
                                            <input type="text" ng-model="SIns.cond.where.created_end" class="form-control ">
                                        </datepicker>
                                    </div>
                                    <div style="display:inline-block">
                                        <button type="button" class="btn btn-default" ng-click="SIns.cond.where.created_start =null;SIns.cond.where.created_end=null">清除</button>
                                    </div>
                                </div>

                                <div class="form-group text-right col-md-12">
                                    <!-- <button class="btn btn- default" ng-click="SIns.cond.where = {}">重置</button> -->
                                    <button class="btn btn-info" ng-click="SIns.refresh()">查询</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-12" ng-show="SIns.total_items != undefined">
                            <table id="example" class="table table-striped table-bordered dataTable no-footer table-hover"
                                        cellspacing="0"
                                        width="100%"
                                        aria-describedby="example_info"
                                        style="width: 100%;">
                                <thead>
                                    <tr role="row" class="info">
                                        <th>编号</th>
                                        <th>设备状态</th>
                                        <th>生产日期</th>
                                        <th>销售状态</th>
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
                                        <td class="col-md-2">[:row.cust_id:]</td>
                                        <td class="col-md-1">
                                            <span>[: SIns.robot_action_type[row.status].name:]</span>
                                        </td>
                                        <td class="col-md-2">[:row.production_date | laDate:]</td>
                                        <td class="col-md-1">
                                            <span ng-if="!row.lease_type_id ">在库</span>
                                            <span>[: SIns.robot_status_type[row.lease_type_id+1].name :]</span>
                                        </td>

                                        {{--<td>--}}
                                        {{--<span ng-if="!row.log_lease_hospital_id">无</span>--}}
                                        {{--<span>[: SHospital.all_rec[row.log_lease_hospital_id - 1].name:]</span>--}}
                                        {{--</td>--}}
                                        <td class="col-md-2">
                                            <span ng-if="!row.hospital_id || row.hospital_id == -1">无</span>
                                            <span >[: row.hospital_name :]</span>
                                        </td>
                                        <td class="col-md-1">
                                            <span ng-if="!row.agency_id || row.agency_id == -1">无</span>
                                            <span>[: row.agency_name :]</span>
                                        </td>
                                        <td class="col-md-1">[:row.employee_name:]</td>
                                        <td class="col-md-1">[:row.log_count || 0:]</td>
                                        <td class="edit col-md-1">
                                            <span class="tool_wrapper">
                                                <!-- <button class="btn btn-primary btn-sm" href="" ng-click="SIns.popup_edit(row)">
                                                    设置销售状态
                                                </button> -->
                                                <a class="btn btn-primary btn-sm" ui-sref="base.robot.detail({id : row.id})">
                                                    查看
                                                </a>
                                            </span>
                                        </td>
                                        {{--<td>[:row.updated_at:]</td>--}}
                                    </tr>
                                </tbody>
                            </table>

                            <div class="pagination_wrapper">

                                <span class="pull-left">记录: [:(SIns.cond.pagination+1-1)* SIns.items_per_page +  (SIns.total_items/SIns.total_items) || 0:] / [:SIns.total_items:]</span>

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
</section>
