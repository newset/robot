<?php

//Special routes.
Route::get('/', function ()
{
    if ( ! is_logged_in())
        return V('auth');

    return V('main');
});

Route::any('wx/{p1?}/{p2?}/{p3?}/{p4?}', function ($p1 = null, $p2 = null, $p3 = null, $p4 = null)
{
    return M('wechat_msg')
        ->$p1();

    return $r ? rq('echostr') : 0;
});

Route::any('doctor/{p?}', 'ShotController@doctor');

Route::any('logout', function ()
{
    return M('employee')->logout();
});

Route::any('doctor', function ()
{
    if ( ! is_logged_in())
        return V('page/doctor_login');

    return V('page/doctor_home');
});

//Common routes.
Route::any('$/{p1?}/{p2?}/{p3?}', 'CookController@leader');
Route::any('_/{p1?}/{p2?}/{p3?}/{p4?}/{p5?}', 'ShotController@leader');
Route::get('a/{p1?}/{p2?}', 'CookController@lastId');
Route::any('report/{p1?}', 'CookController@report');

if (debugging())
{
    Route::any('c/{ins_name}/{type?}', function ($ins_name, $type = null)
    {
        $ins = M($ins_name, $type);
        $ins->fill(rq());
        $ins->save();
    });

    Route::get('signup/{type}', function ($ins_name)
    {
        $ins = M($ins_name);
        return $ins->c();
    });

    Route::get('he_is/{p}', function ($chara)
    {
        dd(he_is($chara));
    });

    Route::get('t/{p}/{p2?}', function ($p, $p2 = null)
    {
        switch ($p)
        {
            case 't':
                return base_url();
                break;
            case 'cache_in':
                return Cache::put('a', 'A', 1);
                break;
            case 'cache_out':
                return Cache::get('a');
                break;
            case 'csrf':
                return csrf_token();
                break;
            case 'time':
                return \Carbon\Carbon::now();
            case 'session':
                return Session::all();
                break;
            case 'location':
                return (M('location')->where('type', 2)->get()->toArray());
                break;
            case 'timestamp':
                return time();
                break;
            case 'model':
                $h_ins = M('hospital');
                $hospital_ids = $h_ins->get()->pluck('id');
                dd($hospital_ids);
                break;
            default:
                return $p($p2);
        }
    });
}
