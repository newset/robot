<div class="panel panel-default" >
        <div class="panel-heading">
            <h3 class="panel-title pull-right">                    [:SIns.status(agency):]</h3>
            <h3 class="panel-title">[:agency.name:]</h3>
        </div>
        <div class="col-md-12">
            <h3>基本信息</h3>
        </div>

        <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <th class="tar">名称</th>
            <td>[:agency.name:]</td>
        </tr>
        <tr>
            <th class="tar">地区</th>
            <td>
                <span ng-repeat="l in SBase._.location.province |filter:{id: agency.province_id}:equalsId">[:l.name:]</span> <span
                        ng-repeat="l in SBase._.location.city |filter:{id: agency.city_id }:equalsId">[:l.name :]</span>
                <p>[:agency.location_detail:]</p>
            </td>
        </tr>
        <tr>
            <th class="tar">联系人</th>
            <td>[:agency.name_in_charge:]</td>
        </tr>
        {{-- <tr>
            <th class="tar">编号</th>
            <td>[:agency.id:]</td>
        </tr> --}}
        <tr>
            <th class="tar">电话</th>
            <td>[:agency.phone:]</td>
        </tr>
        <tr>
            <th class="tar">Email</th>
            <td>[:agency.email:]</td>
        </tr>
        <tr>
            <th  class="tar">状态</th>
            <td> [:SIns.status(agency):]</td>
        </tr>
        <tr>
            <th class="tar">代理权</th>
            <td>[:agency.started_at:]－－[:agency.ended_at:]</td>
        </tr>
        <tr>
            <th class="tar">备注</th>
            <td title="[:row.memo:]">[:row.memo | cut:true:10 :]</td>
        </tr>
        </tbody>
    </table>
        <div class="col-md-12">
        <h3>销售情况</h3>
        </div>
    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <th class="tar col-md-1">累计销售设备</th>
            <span class="hidden"
                  ng-repeat="log in robot_sold = (agency.robot_lease_log | filter:{lease_type_id: 3})">
            </span>
            <td>[:robot_sold.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">累计出租设备</th>
            <span class="hidden"
                  ng-repeat="log in robot_leased = (agency.robot_lease_log | filter:{lease_type_id: 2})">
            </span>
            <td>[:robot_leased.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">累计销售Mark</th>
            <span class="hidden"   ng-repeat="log in mark_sold = (agency.mark | filter:{status: 3})">
            </span>
            <td>[:mark_sold.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">库存Mark</th>
            <td>[:agency.mark.length:]</td>
        </tr>
        </tbody>
    </table>
        <div class="col-md-12">
                <h3>相关医院</h3>
        </div>
    <table  class="table  table-striped  table-bordered dataTable  no-footer">
        <thead>
        <tr role="row">
            <th class="col-md-1">编号</th>
            <th class="col-md-1">地区</th>
            <th class="col-md-1">名称</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="h in agency.hospital">
            <td class="col-md-1">[:h.id:]</td>
            <td class="col-md-1">
                <span ng-repeat="l in SBase._.location.province |filter:{id: h.province_id}:equalsId">[:l.name:]</span>

                <span ng-repeat="l in SBase._.location.city |filter:{id: h.city_id }:equalsId">[:l.name :]</span>
            </td>
            <td class="col-md-1">[:h.name:]</td>
        </tr>
        </tbody>
    </table >
        <div class="col-md-12">
                <h3>相关设备</h3>
        </div>
    <table  class="table  table-striped  table-bordered dataTable  no-footer">
        <thead>
        <tr role="row">
            <th class="col-md-1">编号</th>
            <th class="col-md-1">销售方式</th>
            {{--<th class="col-md-1">销售状态</th>--}}
            <th class="col-md-1">医院编号</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="i in agency.robot_lease_log">
            <td class="col-md-1">[:i.id:]</td>
            <td class="col-md-1" ng-repeat="t in h.robot_lease_type | filter: {id: i.lease_type_id}:equalsId">[:t.name:]</td>
            {{--<td class="tar col-md-1">[:i.hospital_id:]</td>--}}
            <td class="col-md-1">[:i.hospital_id:]</td>
        </tr>
        </tbody>
    </table>
</div>
