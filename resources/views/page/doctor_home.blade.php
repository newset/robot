@include('seg.head')

<div class="container page doctor_home" ng-app="doctor_app" ng-controller="CBase">
    <h1>首页</h1>

    <div class="button_wrapper">
        <button class="btn btn-default" id="scan_mark">上报Mark</button>
        <br>
        <a class="btn btn-default" href="{{URL::to('doctor/history')}}">查看历史</a>
        <br>
        @if(debugging())
            <a class="btn btn-default" href="{{URL::to('/$/auth/logout')}}">登出</a>
        @endif
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" charset="utf-8">
    var conf = <?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo'), true, true) ?>;
</script>
<script src="{{base_url() . 'node_modules/jquery/dist/jquery.js'}}"></script>
<script src="{{base_url() . 'node_modules/angular/angular.js'}}"></script>
<script src="{{base_url() . 'node_modules/nprogress/nprogress.js'}}"></script>
<script src="{{base_url() . 'node_modules/toastr/toastr.js'}}"></script>
<script src="{{base_url() . 'node_modules/moment/min/moment.min.js'}}"></script>
<script src="{{base_url() . 'node_modules/angular-ui-router/release/angular-ui-router.js'}}"></script>
<script src="{{base_url() . 'node_modules/angular-bootstrap/ui-bootstrap-tpls.js'}}"></script>
<script src="{{base_url() . 'node_modules/angular-filter/dist/angular-filter.js'}}"></script>
<script src="{{base_url() . 'node_modules/ng-dialog/js/ngDialog.js'}}"></script>
<script src="{{base_url() . 'node_modules/ng-file-upload/dist/ng-file-upload-shim.min.js'}}"></script>
<script src="{{base_url() . 'node_modules/ng-file-upload/dist/ng-file-upload.min.js'}}"></script>

<script src="{{base_url() . 'js/doctor.js'}}"></script>
