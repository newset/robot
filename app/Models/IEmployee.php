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
            'username' => 'required|unique:' . table_name($this->ins_name),
            'password' => 'required|min:6',
            'phone'    => 'numeric|min:11',
            'email'    => 'email',
            'status'   => 'numeric',
            'memo'     => 'string',
        ];

        $this->updateRule = [
            'id' => 'required|numeric',
        ];
    }

    public function change_password($row = null)
    {
        $row = $row ? $row : rq();

        $ins = $this->find($row['id']);
        $ins->password = hash_password($row['password']);
        $r = $ins->save();
        return $r ? ss($r) : ee(1);
    }

    /**
     * 创建
     */
    public function c($rq = null)
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
    public function u($rq = null)
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
