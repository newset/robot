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
            'password' => 'required|min:6',
            'phone'    => 'required|numeric|min:11',
            'email'    => 'required|email',
            'status'   => 'numeric',
            'memo'     => 'string',
        ];

        $this->updateRule = [
            'id' => 'required|numeric',
            'username' => 'unique:'.table_name($this->ins_name).',username,'.rq('id')
        ];

        $this->messages = [
            'username.unique' => '用户名已被使用'
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
        if (isset($rq['password']))
        {
            $rq['password'] = hash_password($rq['password']);
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
        if (isset($rq['password']))
        {
            $rq['password'] = hash_password($rq['password']);
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
