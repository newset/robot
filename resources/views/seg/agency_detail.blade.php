<div class="seg agency_detial" ng-controller="CPageAgency">
    <h3>代理商[:SIns.current_row.name:]详情</h3>
    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <th class="tar">状态</th>
            <td>[:SIns.status(SIns.current_row):]</td>
        </tr>
        <tr>
            <th class="tar">编号</th>
            <td>[:SIns.current_row.id:]</td>
        </tr>
        <tr>
            <th class="tar">公司</th>
            <td>[:SIns.current_row.name:]</td>
        </tr>
        <tr>
            <th class="tar">地区</th>
            <td>
                <span ng-repeat="l in SBase._.location.province |filter:{id: SIns.current_row.province_id}:true">[:l.name:]</span>•<span
                        ng-repeat="l in SBase._.location.city |filter:{id: SIns.current_row.city_id }:true">[:l.name :]</span>•
                <p>[:SIns.current_row.location_detail:]</p>
            </td>
        </tr>
        <tr>
            <th class="tar">负责人</th>
            <td>[:SIns.current_row.name_in_charge:]</td>
        </tr>
        <tr>
            <th class="tar">手机号</th>
            <td>[:SIns.current_row.phone:]</td>
        </tr>
        <tr>
            <th class="tar">邮箱</th>
            <td>[:SIns.current_row.email:]</td>
        </tr>
        <tr>
            <th class="tar">开始时间</th>
            <td>[:SIns.current_row.started_at:]</td>
        </tr>
        <tr>
            <th class="tar">结束时间</th>
            <td>[:SIns.current_row.ended_at:]</td>
        </tr>
        <tr>
            <th class="tar">备注</th>
            <td title="[:row.memo:]">[:row.memo | cut:true:10 :]</td>
        </tr>
        </tbody>
    </table>
    <h3>销售情况</h3>
    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <th class="tar col-md-1">累计销售设备</th>
            <span class="hidden"
                  ng-repeat="log in robot_sold = (SIns.current_row.robot_lease_log | filter:{lease_type_id: 3})">
            </span>
            <td>[:robot_sold.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">累计出租设备</th>
            <span class="hidden"
                  ng-repeat="log in robot_leased = (SIns.current_row.robot_lease_log | filter:{lease_type_id: 2})">
            </span>
            <td>[:robot_leased.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">累计销售Mark</th>
            <span class="hidden"
                  ng-repeat="log in mark_sold = (SIns.current_row.mark | filter:{status: 3})">
            </span>
            <td>[:mark_sold.length:]</td>
        </tr>
        <tr>
            <th class="tar col-md-1">库存Mark</th>
            <td>[:SIns.current_row.mark.length:]</td>
        </tr>
        </tbody>
    </table>
    <h3>相关医院</h3>
    <table>
        <thead>
        <tr role="row">
            <th class="col-md-1">编号</th>
            <th class="col-md-1">地区</th>
            <th class="col-md-1">名称</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="h in SIns.current_row.hospital">
            <td class="col-md-1">[:h.id:]</td>
            <td class="col-md-1">
                <span ng-repeat="l in SBase._.location.province |filter:{id: h.province_id}:true">[:l.name:]</span>
                •
                <span ng-repeat="l in SBase._.location.city |filter:{id: h.city_id }:true">[:l.name :]</span>
            </td>
            <td class="col-md-1">[:h.name:]</td>
        </tr>
        </tbody>
    </table>
    <h3>相关医院</h3>
    <table>
        <thead>
        <tr role="row">
            <th class="col-md-1">编号</th>
            <th class="col-md-1">销售方式</th>
            {{--<th class="col-md-1">销售状态</th>--}}
            <th class="col-md-1">医院编号</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="i in SIns.current_row.robot_lease_log">
            <td class="col-md-1">[:i.id:]</td>
            <td class="col-md-1" ng-repeat="t in h.robot_lease_type | filter: {id: i.lease_type_id}:true">[:t.name:]</td>
            {{--<td class="tar col-md-1">[:i.hospital_id:]</td>--}}
            <td class="col-md-1">[:i.hospital_id:]</td>
        </tr>
        </tbody>
    </table>
</div>