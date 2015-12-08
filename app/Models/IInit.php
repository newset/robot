<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;

class IInit extends Model
{
    public function front()
    {   
        $d = [
            'debug'        => debugging(),
            'is_logged_in' => sess('is_logged_in'),
            'his_chara'    => sess('his_chara'),
            'username'     => sess('username'),
            'uid'          => sess('uid')
        ];
        
        $type = [
            'employee' => 1,
            'agency' => 2,
            'doctor' => 3
        ];

        // 获取未读通知
        if (uid()) {
            $d['unread'] = M('message')
                ->where('recipientid', uid())
                ->where('recipienttype', $type[his_chara()[0]])
                ->where('read', 0)->count();
        }else{
            $d['unread'] = 0;
        }
        
        $d['org'] = '';
        if (he_is('agency')) {
            $org = DB::table(table_name('agency'))->select('name')->where('id', uid())->first();
            sess('org', $org->name);
            $d['org'] = sess('org');
        }

        if(he_is('employee')){
            $d['org'] = sess('org');
        }
        return ss($d);
    }

    public function test()
    {
        $data = Cache::get('i_settings', 'default');
        return $data;
    }
}
