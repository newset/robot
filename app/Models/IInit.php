<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cache;

class IInit extends Model
{
    public function front()
    {   
        $cache = Cache::get('i_settings', null);
        $per_page = array_get($cache, 'user.per_page');
        $d = [
            'debug'        => debugging(),
            'is_logged_in' => sess('is_logged_in'),
            'his_chara'    => sess('his_chara'),
            'username'     => sess('username'),
            'uid'          => sess('uid'),
            'per_page'     => $per_page,
            'agency_end'   => $this->retrieve('system.agency_end'),
            'lease_end'    => $this->retrieve('system.lease_end')
        ];
        
        $type = [
            'employee' => 1,
            'agency' => 2,
            'doctor' => 3,
            'department' => 4
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

    protected function retrieve($key)
    {
        $data = Cache::get('i_settings', 'default');
        if (!empty($data)) {
            return array_get($data, $key);
        }else {
            return '';
        }
    }
}
