{{-- 医院列表页
router:
controller:CPageHospital
url:
--}}
<section id="main-content">
    <!--tiles start-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default black-border">
                <div class="panel-heading">
                    <h3 class="panel-title">查询条件</h3>
                    <div class="actions pull-right">
                        <i class="fa fa-chevron-down" i-toggle data-toggle="collapse" data-target="#form_query"
                           aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer">
                        <div class="row col-md-12 search_panel" ng-if="SIns.with_search">

                        </div>
                    </div>
                </div>
                <form class=" form-horizontal" id="form_query">
                    <div class="form-group">
                        <label class="control-label col-md-1">编号</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.where.id"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1">地区</label>
                        <div class="col-md-3">
                            <md-select 
                                name="province_id"
                                ng-model="SIns.cond.where.province_id"
                            >
                                <md-option value="">所在省份</md-option>
                                <md-option value="[:l.id:]" ng-repeat="l in SBase._.location.province">[:l.name:]</option>
                            </md-select>

                        </div>
                        <div class="col-md-3">
                            <md-select
                                name="city_id"
                                ng-model="SIns.cond.where.city_id"
                                required>
                                <md-option value="">所在市区</md-option>
                                <md-option value="[:l.id:]" ng-repeat="l in SIns.cond.where.province_id&&SBase._.location.city|| []| filter: {parent_id: SIns.cond.where.province_id}:true">[:l.name:]</option>
                            </md-select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1">名称</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.where.name"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1">医生</label>
                        <div class="col-md-6">
                            <input class="form-control"
                                   ng-model-options="{debounce: 300}"
                                   ng-model="SIns.cond.where_has.doctor.name"
                                   placeholder="">
                        </div>
                        <div class="col-md-1 pull-right">
                            <button class="btn-primary btn-custom btn " ng-click="SIns.refresh()">查询</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="example"  class="table  table-striped  table-bordered dataTable  no-footer" aria-describedby="example_info">
                <thead>
                    <tr role="row">
                        <th>编号</th>
                        <th>地区</th>
                        <th>医院名称</th>
                        <th>科室</th>
                        <th>医生</th>
                        <th>代理商</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd"
                        ng-repeat="row in SIns.current_page_data | orderBy: row.id ">
                        <td class="sorting_1 col-md-1">[:row.id:]</td>
                        <td class="col-md-2">
                            <span ng-repeat="l in SBase._.location.province |filter:{id:row.province_id}:equalsId">[:l.name:]</span>
                            •<span ng-repeat="l in SBase._.location.city |filter:{id: row.city_id }:equalsId">[:l.name :]</span>
                        </td>
                        <td  class="col-md-2">[:row.name:]</td>
                        <td class="col-md-1">[:row.doctor.length:]</td>
                        <td class="col-md-1">[:row.department.length:]</td>
                        <td class="col-md-1">[:row.agency.length:]</td>
                        <td class="col-md-1" title="[:row.memo:]" >
                            <button href="" ng-if="row.memo.length>0"  ng-click="SIns.popup_edit(row,1)">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                {{-- <i class="icon-file-alt"></i> --}}
                            </button>
                            <a href="#modal" ng-if="row.memo.length==0">             </a>
                        </td>
                        <td class="edit col-md-3">
                            <span class="tool_wrapper">
                                <a class="btn-primary btn-custom btn btn-sm" target="_blank"
                                   href="#/hospital/department_doctor?hid=[:row.id:]">
                                    管理科室/医生
                                </a>
                                <button class="btn-primary btn-custom btn btn-sm"  ui-sref="base.hospital.edit({hid:row.id})">
                                    编辑
                                </button>
                                {{--<span href="" class="curp delete"--}}
                                {{--ng-click="SIns.d(row.id)">删除</span>--}}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="pull-right">
                    <span class="pull-left">记录: [:(SIns.cond.pagination+1-1)* SIns.items_per_page +  (SIns.total_items/SIns.total_items) || 0:] / [:SIns.total_items:]</span>
                
                    <pagination
                        {{--boundary-links="true"--}}
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
</section>
