<div>
	<div class="panel panel-default">
		<div class="panel-body">
			 <h5 class="pull-left">修改代理商信息</h5>
			 <h5 class="pull-right">[:SIns.current_row.name:]</h5>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
		   <form method="get" accept-charset="utf-8" class="form-horizontal">
		   		<div class="form-group">
		   			<label class="col-md-1 control-label">重置密码</label>
		   			<div class="col-md-2">
	   					<input type="password" ng-model="password" class="form-control" name="" value="">
		   			</div>
		   		</div>
		   		<div class="form-group">
		   			<label class="col-md-1 control-label">代理期限</label>
		   			<div class="col-md-4">
	   					 <div style="display: inline-block;">
                            <datepicker selector="form-control" date-format="yyyy-MM-dd" date-max-limit="[:SIns.current_row.ended_at:]">
                                <div class="input-group">
                                	<input type="text" ng-model="SIns.current_row.started_at" class="form-control">
                                </div>
                            </datepicker>
                        </div>
                        <span style="display: inline-block;vertical-align: top;margin-top: 9px;">到</span>
                        <div style="display: inline-block;">
                            <datepicker selector="form-control" date-format="yyyy-MM-dd" date-min-limit="[:SIns.current_row.started_at:]">
                                <div class="input-group">
                                	<input type="text" ng-model="SIns.current_row.ended_at" class="form-control">
                                </div>
                            </datepicker>
                        </div>
		   			</div>
		   		</div>
		   		<div class="form-group">
		   			 <label class="control-label col-md-1">内部备忘</label>
		   			 <div class="col-md-6">
		   			 	<textarea name="" ng-model="SIns.current_row.memo" rows="10" cols="20" class="form-control"></textarea>
		   			 </div>
		   		</div>
		   		<div class="form-group text-right">
		   			<div class="col-md-7">
		   			    <a ui-sref="base.agency.detail({aid: SIns.current_row.id})" class="btn btn-default">取消</a>
		   				<!-- <a ui-sref="base.agency.detail({'id' : SIns.current_row.id})" class="btn btn-default">取消</a> -->
		   				<a href="" ng-click="save()" class="btn btn-primary">确定</a>
		   			</div>
		   		</div>
		   </form>
		</div>
	</div>
</div>