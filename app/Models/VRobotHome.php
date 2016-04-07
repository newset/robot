<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Cache; 

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
		$buider = DB::table('v_robot_frontpage')
			->select('v_robot.*', 'i_employee.name as employee_name', 'i_hospital.name as hospital_name', 'i_agency.name as agency_name')
			->leftJoin('v_robot', 'v_robot_frontpage.cust_id', '=', 'v_robot.cust_id')
			->leftJoin('i_employee', 'v_robot_frontpage.employee_id', '=', 'i_employee.id')
			->leftJoin('i_hospital', 'v_robot_frontpage.hospital_id', '=', 'i_hospital.id')
			->leftJoin('i_agency', 'v_robot_frontpage.agency_id', '=', 'i_agency.id');

		$settings = Cache::get('i_settings', null);
		if (!empty($settings)) {
		    $default_lease_end = array_get($settings, 'system.lease_end');
		}	
		$sql = 'datediff(v_robot_frontpage.ended_at, now()) < '.$default_lease_end.' and datediff(v_robot_frontpage.ended_at, now()) > 0';
		$stop = $buider->whereRaw($sql)->get();
		$collect = $buider->whereRaw('datediff(now(), v_robot_frontpage.upload_at) > 90 and v_robot_frontpage.upload_at is not null')
			->orWhereRaw('datediff(now(), v_robot_frontpage.production_date) > 90 and v_robot_frontpage.upload_at is null')
			->get();
		
		$error = DB::table('v_robot_frontpage2')->whereRaw('max_log > max_usb')
			->select('v_robot.*', 'i_employee.name as employee_name', 'i_hospital.name as hospital_name', 'i_agency.name as agency_name')
			->leftJoin('v_robot', 'v_robot_frontpage2.cust_id', '=', 'v_robot.cust_id')
			->leftJoin('i_employee', 'v_robot_frontpage2.employee_id', '=', 'i_employee.id')
			->leftJoin('i_hospital', 'v_robot_frontpage2.hospital_id', '=', 'i_hospital.id')
			->leftJoin('i_agency', 'v_robot_frontpage2.agency_id', '=', 'i_agency.id')
			->get();

		return ss([
			's' => $stop,
			'c' => $collect,
			'e' => $error
		]);
	}

	public function mark()
	{
		if (he_is('agency')) {
			$data = DB::table('i_mark')->select('i_mark.*', 'i_doctor.name as doctor_name', 'i_hospital.name as hospital_name')
				->where('agency_id', uid())
				->whereNull('doctor_id')
				->where('i_mark.status', 2)
				->leftJoin('i_hospital', 'i_mark.hospital_id', '=', 'i_hospital.id')
				->leftJoin('i_doctor', 'i_mark.doctor_id', '=', 'i_doctor.id')
				->get();
			return ss($data);
		}else{
			return ss('无效用户组', 0);
		}
	}

	public function robot()
	{
		if (!he_is('agency')) {
			abort(403);
		}

		$data = DB::table('i_robot')->select('i_robot.*', 'i_robot_lease_log.*', 'i_hospital.name as hospital_name', 'i_employee.name as employee_name')
			->leftJoin('i_robot_lease_log', 'i_robot.id', '=', 'i_robot_lease_log.robot_id')
			->leftJoin('i_hospital', 'i_hospital.id', '=', 'i_robot_lease_log.hospital_id')
			->leftJoin('i_employee', 'i_employee.id', '=', 'i_robot.employee_id')
			->where('i_robot_lease_log.recent', 1)
			->where('i_robot_lease_log.agency_id', uid())
			->groupBy('i_robot.cust_id')
			->orderBy('i_robot.id', 'i_robot_lease_log.lease_ended_at desc')
			->get();
		return ss($data);
	}

}
