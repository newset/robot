<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IDepartment extends BaseModel
{
    // 登出和登出
    use AuthTrait;

    protected $table = null;
    protected $guarded = ['id', 'password'];
    protected $ins_name = 'department';

    public function __construct()
    {
        parent::__construct();

        $this->table = table_name($this->ins_name);

        $this->createRule = [
            'name'        => 'required',
            'username'    => 'required|unique:'. table_name($this->ins_name),
            'password'    => 'required|min:6',
            'hospital_id' => 'required|exists:' . table_name('hospital') . ',id',
        ];

        $this->updateRule = [
            'id'                    =>      'required|numeric',
        ];
    }

    protected $hidden = ['password'];

    /**
     * 关联医生
     */
    public function doctor()
    {
        return $this->hasMany('App\Models\IDoctor', 'department_id');
    }

    /**
     * 关联医院
     */
    public function hospital()
    {
         return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }

    /**
     * 创建
     */
    public function c($rq = null)
    {
        $this->guarded = arr_except_vals($this->guarded, ['password']);

        if (!$rq) {
            $rq = rq();
        }
        if (isset($rq['password'])) {
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

        if (!$rq) {
            $rq = rq();
        }
        if (isset($rq['password'])) {
            $rq['password'] = hash_password($rq['password']);
        }
        return parent::u($rq);
    }

}
