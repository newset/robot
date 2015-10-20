<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h3 class="panel-title">新建医生</h3>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel-default panel" style="padding:0px">
		<div class="panel-body">
			<form name="form_doctor" class="form-horizontal col-md-8">

				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">姓名</label>
						<div class="col-md-8">
							<input ng-model="SIns.current_row.name"
								   class="form-control"
								   style="width: auto;display: inline-block;"
								   required>
							<select class="form-control"
								ng-model="SIns.current_row.gender"
								chosen
								ng-options="l.id as l.name for l in [{id: 1, name: '男'}, {id: 0, name: '女'}]"
								ng-init="SIns.current_row.gender = SIns.current_row.gender" style="display: inline-block;width: 60px;" required>
							</select> 
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">识别码</label> 
						<div class="col-md-8">
							<input ng-model="SIns.current_row.cust_id"
		                     	name="cust_id"
							   	class="form-control"
							   	la-exist="doctor.cust_id"
							   	required>
							   	<br>
              				<button type="button" class="btn btn-info inline-btn" ng-click="getLastId()">重新生成</button>
						</div>   
              			<label class="error absolute-label" ng-if="form_doctor.cust_id.$error.laExist">编号已存在</label>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">所在医院</label> 
						<div class="col-md-8">
							<select class="form-control"
									name="city_id"
									chosen
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
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">科室</label> 
						<div class="col-md-8">
							<select class="form-control"
									name="city_id"
									chosen
									update="SIns.departments"
									ng-model="SIns.current_row.department_id"
									ng-options="l.id as l.name for l in SIns.departments"
									required>
								<option value="">无</option>
							</select>
						</div>    
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">级别</label> <div class="col-md-8">
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
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">职务</label> 
						<div class="col-md-8">
						<input ng-model="SIns.current_row.title"
							   class="form-control"
							   required>
						</div>    
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">电话</label> <div class="col-md-8">
						<input ng-model="SIns.current_row.phone"
							   class="form-control"
							   required>
						</div>    
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label col-md-3">Email</label> <div class="col-md-8">
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
