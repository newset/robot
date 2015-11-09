
<div class="container-fluid" ng-cloak>
	<div class="panel panel-default">
		<div class="panel-body">
			<b>Mark 详情</b>
			@if(he_is('employee'))
			<div class="pull-right" ng-init="agency =-1">
				<button type="button" class="btn btn-primary no-animate" ng-click="bind()" ng-show="SIns.current_row.agency_id == -1">绑定</button>
				<button type="button" class="btn btn-primary no-animate" ng-click="unbind()" ng-show="SIns.current_row.agency_id != -1">解绑</button>
				
				<button type="button" class="btn btn-primary" ng-click="recycle()" ng-disabled="SIns.current_row.status != 1">损坏报废</button>
				<button type="button" class="btn btn-primary" ng-click="replace()" ng-disabled="SIns.current_row.status != 1">损坏更新</button>
			</div>
			@endif
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
				<dt>编码</dt>
				<dd>[:SIns.current_row.cust_id:]</dd>
				<dt>销售状态</dt>
				<dd>
					<span ng-if="SIns.current_row.agency_id==-1 && SIns.current_row.hospital_id==-1">在库</span>
                	<span ng-if="SIns.current_row.agency_id!=-1 && SIns.current_row.hospital_id==-1">代理商在库</span>
                	<span ng-if="SIns.current_row.hospital_id!=-1 && SIns.current_row.hospital_id!=-1">已售出</span>
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
	                <span ng-if="SIns.current_row.cmid">[:SIns.current_row.cmid:]</span>
	                <span ng-if="!SIns.current_row.cmid">无</span>
	            </dd>
	            <dt>生产日期</dt>
	            <dd>[:SIns.current_row.created_at | laDate:]</dd>
	            <dt>损坏日期</dt>
	            <dd>[:SIns.current_row.damaged_at | laDate:]</dd>
			</dl>
		</div>
	</div>
	<!-- <div class="panel panel-default">
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
	                <td>[:SIns.current_row.doctor_name:]</td>
	            </dd>
			</dl>
		</div>
	</div> -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				销售信息
			</h3>
		</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
	            <dt>经销商</dt>
	            <dd>
	               <span ng-if="SIns.current_row.agency_id != -1">[:SIns.current_row.agency.name:]</span>
	               <span ng-if="SIns.current_row.agency_id == -1">无</span>
                </dd>
	            <dt>销售状态</dt>
	            <dd>
					<span ng-if="SIns.current_row.agency_id==-1 && SIns.current_row.hospital_id==-1">在库</span>
                	<span ng-if="SIns.current_row.agency_id!=-1 && SIns.current_row.hospital_id==-1">代理商在库</span>
                	<span ng-if="SIns.current_row.hospital_id!=-1 && SIns.current_row.hospital_id!=-1">已售出</span>
			    </dd>
			    <dt>出货日期</dt>
	            <dd>[:SIns.current_row.shipped_at | laDate:]</dd>
	            <dt>销售医院</dt>
	            <dd>
	               <span ng-if="SIns.current_row.hospital_id">[:SIns.current_row.hospital_name:]</span>
	               <span ng-if="!SIns.current_row.hospital_id">无</span>
                </dd>
	            <dt>销售日期</dt>
	            <dd ng-if="SIns.current_row.sold_at">[:SIns.current_row.sold_at | laDate:]</dd>
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
	            @if(he_is('employee'))
	            <dt>病人</dt>
	            <dd>
	               <span ng-if="SIns.current_row.patient_name">[:SIns.current_row.patient_name:]</span>
	               <span ng-if="!SIns.current_row.patient_name && SIns.current_row.status==2">尚未提取</span>
	               <span ng-if="!SIns.current_row.patient_name && SIns.current_row.status!=2">无</span>
                </dd>
                @endif
                <dt>使用者</dt>
	            <dd>
	               <span ng-if="SIns.current_row.doctor_id">[:SIns.current_row.doctor.name:]</span>
	               <span ng-if="!SIns.current_row.doctor_id">尚未提取</span>
                </dd>
	            <dt>使用设备</dt>
	            <dd>
	                <span ng-if="SIns.current_row.robot_id">[:SIns.current_row.robot_id:]</span>
	               <span ng-if="!SIns.current_row.robot_id && SIns.current_row.status==2">尚未提取</span>
	               <span ng-if="!SIns.current_row.robot_id && SIns.current_row.status!=2">无</span>
	            </dd>
	            <dt>扫码日期</dt>
	            <dd>
	                [:SIns.current_row.used_at | laDate:]
	            </dd>
	            <dt>手术日期</dt>
	            <dd>
	                [:SIns.current_row.surgery_at | laDate:]
	            </dd>
	            <dt>归档日期</dt>
	            <dd>
	                [:SIns.current_row.archive_at | laDate:]
	            </dd>
	        </dl>
		</div>
	</div>
</div>

<script type="text/ng-template" id="mark_bind_agency">
	<div class="">
		<div class="panel panel-default">
			<div class="panel-body">
				<br>
			    <form action="" method="get" class="form-inline" accept-charset="utf-8">
			    	<div class="form-group">
			    		<label for="">代理商</label>
			    		<select 
			    			name="agency" 
			    			ng-model="agency_id" 
			    			style="width:200px;"
			    			chosen
			    			update="SAgency.all_rec" 
			    			ng-options="l.id as l.name for l in SAgency.all_rec" 
			    			class="form-control chosen"
			    			>
			    			<option value="">请选择</option>
			    		</select>
			    	</div>
			    </form>
			    <br>
			</div>
			<div class="panel-heading text-right">
				<button type="button" class="btn btn-primary" ng-click="bind('bind', agency_id)">确定</button>
			<button type="button" class="btn btn-default" ng-click="close()">取消</button>
			</div>
		</div>
	</div>
</script>
<script type="text/ng-template" id="mark_replace_agency">
	<div class="panel panel-default">
		<div class="panel-body">
			 <form action="" method="get" class="form-inline" accept-charset="utf-8">
		    	<div class="form-group">
		    		<label for="">后续Mark ID</label>
		    		<input type="text" class="form-control" placeholder="" ng-model="cmid">
                    <label for="" class="error" ng-if="isError">mark输入错误</label>
		    	</div>
			</form>
		</div>
		<div class="panel-heading text-right">
			<button type="button" class="btn btn-primary" ng-click="replace()">确定</button>
			<button type="button" class="btn btn-default" ng-click="close()">取消</button>
		</div>
	</div>
</script>
<script type="text/ng-template" id="mark_recycle_agency">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>确认Mark [:data.mark:]已损坏报废?</h4>
		</div>
		<div class="panel-heading text-right">
			<button type="button" class="btn btn-primary" ng-click="recycle()">确定</button>
			<button type="button" class="btn btn-default" ng-click="close()">取消</button>
		</div>
	</div>
</script>
<script type="text/ng-template" id="mark_unbind_agency">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>确认解除绑定Mark [:data.mark:]?</h4>
		</div>
		<div class="panel-heading text-right">
			<button type="button" class="btn btn-primary" ng-click=" bind('unbind')">确定</button>
			<button type="button" class="btn btn-default" ng-click="close()">取消</button>
		</div>
	</div>
</script>