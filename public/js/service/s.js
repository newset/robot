;(function ()
{
    'use strict';
    angular.module('base_app.service', [])

        .service('SIns',
        [
            'H',
            '$q',
            'ngDialog',
            function (H,
                      $q
                , ngDialog)
            {
                var me = this;
                me.get_data = get_data;
                me.show_search_panel = false;
                me.toggle_search_panel = toggle_search_panel;
                me.search_cond = {
                    where: {},
                    where_has: {}
                };
                me.prepare_search_cond = prepare_search_cond;

                function prepare_search_cond()
                {
                    for (var key in me.search_cond)
                    {
                        for (var key2 in me.search_cond[key])
                        {
                            if (!me.search_cond[key][key2])
                                delete me.search_cond[key][key2];
                            for (var key3 in me.search_cond[key][key2])
                            {
                                if (!me.search_cond[key][key2][key3])
                                    delete me.search_cond[key][key2][key3];
                                console.log('me.search_cond[key][key2][key3]: ', me.search_cond[key][key2][key3]);
                            }
                        }
                    }
                }

                function toggle_search_panel()
                {
                    console.log('me.show_search_panel: ', me.show_search_panel);

                    me.show_search_panel = !me.show_search_panel;
                }

                function cu(d)
                {
                    return H.cu(me.ins_name, d).then(function (r)
                    {
                        if (r.data.d)
                            ngDialog.closeAll();
                        //reload_page();
                    }, function ()
                    {
                        //location.reload();
                    })

                }


                function get_data(cond)
                {
                    return H.p(cook(cond.ins_name + '/r'),
                        cond)
                        .then(function (r)
                        {
                            return r;
                        }, function (e)
                        {
                            console.error(e)
                        })
                }
            }
        ])
})();