@include('seg.head')
<div class="page doctor_login">
    <header class="col-md-12">
        <h1>登录</h1>
    </header>
    <div class="container">
        <form action="/doctor/login_check" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="user_type" value="doctor">
            <label>识别码</label>
            @if(sess('input_error'))
                @foreach(sess('input_error') as $e)
                <label class="error">{{$e}}</label>
                @endforeach
            @endif
            <div class="form-group">
                <input placeholder="请输入识别码"
                       name="cust_id"
                       class="form-control"
                       la-not-exist="doctor.cust_id">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">登录</button>
            </div>
        </form>
    </div>
</div>
@include('seg.foot')
