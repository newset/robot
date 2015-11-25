<div class="panel panel-default">
	<div class="panel-body">
		<form method="get" accept-charset="utf-8" class="form-inline">
			<label class="control-label">发送给</label>
			@if(he_is('employee'))
			<select name="recipientname" chosen class="form-control col-md-1" ng-model="data.recipienttype" data-placeholder=" ">
				@if(username() =='admin')
				<option value="agency">代理商</option>
				<option value="doctor">医生</option>
				@endif
				<option value="employee">员工</option>
			</select>

			<select name="recipientid" ng-model="recipient" 
				ng-change="data.recipientid=recipient.id;data.recipientname=recipient.name"
				ng-options="l as l.name for l in users" 
				chosen update="users" class="form-control col-md-4" data-placeholder=" ">
				<option value="">请选择</option>
			</select>
			@elseif(he_is('agency'))
				Admin
			@endif
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<form class="form-horizontal col-md-12">
			<div class="form-group">
			   <textarea name="" class="form-control" rows="10" ng-model="data.messagecontent"></textarea>
			</div>
			<div class="form-group text-right">
				<button type="button" class="btn btn-primary" ng-click="send()">发送</button>
			</div>
		</form>
	</div>
</div>