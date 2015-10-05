@include('seg.head')

<div class="container page doctor_history">
    <h1>历史记录</h1>
    <div class="container">
        <a class="btn btn-default" href="{{URL::previous()}}">返回首页</a>
        <div class="card special">
            <div>历史使用总数：{{count($his_history['all'])}}</div>
            <div>已归档：{{count($his_history['archived'])}}</div>
            <div>未归档：{{count($his_history['all']) - count($his_history['archived'])}}</div>
        </div>
        @foreach($his_history['all'] as $h)
            <div class="card">
                <div>ID: {{$h->id}}</div>
                <div>使用日期: {{$h->used_at}}</div>
            </div>
        @endforeach
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
@include('seg.foot')
<script type="text/javascript" charset="utf-8">
    var conf = <?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo'), true, true) ?>;
    conf.jsApiList = ['scanQRCode'];
    wx.config(conf);
    wx.ready(function ()
    {
        wx.checkJsApi({
            jsApiList: ['scanQRCode'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
            success: function (res)
            {
                // 以键值对的形式返回，可用的api值true，不可用为false
                // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
            }
        });

//        document.querySelector('#scan_mark').onclick = function () {
//
//            wx.scanQRCode({
//                needResult: 0,
//                scanType: ["qrCode","barCode"],
//                success: function (res) {
//                    var result = res.resultStr;
//                }
//            });
//        };
    });

    wx.error(function (res)
    {
        alert('not ready, error:' + res.errMsg);
    });
    //    wx.ready(function ()
    //    {
    //        console.log('wechat init ok.');
    //        wx.checkJsApi({
    //            jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
    //            success: function (res)
    //            {
    //                alert(JSON.stringify(res));
    //            },
    //            error: function (e)
    //            {
    //                alert(e);
    //            }
    //        });
    //
    //        wx.uploadImage({
    //            localId: 'asdf', // 需要上传的图片的本地ID，由chooseImage接口获得
    //            isShowProgressTips: 1, // 默认为1，显示进度提示
    //            success: function (res)
    //            {
    //                alert(res)
    //                var serverId = res.serverId; // 返回图片的服务器端ID
    //            },
    //            error: function (e)
    //            {
    //                alert(e);
    //            }
    //        });
    //    });
    //    wx.error(function (res)
    //    {
    //        alert('wechat init err')
    //    });


</script>