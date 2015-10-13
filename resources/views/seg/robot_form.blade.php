<div class="">
	<div class="panel panel-default">
		<div class="panel-body">

			<div class="col-md-12">
				<h3 class="panel-title pull-left">设备信息</h3>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-12">
				<form ng-submit="SIns.cu_(SIns.current_row)"
							name="form_hospital"
							class="form-inline" 
							ng-init="SAgency.get_all_rec()"
							ng-controller="CPageRobot"
							id="robot_query">
						<div class="form-group md-select-group col-md-12 text-right">
								<label class="control-label col-md-1">租售状态</label>
								{{--[:SIns.current_row:]--}}
								<md-select name="lease_type" class="form-control pull-left"
												ng-model="SIns.current_row.lease_type_id"
												required>
									<md-option ng-value="l.id" ng-repeat="l in SIns.lease_type">[:l.name:]</md-option>
								</md-select>
								{{--<md-select class="form-control"--}}
												{{--name="province_id"--}}
												{{--ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"--}}
												{{--ng-model="SIns.current_row.province_id"--}}
												{{--ng-options="l.id as l.name for l in SBase._.location.province"--}}
												{{--required>--}}
						</div>
						<div class="form-group md-select-group col-md-12 text-right">
								<label class="control-label col-md-1">代理商</label>
								<md-select name="agency_id"  class="form-control pull-left"
												ng-model="SIns.current_row.agency_id"
												required>
									<md-option ng-value="l.id" ng-repeat="l in SAgency.all_rec">[:l.name:]</md-option>
							 	</md-select>
						</div>
						<div class="form-group md-select-group col-md-12 text-right">
								<label class="control-label col-md-1">医院</label>
								<md-select class="form-control pull-left"
												name="hospital_id"
												ng-model="SIns.current_row.hospital_id"
												required>
									<md-option ng-value="l.id" ng-repeat="l in SHospital.all_rec">[:l.name:]</md-option>
							 	</md-select>
						</div>
						<div class="form-group col-md-12 text-right">
								<label class="control-label col-md-1">起租时间</label>
								<datepicker class="pull-left text-left" style="width:auto;" date-format="yyyy-MM-dd">
									<input ng-model="SIns.current_row.lease_started_at"
												 type="text"
												 class="form-control"
												 required>
								</datepicker>
								<span class="pull-left">至</span>
								<datepicker class="pull-left text-left" style="width:auto;" date-format="yyyy-MM-dd">
									<input ng-model="SIns.current_row.lease_ended_at"
												 type="text"
												 class="form-control"
												 required>
								</datepicker>

						</div>
						<div class="form-group">
								<button type="submit" class="btn btn-primary" ng-disabled="form_hospital.$invalid">提交</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
