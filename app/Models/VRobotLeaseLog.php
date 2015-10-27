<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRobotLeaseLog extends IRobot
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot_lease_log';
    protected $table = 'i_robot_lease_log';

}
