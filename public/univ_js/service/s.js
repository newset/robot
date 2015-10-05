;
(function ()
{
    'use strict';

    angular.module('la.service', [])

        .service('H',
        [
            '$http',
            function ($http)
            {
                var me = this;
                me.p = post;
                me.g = get;
                me.cu = create_or_update;

                me.ins = {};
                me.ins.c = create_ins;
                me.record_exist = record_exist;

                me.captcha = {};
                me.captcha.make = make_captcha;

                function create_or_update(ins_name, d)
                {
                    return me.p(cook(ins_name + '/cu'), d);
                }

                function record_exist(ins_name, k, v)
                {
                    return $http.post(cook(ins_name + '/exist'),
                        {
                            ins_name: ins_name,
                            k: k,
                            v: v
                        }).then(function(d) {return d}, function(d) {return d});
                }

                function make_captcha(captcha_maker)
                {
                    captcha_maker = captcha_maker || cook('captcha/make_captcha')

                    return $http.post(captcha_maker)
                        .then(function (r)
                        {
                            return r.data.d;
                        }, function ()
                        {
                        })
                }

                function create_ins(d)
                {
                    var url = d.url;
                    return $http.post(url, d.d);
                }

                function return_r(r)
                {
                    return r;
                }

                function post(url, data)
                {
                    return $http.post(url, data)
                        .then(return_r, return_r);
                }

                function get(url)
                {
                    return $http.get(url)
                        .then(return_r, return_r);
                }
            }
        ])
})();