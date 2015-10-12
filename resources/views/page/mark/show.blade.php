<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			<b>Mark 详情</b>
			<div class="pull-right">
				<button type="button" class="btn btn-primary">绑定/解绑</button>
				<button type="button" class="btn btn-primary">损坏报废</button>
				<button type="button" class="btn btn-primary">损坏更新</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				基本信息
			</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
				<dt>编号</dt>
				<dd>[:SIns.current_row.cust_id:]</dd>
				<dt>销售状态</dt>
				<dd>
					<span ng-if="row.agency_id==-1 && row.hospital_id==-1">在库</span>
                	<span ng-if="row.agency_id!=-1 && row.hospital_id==-1"">出货</span>
                	<span ng-if="row.hospital_id != -1">已售</span>
			    </dd>
				<dt>使用状态</dt>
				<dd>
	                <span ng-if="SIns.current_row.status == 1">未使用</span>
                    <span ng-if="SIns.current_row.status == 2">使用完毕</span>
                    <span ng-if="SIns.current_row.status == 3">损坏报废</span>
                    <span ng-if="SIns.current_row.status == 4">损坏更新</span>
				</dd>
				<dt>更换Mark</dt>
	            <dd>
	                <span ng-if="SIns.current_row.replacement_id">[:SIns.current_row.replacement_id:]</span>
	                <span ng-if="!SIns.current_row.replacement_id">无</span>
	            </dd>
			</dl>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				使用信息
			</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
				
				<dt>使用状态</dt>
				<dd>
					<span ng-if="SIns.current_row.status == 1">未使用</span>
                    <span ng-if="SIns.current_row.status == 2">使用完毕</span>
                    <span ng-if="SIns.current_row.status == 3">损坏报废</span>
                    <span ng-if="SIns.current_row.status == 4">损坏更新</span>
				</dd>
				<dt>使用者</dt>
	            <dd>
	                <span ng-if="SIns.current_row.replacement_id">[:SIns.current_row.replacement_id:]</span>
	                <td>[:SIns.current_row.doctor.name:]</td>
	            </dd>
			</dl>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				销售信息
			</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
	            <dt>经销商</dt>
	            <dd>[:SIns.current_row.agency.name:]</dd>
	            <dt>销售状态</dt>
	            <dd>销售在库</dd>
	            <dt>销售医院</dt>
	            <dd>[:SIns.current_row.hospital_name:]</dd>
	            <dt>销售日期</dt>
	        </dl>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				手术信息
			</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
	            <dt>病人</dt>
	            <dd>-</dd>
	            <dt>设备</dt>
	            <dd>
	                <span ng-if="SIns.current_row.robot_cust_id">[:SIns.current_row.robot_cust_id:]</span>
	                <span ng-if="!SIns.current_row.robot_cust_id">-</span>
	            </dd>
	            <dt>手术时间</dt>
	            <dd>
	                <span ng-if="SIns.current_row.surgery_at">[:SIns.current_row.surgery_at:]</span>
	                <span ng-if="!SIns.current_row.surgery_at">-</span>
	            </dd>
	        </dl>
		</div>
	</div>
</div>