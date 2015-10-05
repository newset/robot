<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IInit extends Model
{
    public function front()
    {
        $d = [
            'debug'        => debugging(),
            'is_logged_in' => sess('is_logged_in'),
            'his_chara'    => sess('his_chara'),
            'username'     => sess('username'),
            'uid'          => sess('uid'),
        ];
        return ss($d);
    }
}
