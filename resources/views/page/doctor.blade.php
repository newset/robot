<div class="panel panel-default" ng-controller="CPageDoctor as cPageDoctor">
    <div class="panel-heading">
        <h3 class="panel-title">医生管理</h3>
    </div>
    <div class="panel-body">
        <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
            <div class="row col-md-12 search_panel" ng-if="SIns.show_search_panel">
                <form>
                    <div class="form-group">
                        <input class="form-control"
                               ng-model-options="{debounce: 300}"
                               ng-model="search_by.id"
                               placeholder="编号搜索">
                        <input class="form-control"
                               ng-model="search_by.r_doctor"
                               placeholder="医生">
                        <input class="form-control"
                               ng-model="search_by.name"
                               placeholder="名称">
                    </div>
                    <div class="form-group">
                        <select class="form-control"
                                name="province_id"
                                ng-model="search_by.province_id"
                                ng-options="l.id as l.name for l in SBase._.location.province"
                                required>
                            <option value="" selected>所在省份</option>
                        </select>
                        <select class="form-control"
                                ng-model="search_by.city_id"
                                ng-options="l.id as l.name for l in SBase._.location.city
                                                    | filter: {parent_id: search_by.province_id}"
                                name="province"
                                required>
                            <option value="" selected>所在市区</option>
                        </select>
                    </div>
                    {{--<div class="form-group">--}}
                    {{--<div>--}}
                    {{--代理类型：--}}

                    {{--<label for="agency_type_any">不限--}}
                    {{--<input id="agency_type_any" type="radio" name="agency_type" value="1"--}}
                    {{--checked>--}}
                    {{--</label>--}}

                    {{--<label for="agency_type_self">自营--}}
                    {{--<input id="agency_type_self" type="radio" name="agency_type" value="2">--}}
                    {{--</label>--}}

                    {{--<label for="agency_type_agency">代理--}}
                    {{--<input id="agency_type_agency" type="radio" name="agency_type" value="3">--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </form>
            </div>
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
                    <th>状态</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>职务</th>
                    <th>等级</th>
                    <th>授权码</th>
                    <th>电话</th>
                    <th>Email</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                <tr class="odd"  ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                    <td ng-repeat="t in SIns.status_type | filter:{'id':  row.status}:true">
                        [:t.name:]
                    </td>
                    <td>[:row.name:]</td>
                    <td>
                        <div ng-if="row.gender == 1">男</div>
                        <div ng-if="row.gender != 1">女</div>
                    </td>
                    <td>[:row.title:]</td>
                    <td>[:row.level:]</td>
                    <td>[:row.cust_id:]</td>
                    <td>[:row.phone:]</td>
                    <td>[:row.email:]</td>
                    <td class="edit col-md-1">
                                    <span class="tool_wrapper">
                                        <button class="btn btn-default" href="" ng-click="SIns.popup_edit(row)">
                                            编辑
                                        </button>
                                        <span href="" class="curp delete"
                                              ng-click="SIns.d(row.id)">删除</span>
                                    </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div ng-if="!SIns.current_page_data.length">暂无结果</div>

            <div class="row pagination_wrapper">
                <pagination max-size="10"
                            boundary-links="true"
                            total-items="SIns.total_items"
                            items-per-page="SIns.items_per_page"
                            ng-model="current_pagin"
                            ng-change="SIns.change_page(current_pagin)"
                            class="pagination-md"
                            previous-text="<<"
                            next-text=">>"
                            first-text="第一页"
                            items-per-page="5"
                            last-text="最后一页"
                        >
                </pagination>
            </div>
        </div>
    </div>
</div>
