@if(he_is('employee'))
<!--tiles start-->
<div class="row">
	@if(sess('permission')[0])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.robot.home">
		<div class="dashboard-tile detail tile-turquoise">
			<div class="content">
				<h1><img src="../assets/img/grid/01.png" alt=""> 设备管理</h1>
			</div>
		</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[1])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.mark.query({with_search: 1})">
			<div class="dashboard-tile detail tile-gray">
				<div class="content">
					<h1><img src="../assets/img/grid/02.png" alt="">Mark管理 </h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[2])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.agency.todo">
			<div class="dashboard-tile detail tile-blue">
				<div class="content">
					<h1><img src="../assets/img/grid/03.png" alt="">代理商管理 </h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[3])
	<div class="col-md-4 col-sm-6">
		<a ui-sref-opts="{reload:true}" ui-sref="base.hospital.list({with_search: 1})">
			<div class="dashboard-tile detail tile-default">
				<div class="content">
					<h1><img src="../assets/img/grid/04.png" alt="">医院管理 </h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[4])
	<div class="col-md-4 col-sm-6">
		<a ui-sref-opts="{reload:true}" ui-sref="base.doctor.list({with_search: 1})" >
		<div class="dashboard-tile detail tile-blue">
			<div class="content">
				<h1><img src="../assets/img/grid/05.png" alt="">医生管理</h1>
			</div>
		</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[5])
	<div class="col-md-4 col-sm-6">
		<a href="">
			<div class="dashboard-tile detail tile-green">
				 <div class="content">
					<h1><img src="../assets/img/grid/06.png" alt="">病患管理</h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[6])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.employee.list">
			<div class="dashboard-tile detail tile-red">
				<div class="content">
					<h1><img src="../assets/img/grid/07.png" alt="">员工管理 </h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[7])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.log.list">
			<div class="dashboard-tile detail tile-purple">
				 <div class="content">
					<h1><img src="../assets/img/grid/08.png" alt="">日志查看</h1>
				</div>
			</div>
		</a>
	</div>
	@endif
	@if(sess('permission')[8])
	<div class="col-md-4 col-sm-6">
		<a ui-sref="base.setting.index">
			<div class="dashboard-tile detail tile-yellow">
				 <div class="content">
					<h1><img src="../assets/img/grid/09.png" alt="">系统配置</h1>
				</div>
			</div>
		</a>
	</div>
	@endif
</div>
<!--tiles end-->
@endif

@if(he_is('department'))
	@include('page.home.department')
@endif
@if(he_is('agency'))
	@include('page.home.agency')
@endif
