<!--main content end-->
<!--Global JS-->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/angular.js/1.4.7/angular.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="{{base_url() . 'vendor/chosen/chosen.jquery.min.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/toastr/toastr.js'}}"></script>
<script src="//cdn.bootcss.com/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
<script src="//cdn.bootcss.com/moment.js/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/nprogress/nprogress.js'}}"></script>

<script src="//cdn.bootcss.com/angular-ui-bootstrap/0.12.0/ui-bootstrap-tpls.min.js"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angular-filter/dist/angular-filter.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/ng-dialog/js/ngDialog.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/ng-file-upload/ng-file-upload-shim.min.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/ng-file-upload/ng-file-upload.min.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angular-animate/angular-animate.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angular-aria/angular-aria.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angular-material/angular-material.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angular-sanitize/angular-sanitize.js'}}"></script>
<script type="text/javascript" src="{{base_url() . 'vendor/angularjs-datepicker/src/js/angular-datepicker.js'}}"></script>

<script type="text/javascript" src="{{ base_url() . 'univ_js/directive/d.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'univ_js/service/s.js'}}"></script>

<script type="text/javascript" src="{{ base_url() . 'univ_js/h.js'}}"></script>

<script type="text/javascript" src="{{ base_url() . 'js/service/s.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/agency.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/base.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/department.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/doctor.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/h.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/service/hospital.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/filter/f.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/directive/d.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/router/r.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/controller/c.js'}}"></script>
<script type="text/javascript" src="{{ base_url() . 'js/base.js'}}"></script>

<!--Load these page level functions-->

</body>
<!--[if lt IE 10]>
<script>
</script>
<script src="{{ base_url() . 'vendor/iewarning/script.min.js'}}"></script>
<![endif]-->
<script>
if (navigator.userAgent.match(/Trident\/6/)) {
    document.write('<script src="{{ base_url() . 'vendor/iewarning/script.min.js'}}"><'+'/script>');
}
</script>
</html>