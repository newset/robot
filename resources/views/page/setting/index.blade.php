<div class="panel panel-default">
	<div class="panel-body">
	   	<h5>用户配置</h5>
	   	<hr>
		<div class="col-md-6">
			
		</div>

		@if( he_is('employee') && username() == 'admin')
	   	<h5>系统配置</h5>
	   	<hr>
		<div class="col-md-6">
			
		</div>
	   @endif
	</div>
</div>