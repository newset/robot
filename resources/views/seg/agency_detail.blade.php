<div class="panel panel-default" >
    <div class="panel-body">
        <!-- <h3 class="panel-title pull-right">[:SIns.status(agency):]</h3> -->
        <h3 class="panel-title pull-left">[:SIns.current_row.name:]</h3>
        <!-- 禁用 -->
        <a href="" ng-click="toggle()" class="btn pull-right" ng-class="{'btn-danger': SIns.current_row.status == 1, 'btn-primary': SIns.current_row.status != 1}">
            <span ng-show="SIns.current_row.status == 1">禁用</span>
            <span ng-show="SIns.current_row.status != 1">启用</span>
        </a>
    </div>
</div>

<div class="panel panel-default" ng-cloak>
    <div class="panel-heading">
        <h3 class="panel-title text-left">
             基本信息
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt class="tar">名称</dt>
                <dd>[:SIns.current_row.name:]</dd>
            
                <dt class="tar">地区</dt>
                <dd ng-show="SIns.current_row.province_id && SIns.current_row.city_id">
                    <span ng-repeat="l in SBase._.location.province |filter:{id: SIns.current_row.province_id}:true">[:l.name:]</span> 
                    <span ng-repeat="l in SBase._.location.city |filter:{id: SIns.current_row.city_id }:true">[:l.name :]</span>
                    <p>[:SIns.current_row.location_detail:]</p>
                </dd>
                <dt class="tar">联系人</dt>
                <dd>[:SIns.current_row.name_in_charge:]</dd>
                <dt class="tar">电话</dt>
                <dd>[:SIns.current_row.phone:]</dd>
                <dt class="tar">Email</dt>
                <dd>[:SIns.current_row.email:]</dd>
                <dt  class="tar">状态</dt>
                <dd> [:SIns.status(agency):]</dd>
                <dt class="tar">代理权</dt>
                <dd>[:SIns.current_row.started_at:]--[:SIns.current_row.ended_at:]</dd>
                @if(he_is('employee'))
                <dt class="tar">备注</dt>
                <dd title="[:row.memo:]">[:row.memo | cut:true:10 :]</dd>
                @endif
            </dl>
        </div>
        <div class="col-md-12 text-right">
            <a ui-sref="base.agency.edit({id : SIns.current_row.id})" title="修改" class="btn btn-primary">修改</a>
        </div>
    </div>
        
    <div class="panel-heading">
        <h3 class="panel-title text-left">
             销售情况
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <dl class="dl-horizontal">
                <dt class="tar col-md-1">累计销售设备</dt>
                <span class="hidden"
                      ng-repeat="log in robot_sold = (SIns.current_row.robot_lease_log | filter:{lease_type_id: 3})">
                </span>
                <dd>[:robot_sold.length:]</dd>
            
                <dt class="tar col-md-1">累计出租设备</dt>
                <span class="hidden"
                      ng-repeat="log in robot_leased = (SIns.current_row.robot_lease_log | filter:{lease_type_id: 2})">
                </span>
                <dd>[:robot_leased.length:]</dd>
            
                <dt class="tar col-md-1">累计销售Mark</dt>
                <span class="hidden"   ng-repeat="log in mark_sold = (SIns.current_row.mark | filter:{status: 3})">
                </span>
                <dd>[:mark_sold.length:]</dd>
            
                <dt class="tar col-md-1">库存Mark</dt>
                <dd>[:SIns.current_row.mark.length:]</dd>
            </dl>
        </div>
    </div>
    <div class="panel-heading">
        <h3 class="panel-title text-left">
             相关医院
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                <tr role="row" class="info">
                    <th class="col-md-1">编号</th>
                    <th class="col-md-1">地区</th>
                    <th class="col-md-1">名称</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="h in SIns.current_row.hospital">
                    <td class="col-md-1">[:h.cust_id:]</td>
                    <td class="col-md-1">
                        <span ng-repeat="l in SBase._.location.province |filter:{id: h.province_id}:equalsId">[:l.name:]</span>

                        <span ng-repeat="l in SBase._.location.city |filter:{id: h.city_id }:equalsId">[:l.name :]</span>
                    </td>
                    <td class="col-md-1">[:h.name:]</td>
                </tr>
                </tbody>
            </table >
        </div>
    </div>
    <div class="panel-heading">
        <h3 class="panel-title text-left">
             相关设备
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <table  class="table  table-striped  table-bordered table-hover dataTable  no-footer">
                <thead>
                <tr role="row" class="info">
                    <th class="col-md-1">编号</th>
                    <th class="col-md-1">设备状态</th>
                    <th class="col-md-1">销售方式</th>
                    {{--<th class="col-md-1">销售状态</th>--}}
                    <th class="col-md-1">医院</th>
                    <th class="col-md-1">租赁期</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="i in SIns.current_row.robot_lease_log">
                    <td class="col-md-1">[:i.cust_id:]</td>
                    <td class="col-md-1">[:SRobot.robot_action_type[i.status].name:]</td>
                    <td class="col-md-1" ng-repeat="t in h.robot_lease_type | filter: {id: i.lease_type_id}:equalsId">[:t.name:]</td>
                    {{--<td class="tar col-md-1">[:i.hospital_id:]</td>--}}
                    <td class="col-md-1">[:i.name:]</td>
                    <td class="col-md-1"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
