;(function ()
{
    'use strict';
    angular.module('base_app.service')
        .service('SDepartment',
        [//科室service
            'H',
            'h',
            'ngDialog',
            function (H,
                      h,
                      ngDialog)
            {
                var me = this;
                me.init = init;
                me.refresh = refresh;
                me.change_page = change_page;
                me.popup_edit = popup_edit;
                me.cu = cu;
                me.d = d;
                me.current_page_data = null;
                me.total_items = null;
                me.items_per_page = 10;
                me.ins_name = 'department';
                me.cond = {
                    relation: ['doctor', 'hospital'],
                    limit: 0,
                    where: {},
                    where_has: {},
                };

                function cu(d)
                {
                    return H.cu(me.ins_name, d)
                        .then(function (r)
                        {
                            if (r.data.d)
                            {
                                me.refresh();
                                ngDialog.closeAll();
                            }
                        }, function ()
                        {
                        })
                }

                function d(id)
                {
                    var co = confirm('确认删除？');
                    if(!co) return false;

                    return H.p(cook(me.ins_name + '/d'), {id: id})
                        .then(function (r)
                        {
                            if (r.data.d)
                            {
                                return me.refresh();
                            }
                        }, function ()
                        {

                        });
                }

                function popup_edit(row)
                {
                    h.popup_form.call(me, row)
                }

                function refresh()
                {
                    h.prepare_cond.call(me);
                    var promise = H.p(cook(me.ins_name + '/r'), me.cond);

                    promise.then(function (r)
                        {
                            if (!me.total_items)
                                me.total_items = r.data.d.count;
                            me.current_page_data = r.data.d.main;
                            console.log(' me.current_page_data: ', me.current_page_data);
                            return r;
                        });
                    return promise;
                }

                function change_page(pagination)
                {
                    console.log('pagination: ', pagination);

                    me.cond.pagination = pagination;
                    me.refresh();
                }

                function init()
                {
                    h.get_all_hospital()
                        .then(function(r)
                        {
                            me.all_hospital = r.data.d.main;
                        })
                    me.refresh()
                }
            }
        ])
})();
