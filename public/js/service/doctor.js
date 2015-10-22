;(function ()
{
    'use strict';
    angular.module('base_app.service')
        .service('SDoctor',
        [
            'H',
            'h',
            'ngDialog',
            function (
                H,
                h,
                ngDialog)
            {
                var me = this;
                me.init = init;
                me.status_type = h.doctor_status;
                me.refresh = refresh;
                me.change_page = change_page;
                me.popup_edit = popup_edit;
                me.cu = cu;
                me.d = d;
                me.h = h;
                me.current_page_data = null;
                //me.current_page = 1;
                me.total_items = null;
                me.items_per_page = 50;
                me.ins_name = 'doctor';
                me.cond = {
                    relation: ['hospital', 'department'],
                    where: {},
                    where_has: {},
                };
                me.all_rec = [];

                me.get_all_rec = function()
                {
                    H.p(cook('doctor/r'), {'limit': 0})
                        .then(function (r)
                        {
                            console.log('rlala: ', r);

                            me.all_rec = r.data.d.main;
                        })
                }

                me.lastId = function(b){
                    return H.g(base_url + 'a/doctor/'+b);
                }

                function cu(d)
                {
                    var promise = H.cu(me.ins_name, d);
                    promise.then(function (r)
                        {
                            if (r.data.d)
                            {
                                me.refresh();
                                ngDialog.closeAll();
                            }
                        }, function ()
                        {
                        });
                    return promise;
                }

                function d(id)
                {
                    var co = confirm('确认删除？');
                    if(!co) return;

                    return H.p(cook(me.ins_name + '/d'), {id: id})
                        .then(function (r)
                        {
                            if (r.data.d)
                            {
                                me.refresh();
                            }
                        }, function ()
                        {
                        })
                }

                function popup_edit(row)
                {
                    me.current_row = row;
                    h.popup_form.apply(me)
                }

                function refresh()
                {
                    h.prepare_cond.call(me);
                    return H.p(cook(me.ins_name + '/r'),
                        me.cond)
                        .then(function (r)
                        {
                            me.total_items = r.data.d.count;
                            me.current_page_data = r.data.d.main;
                            console.log(' me.cond: ', me.cond);
                            return r;
                        })
                }

                function change_page(pagination)
                {
                    console.log('pagination: ', pagination);

                    me.cond.pagination = pagination;
                    me.refresh();
                }

                function init()
                {
                    var promise = h.get_all_hospital()
                        promise.then(function(r)
                        {
                            me.all_hospital = r.data.d.main;
                        });

                    return promise;
                }
            }
        ])
})();