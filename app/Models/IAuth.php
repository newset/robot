<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IAuth extends Model
{
    use AuthTrait;

    public function auth_leader()
    {
        $rq = rq();
        $auth_type = $rq['auth_type'];
        $user_type = $rq['user_type'];
        $form_vals = $rq['form_vals'];

        switch($auth_type)
        {
            case 'login':
                $form_vals['user_type'] = $user_type;
                return $this->login($form_vals);
                break;

            case 'signup':
                if( ! $user_type === 'agency') return ee(2);
                // 开始注册...
                return M('agency')->c($form_vals);
                break;

        }
    }
}
