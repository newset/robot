<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRobotLog extends BaseModel
{

    protected $guarded = ['id'];

    protected $ins_name = 'robot_log';

    /**
     * 关联职员
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\IEmployee', 'employee_id');
    }

    /**
     * 关联机器人
     */
    public function robot()
    {
        return $this->belongsTo('App\Models\IRobot', 'robot_id');
    }
}
