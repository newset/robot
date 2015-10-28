<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB; 

class VRobotHome extends BaseModel
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot_frontpage';
    protected $table = 'v_robot_frontpage';

    public function home()
    {
        // select * from v_robot_frontpage where datediff(ended_at,now())<30 or (datediff(now(), upload_at)>90 
        // and upload_at is not null) or (datediff(now(),production_date)>90 and upload_at is null)
        $data = DB::table('v_robot_frontpage')->select('v_robot.*', 'i_employee.name as employee_name', 'i_hospital.name as hospital_name', 'i_agency.name as agency_name')
            ->whereRaw('datediff(v_robot_frontpage.ended_at, now()) < 30')
            ->orWhereRaw('datediff(now(), v_robot_frontpage.upload_at) > 90 and v_robot_frontpage.upload_at is not null')
            ->orWhereRaw('datediff(now(), v_robot_frontpage.production_date) > 90 and v_robot_frontpage.upload_at is null')
            ->leftJoin('v_robot', 'v_robot_frontpage.cust_id', '=', 'v_robot.cust_id')
            ->leftJoin('i_employee', 'v_robot_frontpage.employee_id', '=', 'i_employee.id')
            ->leftJoin('i_hospital', 'v_robot_frontpage.hospital_id', '=', 'i_hospital.id')
            ->leftJoin('i_agency', 'v_robot_frontpage.agency_id', '=', 'i_agency.id')
            ->get();

        return ss($data);
    }

}
