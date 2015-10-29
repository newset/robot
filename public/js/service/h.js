;
(function ()
{
    'use strict';
    angular.module('base_app.service')
        .service('h',
        [
            'H',
            '$filter',
            'SBase',
            'ngDialog',
            function (H
                , $filter
                , SBase
                , ngDialog)
            {
                var me = this;

                me.robot_lease_type =
                    [
                        {
                            id: 1,
                            name: '自营'
                        },
                        {
                            id: 2,
                            name: '租赁'
                        },
                        {
                            id: 3,
                            name: '出售'
                        },
                    ];

                me.doctor_status =
                    [
                        {
                            id: 0,
                            name: '禁用',
                        },
                        {
                            id: 1,
                            name: '未培训',
                        },
                        {
                            id: 2,
                            name: '已培训，未绑定微信',
                        },
                        {
                            id: 3,
                            name: '已培训，已绑定微信',
                        },
                    ];
                me.agency_status =
                    [
                        {
                            id: 0,
                            name: '禁用',
                        },
                        {
                            id: 1,
                            name: '正常',
                        },
                    ];
                me.prepare_location_data = prepare_location_data;
                me.prepare_cond = prepare_cond;
                me.popup_form = popup_form;
                me.get_all_hospital = get_all_hospital;
                me.get_all_department = get_all_department;
                
                me.return_r = return_r;
                me.prepare_current_row = prepare_current_row;
                me.cu = cu;
                me.get_date_fields = parse_date_fields_to_w3c;
                me.ins_helper = {};

                me.ins_helper.cu = cu;
                me.ins_helper.popup_form = popup_form;
                me.ins_helper.popup_detail = popup_detail;
                me.ins_helper.make_dialog_class_name = make_dialog_class_name;
                me.ins_helper.r = r;

                me.he_is = function(chara)
                {
                    return $.inArray(chara, SBase._.his_chara);
                }

                /**
                 * 读取 instance
                 * @param  {[type]} ins       [description]
                 * @param  {[type]} key       [description]
                 * @param  {[type]} relation  [description]
                 * @param  {[type]} condition [description]
                 * @return {[type]}           [description]
                 */
                function r(id, ins, rel) {
                    // row, SIns, 'agency/r', {relation: ['robotLeaseLog', 'mark', 'hospital'], where: {id: row.id}
                    var condition = {
                        'relation' : rel,
                        'where' : {},
                        'id' : id
                    },
                    url = ins.ins_name+'/r';
                    var promise = H.p(cook(url), condition)
                    promise.then(function(res){
                        // 获取成功
                        if (res.data.status == 1) {
                            ins.current_row = res.data.d.main[0];
                        };
                    });
                    return promise;
                }

                function popup_detail(current_row, ins, url, cond)
                {
                    var type = 'detail';

                    if (url)
                    {
                        H.p(cook(url), cond)
                            .then(function (r)
                            {
                                console.log('r: ', r);
                                if (r.data.status == 1)
                                {
                                    ins.current_row = angular.extend(current_row, r.data.d.main[0]);
                                    console.log('current_row: ', current_row);
                                    ngDialog.open({
                                        templateUrl: shot('seg/' + ins.ins_name + '_' + type),
                                        className: make_dialog_class_name(type, ins)
                                    })

                                }
                            })
                    }
                }

                function make_dialog_class_name(type, ins)
                {
                    ins = ins || this;
                    return 'ngdialog ngdialog-theme-default ' + ins.ins_name + '_' + type;
                }

                function parse_date_fields_to_w3c(row)
                {
                    var new_row = angular.copy(row);
                    for (var field in row)
                    {
                        if (/.+_at$/i.test(field))
                        {
                            console.log('date field: ', field);
                            new_row[field] = moment(row[field]).format();
                        }
                    }

                    return new_row;
                }

                function cu(d, ins)
                {
                    var ins = ins || this;
                    console.log('cu_data: ', d);
                    d = parse_date_fields_to_w3c(d);
                    d['write_data'] = 1;
                    var promise = H.cu(ins.ins_name, d);

                    promise.then(function (r)
                    {
                        if (r.data.d)
                        {
                            ins.refresh();
                            ngDialog.closeAll();
                            return r;
                        }
                    }, function ()
                    {
                    })

                    return promise;
                }

                function prepare_current_row()
                {
                    var row = this.current_row;

                    for (var item in row)
                    {
                        //console.log('current_row: ', row);
                        console.log('current_item: ', item);

                        if (['started_at', 'ended_at', 'deleted_at', 'created_at', 'updated_at', 'lease_started_at', 'lease_ended_at'].has(item))
                        {
                            console.log('is_date: ', item);
                            row[item] = moment(row[item]).toDate();
                            console.log('row[item]: ', row[item]);
                        }

                        if (['phone'].has(item))
                        {
                            row[item] = parseInt(row[item]);
                        }
                    }
                }

                function return_r(r)
                {
                    return r;
                }

                function get_all_hospital()
                {
                    return H.p(cook('hospital/r'), {limit: '0', 'order_by' : 'id'})
                        .then(me.return_r);
                }

                function get_all_department(hospital)
                {
                    return H.p(cook('department/r'), {limit: '0', where : {'hospital_id' : hospital}});
                }

                function prepare_location_data()
                {
                    var promise = H.p(cook('location/province_and_city'));
                    promise.then(function (r)
                        {
                            SBase._.location = r.data.d;
                        })
                    return promise;
                }

                function prepare_cond(as_copy, raw_cond)
                {
                    var cond;
                    as_copy = as_copy || false;
                    if (raw_cond)
                    {
                        cond = angular.copy(raw_cond);
                        if (as_copy) cond = angular.copy(raw_cond);
                    }
                    else
                    {
                        cond = this.cond;
                        if (as_copy) cond = angular.copy(this.cond);
                    }
                    for (var key in cond)
                    {
                        for (var key2 in cond[key])
                        {
                            if (!cond[key][key2])
                                delete cond[key][key2];
                            if (key2.endsWith('_at') && is_date(cond[key][key2]))
                            {
                                cond[key][key2] = moment(cond[key][key2]).format();
                            }

                            if (angular.isString(cond[key][key2]))
                                continue;
                            for (var key3 in cond[key][key2])
                            {
                                if (!cond[key][key2][key3])
                                    delete cond[key][key2][key3];
                                if (key3.endsWith('_at') && is_date(cond[key][key2][key3]))
                                {
                                    cond[key][key2][key3] = moment(cond[key][key2][key3]).format();
                                }

                                console.log('cond[key][key2][key3]: ', cond[key][key2][key3]);
                            }
                        }
                    }
                    if (raw_cond)
                        return cond;
                }

                function popup_form(current_row, ins)
                {
                    console.log('current_row: ', current_row);

                    ins = ins || this;

                    ins.current_row = angular.copy(current_row);
                    me.prepare_current_row.call(ins);
                    ngDialog.open({
                        templateUrl: shot('seg/' + ins.ins_name + '_form'),
                    })
                }
            }

        ])
})();