<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

trait AuthTrait
{
    /**
     * 登入方法
     * @param null $input
     * @return array
     */
    public function login($input = null)
    {
        $input = $input ? $input : rq();

        if ( ! empty($input['user_type']) && $input['user_type'] == 'doctor' && ! empty($input['cust_id']))
        {
            $d = M('doctor');
            $d = $d
                ->where('cust_id', $input['cust_id'])
                ->first();

            if ($d)
            {
                log_him_in(['uid' => $d->id]);
                add_chara($input['user_type']);
                return ss();
            }

            return $d ? ss($d) : ee(2);
        }

        if ( ! empty($input['user_type']) && ! empty($input['username']) && ! empty($input['password']))
        {
            $input['password'] = hash_password($input['password']);
            $user = $this->user_exists($input['user_type'],
                array_only($input, ['username', 'password']));

            if ($user)
            {
                log_him_in(['username' => $user->username, 'uid' => $user->id]);
                add_chara($input['user_type']);
                if($input['user_type'] == 'employee'){
                    sess('permission', $user->permissions);
                }else{
                    sess('permission', []);
                }

                if($input['user_type'] == 'agency'){
                    sess('org', $user->name);
                    sess('name_in_charge', $user->name_in_charge);
                }
                if($input['user_type'] == 'department'){
                    sess('org', $user->hospital_name.':'.$user->name);
                }

                if($input['user_type'] == 'employee'){
                    sess('org', $user->name);
                }

                // 添加日志
                ILog::login($input['user_type'], $user);

                return ss($user);
            }

        } else
        {
            return ee(2);
        }

        return ee(2);
    }

    /**
     * if user exists, return user instance,
     * else return false.
     * @param $ins_name
     * @param $cond
     * @return mixed
     */
    public function user_exists($ins_name, $cond)
    {
        $ins = M($ins_name);
        $ins = $ins->where($cond);
        if ($ins_name == 'department') {
            $select = [table_name('department').'.*', table_name('hospital').'.name as hospital_name'];
            $ins = $ins->select($select)->leftJoin(table_name('hospital'), table_name('department').'.hospital_id',  '=', table_name('hospital').'.id');
        }
        if ($ins_name == 'employee') {
            $ins = $ins->where('status',1);
        }
        $ins = $ins->first();
        return $ins ? $ins : false;
    }

    /**
     * 登出方法
     */
    public function logout()
    {
        $is_doctor = he_is('doctor');
        log_him_out();
        Session::forget(['username', 'org']);
        if ( ! $is_doctor)
            return redirect('/');
        return redirect('/doctor/home');
    }
}
