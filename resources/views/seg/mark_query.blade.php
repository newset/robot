<section id="main-content">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#mark_query" aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        @if(!he_is('department'))
                            <div class="row col-md-12 search_panel" ng-if="SIns.with_search">
                                <form class="form-horizontal" id="mark_query">
                                    <div class="form-group">
                                        <label class="control-label col-md-2">编号</label>
                                        <input class="form-control"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.cust_id"
                                               placeholder="编号">
                                    </div>
                                    {{--<div class="form-group">--}}
                                    {{--<input class="form-control"--}}
                                    {{--ng-model-options="{debounce: 300}"--}}
                                    {{--ng-model="SIns.cond.where_has.doctor.name"--}}
                                    {{--placeholder="名称搜索">--}}
                                    {{--</div>--}}
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Mark状态</label>
                                        <div>
                                            <label class="checkbox-inline"><input type="checkbox" value="number:1" ng-true-value="1" ng-false-value="" ng-model="SIns.cond.where.status[0]">未使用</label>
                                            <label class="checkbox-inline"><input type="checkbox" value="number:2" ng-true-value="2" ng-false-value="" ng-model="SIns.cond.where.status[1]">已使用</label>
                                            <label class="checkbox-inline"><input type="checkbox" value="number:3" ng-true-value="5" ng-false-value="" ng-model="SIns.cond.where.status[2]">已绑定</label>
                                            <label class="checkbox-inline"><input type="checkbox" value="number:4" ng-true-value="3" ng-false-value="" ng-model="SIns.cond.where.status[3]">损坏报废</label>
                                            <label class="checkbox-inline"><input type="checkbox" value="number:5" ng-true-value="4" ng-false-value="" ng-model="SIns.cond.where.status[4]">损坏更换</label>
                                        </div>
                                    </div>
                                    @if(he_is('employee'))
                                        <div class="form-group">
                                            <label class="control-label col-md-2">销售状态</label>
                                            <div>
                                                <label class="checkbox-inline"><input type="checkbox" value="number:1" ng-true-value="1" ng-model="SIns.cond.where.sold[0]">在库</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="number:2" ng-true-value="2" ng-model="SIns.cond.where.sold[1]">出货(卖给代理商)</label>
                                                <label class="checkbox-inline"><input type="checkbox" value="number:3" ng-true-value="3" ng-model="SIns.cond.where.sold[2]">已售(卖给医院)</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label col-md-2">代理商</label>
                                         <div class="col-md-2">
                                        <md-autocomplete
                                              md-selected-item="selectedAgency"
                                              md-search-text="agencySearch"
                                              md-selected-item-change="SIns.cond.where.agency_id = selectedAgency.id"
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
                                        <label class="control-label col-md-2">医院</label>
                                         <div class="col-md-2">
                                          <md-autocomplete
                                                md-selected-item="selectedHospital"
                                                md-search-text="hostpitalSearch"
                                                md-selected-item-change="SIns.cond.where.hospital_id = selectedHospital.id"
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

                                <!--     <div class="form-group">
                                        <label class="control-label col-md-2">出货给代理商时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.from_created_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.to_created_at"
                                               placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">卖出给医院时间</label>
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

                                    <div class="form-group">
                                        <label class="control-label col-md-2">医生扫码时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.from_used_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.to_used_at"
                                               placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">损坏时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.from_damaged_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.to_damaged_at"
                                               placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">归档时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.from_archive_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.to_archive_at"
                                               placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">手术时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.from_surgery_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.to_surgery_at"
                                               placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">生产时间</label>
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.create_at"
                                               placeholder="">
                                        至
                                        <input class="form-control"
                                               type="date"
                                               ng-model-options="{debounce: 300}"
                                               ng-model="SIns.cond.where.create_at"
                                               placeholder="">
                                    </div> -->

                                    <div class="form-group">
                                        <button class="btn btn-primary" style="float: right" ng-click="SIns.refresh()">查询</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row" style="display: none;">
                                <div class="col-md-12">
                                    <div class="dataTables_length" id="example_length">
                                        @if(he_is('employee'))
                                            <button class="btn btn-default fr"
                                                    ng-click="SIns.popup_mark_bind(null)">创建/绑定
                                            </button>
                                            <button class="btn btn-default fr"
                                                    {{--ng-click="SIns.popup_mark_unbind(null)">导入数据--}}
                                                    type="file"
                                                    ngf-select="uploadFiles($file)"
                                                    {{--accept="image/*"--}}
                                                    ngf-max-size="10MB">
                                                导入数据
                                            </button>
                                        @endif
                                        <button class="btn btn-default fr"
                                                ng-click="SIns.popup_mark_update(null)">更新
                                        </button>
                                        @if(he_is('employee'))
                                            <button class="btn btn-default fr"
                                                    ng-click="SIns.popup_mark_unbind(null)">解绑
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(he_is('department'))
                            全院Mark库存：<span class="bold">[:SIns.marks_not_used:] </span>个
                        @endif
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
                                @if(he_is('employee'))
                                    <th>销售状态</th>
                                @endif
                                @if(he_is('agency'))
                                    <th>医院</th>
                                @endif
                                @if(he_is('agency') || he_is('department'))
                                    <th>医生</th>
                                @endif
                                <th>使用状态</th>
                                @if(!he_is('department'))
                                    <th>操作</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td>[:row.cust_id:]</td>
                                @if(he_is('employee'))
                                    <td>
          	                					<span ng-if="row.sold==0">在库</span>
                                      <span ng-if="row.sold==1">出货</span>
          	                					<span ng-if="row.sold==2">已售</span>
                                    </td>
                                @endif
                                @if(he_is('agency'))
                                    <td>[:row.hospital_name:]</td>
                                @endif
                                @if(he_is('agency') || he_is('department'))
                                    <td>[:row.doctor_name || '-' :]</td>
                                @endif
                                <td>
                                    <span ng-if="row.status == 1">未使用</span>
                                    <span ng-if="row.status == 2">使用完毕</span>
                                    <span ng-if="row.status == 3">损坏报废</span>
                                    <span ng-if="row.status == 4">损坏更新</span>
                                </td>
                                @if(!he_is('department'))
                                    <td class="edit col-md-2">
                                    <span class="tool_wrapper">
                                        {{--<button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">--}}
                                        {{--编辑--}}
                                        {{--</button>--}}
                                        <a class="btn btn-default btn-sm" ui-sref="base.mark.show({id : row.id})">
                                            查看
                                        </a>
                                        <!-- <a class="btn btn-default btn-sm" ng-click="SIns.h.popup_detail(row, SIns, 'agency/r', {relation: ['robotLeaseLog', 'mark', 'hospital'], where: {id: row.id}})">
                                            查看
                                        </a> -->
                                        <!-- <button class="btn btn-default" ng-click="SIns.popup_edit(row)" -->
                                        @if(he_is('agency'))
                                                <!-- ng-if="row.used_at && !row.damaged_at && !row.archive_at && !row.doctor_id" -->
                                                @endif
                                                <!-- > -->
                                            <!-- 编辑 -->
                                        </button>
                                        @if(he_is('employee'))
                                            <!-- <span class="curp delete" ng-click="SIns.d(row.id)">删除</span> -->
                                        @endif
                                    </span>
                                    </td>
                                @endif
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

