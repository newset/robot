<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class IHospital extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'hospital';
    protected $softDelete = false;

    public function __construct()
    {
        parent::__construct();

        $this->createRule = [
            'city_id'       =>      'required|numeric',
            'province_id'   =>      'required|numeric',
            'localtion_detail'  =>  'string',
            'name'          =>      'required|unique:i_hospital,name',
            'memo'          =>      'string',
        ];

        $this->updateRule = [];

        $this->messages['name.unique'] = '医院名字已存在';
    }

    // 验证名字
    public function u($rq = null)
    {
        // 验证
        if (!rq('id')) {
            return ee(1);
        }

        $rules = $this->createRule;
        $rules['name'] = $rules['name'].','.rq('id');
        $validator = Validator::make($rq, $rules, $this->messages);

        if (!$validator->passes()){
            return ee(2, $validator->errors());
        }

        return parent::u($rq);
    }

    /**
     * 获取关联的科室数据
     */
    public function getDepartment()
    {
        $ret = $this->findOrFail(rq('id'))->department;
        return ss($ret);
    }

    /**
     * 获取关联的医生数据
     */
    public function getDoctor()
    {
        $ret = $this->findOrFail(rq('id'))->doctor;
        return ss($ret);
    }

    /**
     * 为CURD提供关联数据
     */
    public function assignRelateData()
    {
        $this->location         =   province($this->province_id) . city($this->city_id);
        // $this->doctorNum        =   $this->doctor->count();
        // $this->departmentNum    =   $this->department->count();
        $this->agencyNum        =   $this->getAllAgency()->count();
        $this->deviceNum        =   $this->getCurrentDevice()->count();
    }

    /**
     * 关联科室
     */
    public function department()
    {
        return $this->hasMany('App\Models\IDepartment', 'hospital_id');
    }

    /**
     * 关联代理商
     */
    public function agency()
    {
        return $this->belongsToMany('App\Models\IAgency', 'i_robot_lease_log', 'hospital_id', 'agency_id')->groupBy('agency_id');
    }

    /**
     * 关联机器人销售记录
     */
    public function robotLeaseLog()
    {
         return $this->hasMany('App\Models\IRobotLeaseLog', 'hospital_id');
    }

    /**
     * 关联当前使用中的机器人
     *
     * @todo 正在使用的，而不是使用过的机器人
     */
    public function currentRobot()
    {
        return $this->belongsToMany('App\Models\IRobot', 'i_robot_lease_log', 'hospital_id', 'robot_id')->groupBy('robot_id');
    }

    /**
     * 关联医生
     */
    public function doctor()
    {
        return $this->hasMany('App\Models\IDoctor', 'hospital_id');
    }

    /**
     * 关联Mark
     */
    public function mark()
    {
         return $this->hasMany('App\Models\Mark', 'hospital_id');
    }

    /**
     * 获取正在使用的设备
     * @todo
     */
    public function getCurrentDevice()
    {
        return M('agency');
    }

    /**
     * 获取所有代理商
     * @todo
     */
    public function getAllAgency()
    {
        return M('agency');
    }

}
