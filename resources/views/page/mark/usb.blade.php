<div class="panel container" style="">
	<div class="panel-body">
		<div class="">
				<form class="form-inline" style="padding: 10px 20px;" action="{{usb_url('upload')}}" method="post" enctype="multipart/form-data">
					<div class="form-group pull-left">
						<input type="hidden" name="a" value="[:redirect:]">
						<input type="file" name="1" class="form-control">
					</div>
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-default pull-right">上传</button>
					</div>
					<div class="clearfix"></div>
				</form>
		</div>
		<hr>

		<div class="" id="resultUsb" style="padding:20px">
			
		</div>
		
	</div>

</div>
