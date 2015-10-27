<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class IInit extends Model
{
    public function front()
    {   
        // 获取未读通知

        $d = [
            'debug'        => debugging(),
            'is_logged_in' => sess('is_logged_in'),
            'his_chara'    => sess('his_chara'),
            'username'     => sess('username'),
            'uid'          => sess('uid'),
            'unread'       => 1
        ];

        $d['org'] = '';
        if (he_is('agency')) {
            $org = DB::table(table_name('agency'))->select('name')->where('id', uid())->first();
            sess('org', $org->name);
            $d['org'] = sess('org');
        }
        return ss($d);
    }
}
