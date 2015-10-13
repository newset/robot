<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRobot extends IRobot
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot';

    public function __construct()
    {
        $this->table = table_name($this->ins_name, 'v');
    }

    public function lastAgency()
    {
    	return $this->belongsTo('App\Models\IAgency', 'agency_id');
    }

    public function lastHospital()
    {
    	return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }
}
