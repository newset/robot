<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Route;
use Mail, DB, Request, Input;
use Event, App\Events\LogEvent;
use Carbon\Carbon;

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
        if ($row ) {
            // 发送邮件
            $hash = hash_password($row->email.time());
            Mail::send('emails.reminder', ['user' => $row, 'hash' => $hash], function ($m) use ($row) {
                $m->to($row->email, $row->name)->subject('密码重置');
            });

            // 发送log
            Event::fire(new LogEvent('reminder', 'auth', ['type' => $ins, 'user' => $row, 'hash' => $hash]));

            return ss('邮件已发送');
        }else{
            return ss('无相关用户', 0);
        }
    }

    /**
     * 重置密码
     * @return [type] [description]
     */
    public function reset_password()
    {
        $token = rq('token');
        $done = false;
        $errors = [];
        $expire = true;
        if (!$token) {
            abort(404);
        }

        $log = ILog::where('memo', $token)->first();
        if (!$log) {
            abort(404);
        }

        $at = Carbon::parse($log->at);
        $diff =$at->diffInHours(Carbon::now());
        if ($diff < 24) {
            $expire = false;
        }

        if (rq('reset') && Request::method() == 'POST' && !$expire) {
            $res = $this->reset($token, $log);
            if ($res['status']) {
                $done = true;
            }else{
                $errors = $res['errors'];
            }
        }

        return view('reset')->with(compact('token', 'log', 'errors', 'done', 'expire'));
    }

    /**
     * 
     * @return [type] [description]
     */
    public function reset($token, $log)
    {
        // validate the input
        $data = Input::only('password', 'password_confirm');
        $validator = Validator::make($data, [
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ], [
            'password.required' => '密码不能为空',
            'password.min' => '密码不足6位',
            'password_confirm.required' => '重复密码不能为空',
            'password_confirm.same' => '两次输入的密码不一致',
        ]);

        if ($validator->passes()) {
            // 修改密码
            $table = '';
            if ($log->action_type_id == 44) {
                $table = 'i_employee';
            }else if($log->action_type_id == 45){
                $table = 'i_agency';
            }

            if ($table) {
                DB::table($table)->where('id', $log->related_id)
                    ->update(['password' => hash_password($data['password'])]);

                $log->memo = '通过邮件重置密码成功。';
                $log->save();
            }

            return [
                'status' => 1
            ];
        }else{
            return [
                'status' => 0,
                'errors' => $validator->errors()->all()
            ];
        }
    }
}
