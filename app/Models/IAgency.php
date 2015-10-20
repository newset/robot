<?php

namespace App\Models;

use Hamcrest\BaseMatcher;
use Illuminate\Database\Eloquent\Model;

use Event, App\Events\UserSignup;

class IAgency extends BaseModel
{
    use AuthTrait;

    protected $guarded = ['id', 'password'];
    protected $table = null;
    protected $ins_name = 'agency';

    public function __construct()
    {
        parent::__construct();

        $this->table = table_name($this->ins_name);

        $this->createRule = [
            'name'              =>      'string',
            'name_in_charge'    =>      'string',
            'city_id'           =>      'required|numeric',
            'province_id'       =>      'required|numeric',
            'location_detail'   =>      'string',
            'username'          =>      'required|unique:' . table_name($this->ins_name),
            'password'          =>      'required|min:6',
            'phone'             =>      'numeric|min:11',
            'email'             =>      'email',
            'status'            =>      'numeric',
            'memo'              =>      'string',
        ];

        $this->updateRule = [
            'id'                    =>      'required|numeric',
        ];
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

    public function toggle()
    {
        $s = !rq('s');
        $agency = rq('id');
        return [
            'status' => $this->where('id', $agency)->update(['status'=> $s]),
            'd'=> $s
        ];
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

    /**
     * 触发事件
     */
    public function eventFire($method)
    {
        if ($method === 'c') {
            $response = Event::fire(new UserSignup);
        }
    }

    /**
     * 关联Mark
     */
    public function mark()
    {
         return $this->hasMany('App\Models\IMark', 'agency_id');
    }

    public function robot()
    {
         return $this->hasMany('App\Models\IRobot', 'agency_id');
    }

    /**
     * 关联已销售的Mark
     *
     * @todo 待完成
     */
    public function markLeased()
    {
         return $this->hasMany('App\Models\IMark', 'agency_id');
    }

    /**
     * 关联库存的Mark
     *
     * @todo 待完成
     */
    public function markStock()
    {
         return $this->hasMany('App\Models\IMark', 'agency_id');
    }

    /**
     * 关联机器人销售记录
     */
    public function robotLeaseLog()
    {
         return $this->hasMany('App\Models\IRobotLeaseLog', 'agency_id');
    }

    public function hospital()
    {
        return $this->belongsToMany('App\Models\IHospital', 'r_agency_hospital', 'agency_id', 'hospital_id');
    }
}
