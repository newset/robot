;
(function() {
    'use strict';
    angular.module('base_app.service')
        .service('SHospital', [
            'H',
            'h',
            '$state',
            'ngDialog',
            function(H,
                h,
                $state,
                ngDialog) {
                var me = this;
                me.init = init;
                me.refresh = refresh;
                me.prepare_cond = prepare_cond;
                me.change_page = change_page;
                me.popup_edit = popup_edit;
                me.cu = cu;
                me.d = d;
                me.current_page_data = null;
                //me.current_page = 1;
                me.total_items = null;
                me.items_per_page = 50;
                me.ins_name = 'hospital';
                me.cond = {
                    relation: ['agency', 'doctor', 'department'],
                    where: {},
                    where_has: {},
                };

                me.get_all_rec = function() {
                    return H.p(cook('hospital/r'), {
                            'limit': 0,
                            'order_by': 'id'
                        })
                        .then(function(r) {
                            me.all_rec = r.data.d.main;
                        })
                }

                function cu(d) {
                    return H.cu(me.ins_name, d)
                        .then(function(r) {
                            if (r.data.d) { //创建成功
                                ngDialog.closeAll();
                                me.refresh();
                                $state.go('base.hospital.department_doctor', {hid : r.data.d.id});
                                // window.location.href = '/#/hospital/department_doctor?hid=' + r.data.d.id; //TODO
                            }
                        }, function() {})
                }

                function d(id) {
                    var co = confirm('确认删除？');
                    if (!co) return;

                    return H.p(cook(me.ins_name + '/d'), {
                            id: id
                        })
                        .then(function(r) {
                            if (r.data.d) {
                                me.refresh();
                            }
                        }, function() {})
                }

                function popup_edit(row, memo) {
                    //me.current_row.type = type;
                    me.current_row = row;
                    if (memo == 0) {
                        ngDialog.open({
                            templateUrl: shot('seg/hospital_form'),
                        });
                    } else {
                        ngDialog.open({
                            templateUrl: shot('seg/hospital_memo'),
                        });
                    }
                }

                function popup_memo(row) {
                    //me.current_row.type = type;
                    me.current_row = row;
                    ngDialog.open({
                        templateUrl: shot('seg/hospital_memo'),
                    })
                }

                function refresh() {
                    h.prepare_cond.call(me);
                    return H.p(cook(me.ins_name + '/r'),
                            me.cond)
                        .then(function(r) {
                            //  if (!me.total_items)
                            me.total_items = r.data.d.count;
                            me.current_page_data = r.data.d.main;
                            console.log(' me.cond: ', me.cond);
                            return r;
                        })
                }

                function prepare_cond() {
                    for (var key in me.cond) {
                        for (var key2 in me.cond[key]) {
                            if (!me.cond[key][key2])
                                delete me.cond[key][key2];
                            for (var key3 in me.cond[key][key2]) {
                                if (!me.cond[key][key2][key3])
                                    delete me.cond[key][key2][key3];
                                console.log('me.cond[key][key2][key3]: ', me.cond[key][key2][key3]);
                            }
                        }
                    }
                }

                function change_page(pagination) {
                    console.log('pagination: ', pagination);

                    me.cond.pagination = pagination;
                    me.refresh();
                }

                function init() {
                    me.refresh()
                }
            }
        ])
})();
