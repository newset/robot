<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRobotLeaseLog extends IRobot
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot_lease_log';

    public function __construct()
    {
        $this->table = table_name($this->ins_name, 'v');
    }
}
