<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Route;
use Mail;
use Event, App\Events\LogEvent;

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

    /**
     * 找回密码 
     * @param  [type] $p3 找回密码类型 - employee , agency
     * @return [type]     [description]
     */
    public function forget($p3 = null)
    {
        $email = rq('email');
        
        $ins = Route::current()->parameter('p3');

        $row = M($ins)->where('email', $email)->first();
        $sent = sess('password_reset_sent');
        if ($row && $sent) {
            // 发送邮件
            sess('password_reset_sent', true);

            // Mail::send('emails.reminder', ['user' => $row], function ($m) use ($row) {
            //     $m->to($row->email)->subject('Your Reminder!');
            // });

            // 发送log
            Event::fire(new LogEvent('reminder', 'auth', ['type' => $ins, 'user' => $row]));

            return ss('邮件已发送');
        }else{
            return ss('无相关用户', 0);
        }
    }
}
