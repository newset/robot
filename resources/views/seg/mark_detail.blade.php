<div class="seg agency_detial" ng-controller="CPageMark">
    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <th>编号</th>
            <td>[:SIns.current_row.cust_id:]</td>
        </tr>
        <tr>
            <th>状态</th>
            <td>
                <span ng-if="!SIns.current_row.sold_at">未卖出</span>
                <span ng-if="SIns.current_row.sold_at">已卖出</span>
                •
                <span ng-if="SIns.current_row.damaged_at">已损坏</span>
                <span ng-if="SIns.current_row.archive_at && !SIns.current_row.damaged_at">已归档</span>
                <span ng-if="SIns.current_row.used_at && !SIns.current_row.damaged_at && !SIns.current_row.archive_at">已使用</span>
                <span ng-if="!SIns.current_row.used_at && !SIns.current_row.damaged_at && !SIns.current_row.archive_at">未使用</span>
            </td>
        </tr>
        <tr>
            <th>更换Mark</th>
            <td>
                <span ng-if="SIns.current_row.replacement_id">[:SIns.current_row.replacement_id:]</span>
                <span ng-if="!SIns.current_row.replacement_id">无</span>
            </td>
        </tr>
        {{--<tr>--}}
            {{--<th>地区</th>--}}
            {{--<td>--}}
                {{--<span ng-repeat="l in SBase._.location.province |filter:{id: SIns.current_row.province_id}:true">[:l.name:]</span>•<span--}}
                        {{--ng-repeat="l in SBase._.location.city |filter:{id: SIns.current_row.city_id }:true">[:l.name :]</span>•--}}
                {{--<p>[:SIns.current_row.location_detail:]</p>--}}
            {{--</td>--}}
        {{--</tr>--}}
        <tr>
            <th>更换Mark</th>
            <td>[:SIns.current_row.replacement_id:]</td>
        </tr>
        <tr>
            <th>使用医生</th>
            <td>[:SIns.current_row.doctor_name:]</td>
        </tr>
        <tr>
            <th>代理商</th>
            <td>[:SIns.current_row.agency_name:]</td>
        </tr>
        <tr>
            <th>医院</th>
            <td>[:SIns.current_row.hospital_name:]</td>
        </tr>
        <tr>
            <th>销售日期</th>
            <td>[:SIns.current_row.sold_at:]</td>
        </tr>
        <tr>
            <th>病人</th>
            <td>-</td>
        </tr>
        <tr>
            <th>设备</th>
            <td>
                <span ng-if="SIns.current_row.robot_cust_id">[:SIns.current_row.robot_cust_id:]</span>
                <span ng-if="!SIns.current_row.robot_cust_id">-</span>
            </td>
        </tr>
        <tr>
            <th>手术类型</th>
            <td>
                <span ng-if="SIns.current_row.surgery_type">[:SIns.current_row.surgery_type:]</span>
                <span ng-if="!SIns.current_row.surgery_type">-</span>
            </td>
        </tr>
        <tr>
            <th>手术时间</th>
            <td>
                <span ng-if="SIns.current_row.surgery_at">[:SIns.current_row.surgery_at:]</span>
                <span ng-if="!SIns.current_row.surgery_at">-</span>
            </td>
        </tr>
        </tbody>
    </table>
</div>