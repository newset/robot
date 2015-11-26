<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Remebot运营管理系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" href="{{base_url()}}assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{base_url()}}vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Icons -->
    <link rel="stylesheet" href="{{base_url()}}assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{base_url()}}assets/css/animate.css">

      <!-- style sheet -->
    <link rel="stylesheet" href="{{base_url()}}assets/css/main.css">
    <link rel="stylesheet" href="{{base_url()}}css/base.css">

</head>
    <body>
        <div class="container" style="padding-top: 50px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">重置密码</h3>
                </div>
                <div class="panel-body">
                    @if(!$done && !$expire)
                    <form action="{{url('$/auth/reset_password?token=').$token}}" method="POST" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" id="inputToken" class="form-control" value="{{$token}}">
                        <input type="hidden" name="reset" id="inputReset" class="form-control" value="1">
                        <legend class="h5 pb10">请输入新密码，两次输入须一致，且不能不能低于6位</legend>
                        @if($errors)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <span class="control-label col-md-2">新密码</span>
                            <div class="col-md-4">
                                <input type="password" name="password" id="inputPass" class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="control-label col-md-2">在输入一次</span>
                            <div class="col-md-4">
                                <input type="password" name="password_confirm" id="inputPass" class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                    </form>
                    @elseif($done && !$expire)
                         <div class="alert alert-success">
                            <div class="fa fa-check-circle fa-3x"></div>
                            <span style="line-height: 40px; vertical-align: top;color: #444; margin-left: 20px">
                                密码重置成功，请返回<a href="{{env('APP_URL')}}" >首页</a>重新登录 
                            </span>
                        </div>
                    @elseif($expire)
                        <h4>当前链接已过期，请返回首页重新发送邮件, <a href="{{env('APP_URL')}}" title=""><i class="fa fa-home"></i>返回首页</a></h4>
                    @endif
                </div>
            </div>
        </div>
    </body>

</html>