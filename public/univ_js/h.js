;(function ()
{
    'use strict';

    window.h = {}; // helper object.
    h.slash = '/';
    h.dot = '.';
    h._ = {};
    h._.shot_symbol = function () { return '_' };
    h._.cook_symbol = function () { return '$' };

    window.is_date = function(date_obj)
    {
        return Object.prototype.toString.call(date_obj) === '[object Date]';
    }

    Array.prototype.has = function (value)
    {
        var i;
        for (i=0; i < this.length; i++)
        {
            if (this[i] == value)
            {
                return true;
            }
        }
        return false;
    };

    window.base_url = location.protocol + '//' + location.host + '/';

    window.reload_page = function()
    {
        return location.reload();
    }

    window.shot = function(segs)
    {
        var delim = h.slash;

        return base_url + h._.shot_symbol() + delim + segs;
    }

    window.cook = function(segs)
    {
        var delim = h.slash;

        return base_url + h._.cook_symbol() + delim + segs;
    }

    window.shot_report = function(segs){
        var delim = h.slash;
        return base_url + h._.shot_symbol() + delim + 'page/report/'+segs;
    }

})();