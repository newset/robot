<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title">
				修改设备租售状态
				<a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="pull-right"> 编号 : [:SIns.current_row.cust_id:]</a>
			</h3>
		</div>
	</div>

	<!-- body -->
	<div class="panel panel-default">
		<div class="panel-body">
			<form
				name="form_robot"
				ng-init="SEmployee.r({limit: 0}); "
				class="col-md-12 form-horizontal" style="float:none;">
					
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-2">设置状态</label>
						<div class="col-md-6">
							<label class="radio-inline">
								<input type="radio" ng-model="data.lease_type_id"  ng-click="data.agency_id=undefined" value="2">出租
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.lease_type_id"  ng-click="data.agency_id=undefined" value="1"  ng-checked="true">出售
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.lease_type_id"  ng-click="data.agency_id=1" value="3">免费合作
							</label>
							<label class="radio-inline">
								<input type="radio" ng-model="data.lease_type_id"  ng-click="data.agency_id=-1" value="-1">返回库存
							</label>
						</div>
					</div>
				</div>
				<div class="row" ng-hide="data.lease_type_id == 3 || data.lease_type_id == -1">
					<div class="form-group">
						<label class="control-label col-md-2">代理商</label>
						<div class="col-md-2">
							<select name="agency" data-placeholder="" class="form-control" ng-model="data.agency_id" chosen ng-options="l.id as l.name for l in SAgency.all_rec">
								<option value="">不限</option>
							</select>
						</div>
					</div>	
				</div>
				<div class="row" ng-hide="data.lease_type_id == -1">
					<div class="form-group">
						<label class="control-label col-md-2">医院</label>
						<div class="col-md-2">
							<select name="agency" data-placeholder="" class="form-control" ng-model="data.hospital_id" chosen ng-options="l.id as l.name for l in SHospital.all_rec">
								<option value="">不限</option>
							</select>
						</div>
					</div>	
				</div>
				<div class="row" ng-if="data.lease_type_id == 2 || data.lease_type_id == 3">
					<div class="form-group">
						<label class="control-label col-md-2">起租时间</label>
						<div class="col-md-8">
							<div style="display: inline-block;">
	                            <datepicker date-format="yyyy-MM-dd" date-max-limit="[:data.lease_ended_at:]" selector="form-control" date-set="[:data.lease_started_at:]">
	                                <div class="input-group"><input type="text" ng-model="data.lease_started_at" class="form-control"></div>
	                            </datepicker>
	                        </div>
	                        <span style="display: inline-block;vertical-align: top;margin-top: 9px;">到</span>
	                        <div style="display: inline-block;">
	                            <datepicker date-format="yyyy-MM-dd" date-set="[:data.lease_ended_at:]" selector="form-control" date-min-limit="[:data.lease_started_at:]">
	                                <div class="input-group"><input type="text" ng-model="data.lease_ended_at" class="form-control"></div>
	                            </datepicker>
	                        </div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-2">备注</label>
						<div class="col-md-6">
							<textarea name="" ng-model="data.memo" class="col-md-6 form-control" rows="8"></textarea>
						</div>
					</div>
				</div>

				<div class="form-group text-right">
					<a ui-sref="base.robot.detail({id: SIns.current_row.id})" class="btn btn-default">取消</a>
					<button type="submit" ng-click="lease()" class="btn btn-info">设置</button>
			  	</div>
			</form>
		</div>
	</div>
</div>