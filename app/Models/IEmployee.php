<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IEmployee extends BaseModel
{
    use AuthTrait;

    protected $guarded = ['id', 'password'];
    protected $table = null;
    protected $ins_name = 'employee';

    public function __construct()
    {
        parent::__construct();

        $this->table = table_name($this->ins_name);

        $this->createRule = [
            'name'     => 'required',
            'username' => 'required|unique:'.table_name($this->ins_name),
            'password' => 'required|alpha_num|min:6',
            'phone'    => 'required|digits:11',
            'email'    => 'required|email',
            'status'   => 'numeric',
            'memo'     => 'string',
        ];

        $this->updateRule = [
            'id' => 'required|numeric',
            'username' => 'unique:'.table_name($this->ins_name).',username,'.rq('id'),
            'password' => 'alpha_num|min:6'
        ];

        $this->messages = [
            'username.required' => '用户名必填',
            'username.unique' => '用户名已被使用',
            'password.required' => '密码必填',
            'password.min' => '密码至少有6位字母或者数字',
            'phone.required' => '手机号码必填',
            'phone.digits' => '手机号码必须为11位数字',
            'email.required' => '电子邮箱必填'
        ];
    }

    public function change_password($row = null)
    {
        $row = $row ? $row : rq();

        $ins = $this->find($row['id']);
        $ins->password = hash_password($row['password']);
        $r = $ins->save();

        // trigger log
        $this->eventFire('pass', $ins);

        return $r ? ss($r) : ee(1);
    }

    /**
     * 创建
     */
    public function c($rq = NULL)
    {
        $this->guarded = arr_except_vals($this->guarded, ['password']);

        if ( ! $rq)
        {
            $rq = rq();
        }
        
        return parent::c($rq);
    }

    /**
     * 更新
     */
    public function u($rq = NULL)
    {
        $this->guarded = arr_except_vals($this->guarded, ['password']);

        if ( ! $rq)
        {
            $rq = rq();
        }
      
        return parent::u($rq);
    }

    public function getPermissionsAttribute($value)
    {
        if (!$value) {
            $value = '[1, 1, 1, 1, 1, 1, 1, 1, 1]';
        }

        return json_decode($value);
    }

    public function setPermissionsAttribute($value)
    {
        if (!$value) {
            $value = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        }
        $this->attributes['permissions'] = json_encode($value);
    }


    /**
     * 关联机器人
     */
    public function robot()
    {
        return $this->hasMany('App\Models\IRobot', 'employee_id');
    }

    /**
     * 关联机器人记录
     */
    public function robotLog()
    {
        return $this->hasMany('App\Models\IRobotLog', 'employee_id');
    }
}
