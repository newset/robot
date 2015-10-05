<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRobotLeaseLog extends BaseModel
{

    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot_lease_log';
    protected $table = 'i_robot_lease_log';

    /**
     * 关联代理商
     */
    public function agency()
    {
        return $this->belongsToMany('App\Models\IAgency', 'agency_id');
    }

    /**
     * 关联机器人
     */
    public function robot()
    {
        return $this->belongsTo('App\Models\IRobot', 'robot_id');
    }
}
