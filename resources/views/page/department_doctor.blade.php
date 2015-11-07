{{-- 医院详情页
router:
controller:CPageDepartment
--}}
<section id="main-content">
    <div class="panel panel-default">
        <div class="panel-body black-border">
            <div class="row col-md-12">
                <div class="col-md-6">
                    <span class="hospital-custom-font">当前医院: [:hospital.name:] (编号 [:hospital.id:])</span>
                </div>
                <div class="col-md-2　col-md-offset-10 pull-right">
                    <button class=" btn btn-custom btn-primary black-border"
                        ui-sref="base.department.new({hid:hospital.id, next: departments.length+1})" title="新建科室">新建科室</button>
                    {{-- <button class="btn btn-custom btn-primary  black-border"  ng-click="SIns.popup_edit(null)">新建医生  </button> --}}
                </div>
            </div>
        </div>
    </div>
    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer"    >
        <table
            id="example"
            class="table table-striped table-bordered dataTable no-footer table-hover"
            cellspacing="0"
            width="100%"
            aria-describedby="example_info"
            style="width: 100%;">
            <thead>
                <tr role="row" class="info">
                    <th>科室名</th>
                    <th>人员数量</th>
                    <th>登录名</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd" ng-repeat="row in departments | orderBy: row.id ">
                    {{--<td class="sorting_1">[:row.id:]</td>--}}
                    <td>[:row.name:]</td>
                    <td>[:row.doctor.length:]</td>
                    <td>[:row.username:]</td>
                    <td class="row col-md-2 text-right">
                        <button class="btn btn-custom btn-default " ng-click="delete_department(row)">删除</button>
                        <button class="btn btn-custom btn-primary" ui-sref="base.department.edit({did: row.id})">  编辑  </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-if="departments.length<=0">暂无结果</div>

        {{--<div class="row pagination_wrapper">--}}
        {{--<pagination max-size="10"--}}
        {{--boundary-links="true"--}}
        {{--total-items="SIns.total_items"--}}
        {{--items-per-page="SIns.items_per_page"--}}
        {{--ng-model="current_pagin"--}}
        {{--ng-change="SIns.change_page(current_pagin)"--}}
        {{--class="pagination-md"--}}
        {{--previous-text="<<"--}}
        {{--next-text=">>"--}}
        {{--first-text="第一页"--}}
        {{--items-per-page="5"--}}
        {{--last-text="最后一页"--}}
        {{-->--}}
        {{--</pagination>--}}
        {{--</div>--}}
    </div>

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
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dataTables_length" id="example_length">

                </div>
            </div>
        </div>
        <table
            id="example"
            class="table
                   table-striped
                   table-bordered
                   dataTable
                   no-footer
                   table-hover"
            cellspacing="0"
            width="100%"
            aria-describedby="example_info"
            style="width: 100%;">
            <thead>
                <tr role="row" class="info">
                    <th>状态</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>职务</th>
                    <th>等级</th>
                    <th>授权码</th>
                    <th>电话</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd"  ng-repeat="row in doctors | orderBy: row.id ">
                    <td ng-repeat="t in SDoctor.status_type | filter:{'id':  row.status}:true">
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
                            <button class="btn btn-custom btn-primary" ui-sref="base.doctor.detail({id: row.id})">
                                查看
                            </button>
                            {{-- <span href="" class="btn-custom-delete"  ng-click="SIns.d(row.id)">删除</span> --}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-if="doctors.length<=0">暂无结果</div>
        <!-- <div class="col-md-12">
            <a ui-sref="base.doctor.new({hospital: hospital.id})" class="btn btn-primary pull-right">新建医生</a>
        </div> -->
        {{-- <div class="row pagination_wrapper">
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
        </div> --}}
    </div>
    {{-- @include('page.department') --}}
    {{-- @include('page.doctor') --}}
    
    <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer robot-custom-height">
        <div class="col-md-12">
            <a ui-sref="base.doctor.new({hospital: hospital.id})" class="btn btn-primary pull-right">新建医生</a>
        </div>
    </div>
    
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title text-left">
				 相关设备
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-12">
				<table
                id="example"
                class="table table-striped table-bordered dataTable no-footer table-hover"
                cellspacing="0"
                width="100%"
                aria-describedby="example_info"
                style="width: 100%;">
                <thead>
                    <tr role="row" class="info">
                        <th>编号</th>
                        <th>设备状态</th>
                        <th>销售状态</th>
                        <th>负责人</th>
                        <th>租赁期</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd" ng-repeat="row in robots | orderBy: row.robot_id ">
                        {{--<td class="sorting_1">[:row.id:]</td>--}}
                        <td>[:row.robot_id:]</td>
                        <td>
                            <span ng-if="row.status == 0">正常</span>
    						<span ng-if="row.status == 1">维修中</span>
    						<span ng-if="row.status == 2">作废</span>
                        </td>
                        <td>
                            <span ng-if="row.lease_type_id == -1">在库</span>
    						<span ng-if="row.lease_type_id == 1">售出</span>
    						<span ng-if="row.lease_type_id == 2">租出</span>
    						<span ng-if="row.lease_type_id == 3">免费合作</span>
                        </td>
                        <td>[:row.name:]</td>
                        <td>[:row.lease_started_at | laDate:] 至 [:row.lease_ended_at | laDate:]</td>
                    </tr>
                </tbody>
            </table>
            <div ng-if="departments.length<=0">暂无结果</div>
    
            {{--<div class="row pagination_wrapper">--}}
            {{--<pagination max-size="10"--}}
            {{--boundary-links="true"--}}
            {{--total-items="SIns.total_items"--}}
            {{--items-per-page="SIns.items_per_page"--}}
            {{--ng-model="current_pagin"--}}
            {{--ng-change="SIns.change_page(current_pagin)"--}}
            {{--class="pagination-md"--}}
            {{--previous-text="<<"--}}
            {{--next-text=">>"--}}
            {{--first-text="第一页"--}}
            {{--items-per-page="5"--}}
            {{--last-text="最后一页"--}}
            {{-->--}}
            {{--</pagination>--}}
            {{--</div>--}}
			</div>

		</div>
	</div>
    
    <!-- <div role="grid" id="example_wrapper" class="dataTables_wrapper form-inline no-footer"    >
        <table
            id="example"
            class="table table-striped table-bordered dataTable no-footer table-hover"
            cellspacing="0"
            width="100%"
            aria-describedby="example_info"
            style="width: 100%;">
            <thead>
                <tr role="row" class="info">
                    <th>编号</th>
                    <th>设备状态</th>
                    <th>销售状态</th>
                    <th>负责人</th>
                    <th>租赁期</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd" ng-repeat="row in robots | orderBy: row.robot_id ">
                    {{--<td class="sorting_1">[:row.id:]</td>--}}
                    <td>[:row.robot_id:]</td>
                    <td>
                        <span ng-if="row.status == 0">正常</span>
						<span ng-if="row.status == 1">维修中</span>
						<span ng-if="row.status == 2">作废</span>
                    </td>
                    <td>
                        <span ng-if="row.lease_type_id == -1">在库</span>
						<span ng-if="row.lease_type_id == 1">售出</span>
						<span ng-if="row.lease_type_id == 2">租出</span>
						<span ng-if="row.lease_type_id == 3">免费合作</span>
                    </td>
                    <td>[:row.name:]</td>
                    <td>[:row.lease_started_at | laDate:] 至 [:row.lease_ended_at | laDate:]</td>
                </tr>
            </tbody>
        </table>
        <div ng-if="departments.length<=0">暂无结果</div>

        {{--<div class="row pagination_wrapper">--}}
        {{--<pagination max-size="10"--}}
        {{--boundary-links="true"--}}
        {{--total-items="SIns.total_items"--}}
        {{--items-per-page="SIns.items_per_page"--}}
        {{--ng-model="current_pagin"--}}
        {{--ng-change="SIns.change_page(current_pagin)"--}}
        {{--class="pagination-md"--}}
        {{--previous-text="<<"--}}
        {{--next-text=">>"--}}
        {{--first-text="第一页"--}}
        {{--items-per-page="5"--}}
        {{--last-text="最后一页"--}}
        {{--><!-- --}}
        {{--</pagination>--}}
        {{--</div>--}}
    </div> -->

</section>
