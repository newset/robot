{{-- 代理商列表(查询)页
url:/agency/list
controller:
--}}
<section id="main-content" >
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default  black-border">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#agency_query" aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel" ng-if="SIns.with_search">
                        </div>
                    </div>

                <form class="form-horizontal" id="agency_query">
                    <div class="form-group">
                        <label class="control-label col-md-1">编号</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.whereLike.id"
                                   placeholder="编号">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-1">地区</label>
                        <div class="col-md-3">
                            <select name="province_id" 
                                chosen 
                                class="form-control" 
                                update="SBase._.location.province"
                                ng-model="SIns.cond.where.province_id" 
                                ng-options="l.id as l.name for l in SBase._.location.province">
                                <option value="">所在省份</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="city_id" 
                                chosen 
                                class="form-control" 
                                update="SIns.cond.where.province_id" 
                                ng-model="SIns.cond.where.city_id" 
                                ng-options="l.id as l.name for l in SIns.cond.where.province_id&&SBase._.location.city|| []| filter: {parent_id: SIns.cond.where.province_id}:true">
                                <option value="">所在城市</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1">名称</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.whereLike.name"
                                   placeholder="名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1">联系人姓名</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.whereLike.name_in_charge"
                                   placeholder="联系人">
                        </div>
                    </div>
                    <div class="form-group text-right col-md-12">
                        <button class="btn-primary btn  btn-custom" ng-click="SIns.refresh()">查询</button>
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
            </div>
        </div>  {{--col-md-6 --}}
    </div>
    <div class="row" ng-show="SIns.current_page_data">
        <div class="col-md-12">
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
                        <th></th>
                        <th>编号</th>
                        <th>名称</th>
                        <th>地区</th>
                        <th>代理状态</th>
                        <th>代理开始</th>
                        <th>代理结束</th>
                        <th class="col-md-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd"  ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                        <td></td>
                        <td>[:row.id:]</td>
                        <td>[:row.name:]</td>
                        <td>
                            <span ng-repeat="l in SBase._.location.province |filter:{id: row.province_id}:equalsId">[:l.name:]</span>
                            •
                            <span ng-repeat="l in SBase._.location.city |filter:{id: row.city_id }:equalsId">[:l.name :]</span>
                        </td>
                        <td>[:SIns.status(row):]</td>
                        <td>[:row.started_at:]</td>
                        <td>[:row.ended_at:]</td>
                        <td class="edit col-md-1">
                            <span class="tool_wrapper">
                                <button class="btn-primary btn-custom btn btn-sm" ui-sref="base.agency.detail({aid:row.id})">
                                    查看
                                </button>
                            </span>
                        </td>
                        {{--<td>[:row.updated_at:]</td>--}}
                    </tr>
                </tbody>
            </table>
            <div class="">
                <div class="pagination_wrapper">
                    <span class="pull-left">记录: [:(SIns.cond.pagination+1-1)* SIns.items_per_page +  (SIns.total_items/SIns.total_items) || 0:] / [:SIns.total_items||0:]</span>
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
</section>
