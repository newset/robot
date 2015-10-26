<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRobotLeaseLog extends BaseModel
{

    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot_lease_log';
    protected $table = 'i_robot_lease_log';

    public $createRule = [
        'robot_id' => 'required',
        'lease_type_id' => 'required|digits_between:-1,3'
    ];

    public function c($rq = NULL, $rules = NULL, $messages = NULL)
    {
        $rq = rq();
        $new = parent::c($rq, $this->createRule);
        if ($new['status'] == 1) {
              // 设置
            $query = $this->where('robot_id', $rq['robot_id']);
            $query->update(['recent'=> 0]);
            $query->where('id', $new['d']['id'])->update(['recent'=> 1]);
        }

        $new['rq'] = $rq;
      
        return $new;
    }

    /**
     * 关联代理商
     */
    public function agency()
    {
        return $this->belongsTo('App\Models\IAgency', 'agency_id');
    }

    /**
     * 关联医院
     */
    public function hospital()
    {
        return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }

    /**
     * 关联机器人
     */
    public function robot()
    {
        return $this->belongsTo('App\Models\IRobot', 'robot_id');
    }
}
