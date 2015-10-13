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
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel">
                            <form class="form-horizontal" id="robot_query">
                                <div class="form-group">
                                    <label class="control-label col-md-1">编号</label>
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.cust_id"
                                           placeholder="编号">
                                </div>

                                <div class="form-group md-select-group">
                                    <label class="control-label col-md-1">地区</label>
                                    <div class="col-md-1">
                                        <md-select
                                            name="province_id"
                                            ng-model="SIns.cond.where.province_id"
                                            required>
                                            <md-option value="">不限</md-option>
                                            <md-option value="[:l.id:]" ng-repeat="l in SBase._.location.province">[:l.name:]</option>
                                        </md-select>
                                    </div>
                                    <div class="col-md-1">
                                        <md-select
                                            name="city_id"
                                            ng-model="SIns.cond.where.city_id"
                                            required>
                                            <md-option value="">不限</md-option>
                                            <md-option value="[:l.id:]" ng-repeat="l in SIns.cond.where.province_id&&SBase._.location.city|| []| filter: {parent_id: SIns.cond.where.province_id}:true">[:l.name:]</option>
                                        </md-select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">销售状态</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="1" ng-true-value="1" ng-model="SIns.cond.where.lease_type_id[0]">在库</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="2" ng-true-value="2" ng-model="SIns.cond.where.lease_type_id[1]">已租出</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="3" ng-true-value="3" ng-model="SIns.cond.where.lease_type_id[2]">已售出</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="4" ng-true-value="4" ng-model="SIns.cond.where.lease_type_id[3]">免费合作中</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">设备状态</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="1" ng-true-value="1" ng-model="SIns.cond.where.action_type_id[0]">正常</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="2" ng-true-value="2" ng-model="SIns.cond.where.action_type_id[1]">维修</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="3" ng-true-value="3" ng-model="SIns.cond.where.action_type_id[2]">作废</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">代理商</label>
                                    <div class="col-md-2">
                                        <md-autocomplete
                                            md-selected-item="selectedAgency"
                                            md-search-text="agencySearch"
                                            md-selected-item-change="SIns.cond.where.agency_id = item.id"
                                            md-items="l in SAgency.all_rec|filter : {name: agencySearch}"
                                            md-item-text="l.name"
                                            md-min-length="0"
                                            placeholder="不限">
                                            <md-item-template md-highlight-text="agencySearch" md-highlight-flags="^i">
                                                <span>[:l.name:]</span>
                                            </md-item-template>
                                        </md-autocomplete>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">医院</label>
                                    <div class="col-md-2">
                                        <md-autocomplete
                                            md-selected-item="selectedHospital"
                                            md-search-text="hostpitalSearch"
                                            md-selected-item-change="SIns.cond.where.hospital_id = item.id"
                                            md-items="l in SHospital.all_rec|filter : {name: hostpitalSearch}"
                                            md-item-text="l.name"
                                            md-min-length="0"
                                            placeholder="不限">
                                            <md-item-template md-highlight-text="hostpitalSearch" md-highlight-flags="^i">
                                                <span>[:l.name:]</span>
                                            </md-item-template>
                                        </md-autocomplete>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1">维修记录</label>
                                    <label class="radio-inline"><input type="radio" value="number:1" ng-true-value="1" ng-model="SIns.cond.where.log_action_tid">不限</label>
                                    <label class="radio-inline"><input type="radio" value="number:2" ng-true-value="2" ng-model="SIns.cond.where.log_action_tid">有维修记录</label>
                                    <label class="radio-inline"><input type="radio" value="number:3" ng-true-value="3" ng-model="SIns.cond.where.log_action_tid">无维修记录</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1">生产日期</label>
                                    <div style="display: inline-block;">
                                        <datepicker date-format="yyyy-MM-dd" date-max-limit="[:SIns.cond.where.created_end:]" date-set="[:SIns.cond.where.created_start:]">
                                            <input type="text" ng-model="SIns.cond.where.created_start" class="form-control">
                                        </datepicker>
                                    </div>
                                    <span style="display: inline-block;vertical-align: top;margin-top: 9px;">到</span>
                                    <div style="display: inline-block;">
                                        <datepicker date-format="yyyy-MM-dd" date-set="[:SIns.cond.where.created_end:]" date-min-limit="[:SIns.cond.where.created_start:]">
                                            <input type="text" ng-model="SIns.cond.where.created_end" class="form-control">
                                        </datepicker>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" style="float: right" ng-click="SIns.refresh()">查询</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-12" ng-show="SIns.total_items != undefined">
                            <table id="example" class="table table-striped table-bordered dataTable no-footer"
                                        cellspacing="0"
                                        width="100%"
                                        aria-describedby="example_info"
                                        style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>编号</th>
                                        <th>设备状态</th>
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
                                        <td>[:row.cust_id:]</td>
                                        <td>
                                            <span>[: SIns.robot_action_type[row.action_type_id - 1].name:]</span>

                                            [:row.action_type_id:]
                                        </td>
                                        <td>
                                            <span ng-if="!row.lease_type_id">-</span>
                                            <span>[: SIns.robot_status_type[row.lease_type_id - 1].name :]</span>
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
                                                <!-- <button class="btn btn-primary btn-sm" href="" ng-click="SIns.popup_edit(row)">
                                                    设置销售状态
                                                </button> -->
                                                <a class="btn btn-default btn-sm" ui-sref="base.robot.detail({id : row.id})">
                                                    查看
                                                </a>
                                            </span>
                                        </td>
                                        {{--<td>[:row.updated_at:]</td>--}}
                                    </tr>
                                </tbody>
                            </table>

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
