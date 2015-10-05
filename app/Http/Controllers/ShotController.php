<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Js;

class ShotController extends Controller
{
    public function leader($p1 = null, $p2 = null, $p3 = null, $p4 = null, $p5 = null)
    {
        if ( ! $p1 || ! $p2) return ee(2);

        $segs = '';

        foreach (func_get_args() as $p)
        {
            $segs .= $p . DOT;
        }

        $segs = trim($segs, DOT);

        return V($segs);
    }


    public function doctor($p = null)
    {
        if ( ! he_is('doctor') && ! rq())
            return view('page.doctor_login');

        if (rq() && $p == 'login_check')
        {
            if (rq('user_type') == 'doctor')
            {
                $he = M('doctor')->where('cust_id', rq('cust_id'))->first();
                if ( ! $he)
                {
                    Session::flash('input_error', ['识别码有误']);
                    return redirect('doctor/login');
                } else
                {
                    log_him_in(['uid' => $he->id]);
                    add_chara(rq('user_type'));
                    return redirect('doctor/home');
                }
            }
        }

        $d = [];
        $appId = env('WECHAT_APPID');
        $secret = env('WECHAT_SECRET');
        $js = new Js($appId, $secret);
        $d['js'] = $js;

        switch ($p)
        {
            case 'history':
                $d['his_history'] = M('doctor')->get_his_history();
                break;
        }

        return view('page.doctor_' . $p, $d);
    }
}