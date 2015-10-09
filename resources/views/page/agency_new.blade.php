<div class="container panel panel-default" style="padding:0px;">
	<div class="panel-heading">
		<h3 class="panel-title">注册代理商</h3>
	</div>
	<div class="panel-body">
		<form ng-submit="SIns.cu(SIns.current_row)"
			class="form-horizontal" 
		      name="form_hospital"
		      ng-controller="CPageAgency">
	  
		    <div class="form-group">
		        <label class="control-label col-md-1">登录名</label>
		        <div class="col-md-10">
		        	
		        <input ng-model="SIns.current_row.username"
		               class="form-control"
		               required>
		        </div>
		    </div>
		    <div class="form-group">
	            <label class="control-label col-md-1">密码</label>
	            <div class="col-md-10">
	            	
	            <input ng-model="SIns.current_row.password"
	                   ng-init="SIns.current_row.password = ''"
	                   type="password"
	                   class="form-control">
	            </div>
		    </div>
		    <div class="form-group">
		            <label class="control-label col-md-1"></label>
		            <div class="col-md-10">
		            	
		            <input ng-model="SIns.current_row.password"
		                   ng-init="SIns.current_row.password = ''"
		                   type="password"
		                   class="form-control">
		        </div>
		    </div>
			<div class="form-group">
		        <label class="control-label col-md-1">公司名称</label>
		        <div class="col-md-10">
		        	
		        <input {{--ng-model="SIns.current_row.name"--}}
		                disabled
		               class="form-control"
		               required>
		        </div>

		    </div>
		    <div class="form-group row">
		        <div class="form-group col-md-6">
		            <label class="control-label col-md-2">所在省</label>
		            <div class="col-md-3">
			            <select class="form-control"
			                    name="province_id"
			                    ng-init="SIns.current_row.province_id = SIns.current_row.province_id || options[0].id"
			                    ng-model="SIns.current_row.province_id"
			                    ng-options="l.id as l.name for l in SBase._.location.province"
			                    required>
			                {{--<option value="">所在省市</option>--}}
			            </select>
					</div>
		            <div class="col-md-3">
			             <select class="form-control"
			                    name="city_id"
			                    ng-init="SIns.current_row.city_id = SIns.current_row.city_id || options[0].id"
			                    ng-model="SIns.current_row.city_id"
			                    ng-options="l.id as l.name for l in SBase._.location.city | filter: {parent_id: SIns.current_row.province_id}:true"
			                    required>
			                {{--<option value="">所在省份</option>--}}
			            </select>
		            </div>
		        </div>
		        <div class="form-group col-md-6">
		            <label class="control-label col-md-2"></label>
		            <div class="col-md-4">
		            {{--[:SIns.current_row:]--}}
		           
		            </div>
		        </div>
		    </div>
		     <div class="form-group">
		        <label class="control-label col-md-1">联系地址</label>
		        <div class="col-md-10">
		        	
		        <input ng-model="SIns.current_row.name_in_charge"
		               class="form-control"
		               required>
		        </div>
		    </div>
		      <div class="form-group">
		        <label class="control-label col-md-1">联系人</label>
		        <div class="col-md-10">
		        	
		        <input ng-model="SIns.current_row.name_in_charge"
		               class="form-control"
		               required>
		        </div>
		    </div>
		     <div class="form-group">
		        <label class="control-label col-md-1"></label>
		        <div class="col-md-10">
		        	
		        <input ng-model="SIns.current_row.phone"
		               type="number"
		               class="form-control"
		               placeholder="电话"
		               required>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="control-label col-md-1"></label>
		        <div class="col-md-10">
		        	
		        <input ng-model="SIns.current_row.email"
		               class="form-control"
		               placeholder="Email"
		               required>
		        </div>
		    </div>
		     <div class="form-group">
		     	<div class="col-md-10 col-md-offset-1">
		     		注： 所以项必须填写
		     	</div>
		     </div>
		     <div class="checkbox">
			    <label class="col-md-offset-1">
			      <input type="checkbox"> 我已经阅读并同意 <a href="" title="">用户使用条款</a>
			    </label>
			  </div>
		    <div class="form-group">
		        <button type="submit" class="btn btn-primary pull-right" style="margin-right:40px" ng-disabled="form_hospital.$invalid">确认注册</button>
		    </div>
		</form>
	</div>
</div>