<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title" ng-if="!SIns.current_row.id">新建医生</h3>
			<h3 class="panel-title" ng-if="SIns.current_row.id">编辑医生</h3>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel-default panel" style="padding:0px">
		<div class="panel-body">
			<form name="form_doctor" class="form-horizontal col-md-8">

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">姓名</label>
						<div class="col-md-8">
							<input ng-model="SIns.current_row.name"
								   class="form-control"
								   style="width: auto;display: inline-block;"
								   required>
							<p><br></p>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" ng-model="SIns.current_row.gender"> 男
							</label>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0" ng-model="SIns.current_row.gender"> 女
							</label>

						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">识别码</label> 
						<div class="col-md-4">
							<input ng-model="SIns.current_row.cust_id"
		                     	name="cust_id"
							   	class="fix-form-control form-control" 
							   	required>
              				<button type="button" class="btn btn-primary inline-btn" ng-click="getLastId()">重新生成</button>
						</div>   
              			<label class="error absolute-label" ng-if="form_doctor.cust_id.$error.laExist">编号已存在</label>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">所在医院</label> 
						<div class="col-md-4">
							<select class="form-control"
									name="city_id"
									chosen
									ng-disabled="createForHopistal"
									update="SIns.all_hospital || createForHopistal || currentHospital"
									ng-change="get_department()"
									ng-model="SIns.current_row.hospital_id"
									ng-options="l.id as l.name for l in SIns.all_hospital"
									required>
								<option value="">选择医院</option>
							</select>
						</div>    
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">科室</label> 
						<div class="col-md-4">
							<select class="form-control"
									name="city_id"
									chosen
									update="SIns.departments"
									ng-model="SIns.current_row.department_id"
									ng-options="l.id as l.name for l in SIns.departments"
									>
								<option value="">无</option>
							</select>
						</div>    
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">级别</label> <div class="col-md-4">
						<select class="form-control"
								chosen
								ng-model="SIns.current_row.level"
								ng-options="l.id as l.name for l in
									[
										{id: 1, name: '1级'},
										{id: 2, name: '2级'},
										{id: 3, name: '3级'},
										{id: 4, name: '4级'},
										{id: 5, name: '5级'},
									]">
							<option value="">请选择</option>
						</select>    
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">职务</label> 
						<div class="col-md-4">
						<input ng-model="SIns.current_row.title"
							   class="form-control"
							   required>
						</div>    
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">状态</label> 
						<div class="col-md-4">
							<select class="form-control"
								chosen
								ng-model="SIns.current_row.status"
								ng-options="l.id as l.name for l in
									[
										{id: 0, name: '正常未培训'},
										{id: 1, name: '培训完毕未绑定微信'},
										{id: 2, name: '绑定微信'},
									]">
								<option value="">请选择</option>
							</select>  
						</div>    
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">电话</label> <div class="col-md-4">
						<input ng-model="SIns.current_row.phone"
							   class="form-control"
							   required>
						</div>    
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label col-md-2">Email</label> <div class="col-md-4">
						<input ng-model="SIns.current_row.email"
							   class="form-control"
							   required>
					</div>    </div>
				</div>

				<div class="form-group col-md-12">
					<button class="btn btn-info pull-right" ng-disabled="form_doctor.$invalid" ng-click="save(SIns.current_row)">确定</button>
				</div>
			</form>
		</div>
	</div>

</div>
