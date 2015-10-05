(function ()
{
    'use strict';
    angular.module('doctor_app', [])

        .run([
            function ()
            {
                conf.jsApiList = ['scanQRCode'];
                wx.config(conf);
            }])

        .controller('CBase', [
            '$http',
            function ($http)
            {
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


                    document.querySelector('#scan_mark').onclick = function ()
                    {
                        wx.scanQRCode({
                            needResult: 1,
                            scanType: ["qrCode", "barCode"],
                            success: function (res)
                            {
                                var id = res.resultStr;
                                send_code(id)
                                    .then(function (r)
                                    {
                                        if (r.data.status == 1)
                                            toastr.success('上报成功！')

                                        else if (r.data.status == 0 && r.data.d.additional_info == 'mark_is_already_used')
                                            toastr.warning('请勿重复上报Mark');

                                        else
                                            toastr.warning('Mark二维码有误');

                                    }, function()
                                    {
                                        toastr.warning('network error.');
                                    })
                            }
                        });
                    };
                });

                wx.error(function (res)
                {
                    alert('not ready, error:' + res.errMsg);
                });

                function send_code(cust_id)
                {
                    return $http.get('/$/mark/scan_u', {params: {cust_id: cust_id}})
                        .then(return_r, return_r);
                }

                function return_r(r)
                {
                    return r;
                }

                function alert_r(r)
                {
                    alert(JSON.stringify(r));
                }
            }])
})();