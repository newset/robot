<section id="main-content" ng-controller="CPageAgency">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#agency_query" aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel" ng-if="SIns.with_search">
                            <form class="form-horizontal collapse" id="agency_query">
                                <div class="form-group">
                                        <label class="control-label col-md-1">编号</label>
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.id"
                                           placeholder="编号">
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<input class="form-control"--}}
                                           {{--ng-model-options="{debounce: 300}"--}}
                                           {{--ng-model="SIns.cond.where_has.doctor.name"--}}
                                           {{--placeholder="名称搜索">--}}
                                {{--</div>--}}
                                <div class="form-group">
                                        <label class="control-label col-md-1">名称</label>
                                    <input class="form-control"
                                           ng-model-options="{debounce: 300}"
                                           ng-model="SIns.cond.where.name"
                                           placeholder="名称">
                                </div>
                              
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-2">所在省市</label>
                                    <div class="col-md-3">
                                    <md-select 
                                            ng-model="SIns.cond.where.province_id"
                                            required class="" style="margin: 0px;">
                                        <option value="" selected>所在省份</option>

                                        <md-option ng-repeat="l in SBase._.location.province" value="[:l.id:]">
                                          [:l.name:]
                                        </md-option>
                                      </md-select>
                                    </div>
                                    <div class="col-md-3">
                                        <md-select 
                                                ng-model="SIns.cond.where.city_id"
                                                required class="" style="margin: 0px;">
                                            <option value="" selected>所在市区</option>
                                            <md-option ng-repeat="l in SBase._.location.city|filter: {parent_id: SIns.current_row.province_id}:true" value="[:l.id:]">
                                              [:l.name:]
                                            </md-option>
                                          </md-select>
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<div>--}}
                                {{--代理类型：--}}
                                {{--<label for="agency_type_any">不限--}}
                                {{--<input ng-model="SIns.cond.where_has.agency." id="agency_type_any" type="radio" name="agency_type" value="1"--}}
                                {{--checked>--}}
                                {{--</label>--}}

                                {{--<label for="agency_type_self">自营--}}
                                {{--<input ng-model="SIns.cond.where_has.agency." id="agency_type_self" type="radio" name="agency_type" value="2">--}}
                                {{--</label>--}}

                                {{--<label for="agency_type_agency">代理--}}
                                {{--<input ng-model="SIns.cond.where_has.agency." id="agency_type_agency" type="radio" name="agency_type" value="3">--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--</div>--}}
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
                                <th></th>
                                <th>编号</th>
                                <th>公司</th>
                                <th>地区</th>
                                <th>代理状态</th>
                                <th>代理开始</th>
                                <th>代理结束</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd"
                                ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                                <td></td>
                                <td>[:row.id:]</td>
                                <td>[:row.name:]</td>
                                <td>
                                    <span ng-repeat="l in SBase._.location.province |filter:{id: row.province_id}:true">[:l.name:]</span>
                                    •
                                    <span ng-repeat="l in SBase._.location.city |filter:{id: row.city_id }:true">[:l.name :]</span>
                                </td>
                                <td>[:SIns.status(row):]</td>
                                <td>[:row.started_at:]</td>
                                <td>[:row.ended_at:]</td>
                                <td class="edit col-md-2">
                                    <span class="tool_wrapper">
                                        <button class="btn btn-default" href="" ng-click="SIns.h.popup_detail(row, SIns, 'agency/r', {relation: ['robotLeaseLog', 'mark', 'hospital'], where: {id: row.id}})">
                                            详细
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
                                        next-text=">"
                                        max-size="10"
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