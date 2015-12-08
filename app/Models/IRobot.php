<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Input;
use DB;

class IRobot extends BaseModel
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot';

    public $fillable = ['cust_id', 'employee_id', 'production_date', 'status', 'memo'];

    public function __construct()
    {
        parent::__construct();

        $this->createRule = [
            'cust_id' => 'required|unique:i_robot|regex:/^[0-9]{2}[A-L]{1}[0-9]{4}$/',
            'employee_id' => 'required|exists:i_employee,id',
            'production_date' => 'required|date'
        ];

        //$this->messages['regex'] = '字段 :attribute 格式错误';
        $this->messages['regex'] = '该值格式错误';
    }

    //public function r_($rq = [])
    //{
    //    $ins = $this->r_builder(rq());
    //    $rq = $rq ? rq : rq();
    //    if (rq('lease_log_where'))
    //    {
    //        //dd(rq('log_where'));
    //        $ins->whereHas('robotLeaseLog', function ($q) use ($rq)
    //        {
    //            $q->where($rq['lease_log_where'])->orderBy('id', 'desc');
    //        });
    //    }
    //    $d['main'] = $ins->get()->toArray();
    //    $d['main'] = array_where($d['main'], function($key, $value)
    //    {
    //        if (rq('lease_log_where'))
    //        {}
    //    });
    //    $d['count'] = $ins->count();
    //    return ss($d);
    //    dd($ins);
    //    //$this->get_lease_type($d[0]['id']);
    //}

    public function nr() {
        $builder = $this;

        $sql = 'select v_robot.*,i_hospital.name as hospital_name, i_agency.name as agency_name, i_employee.name as employee_name from v_robot left join i_employee on v_robot.employee_id=i_employee.id';
        
        $builder = DB::table('v_robot')->select('v_robot.*', 'i_hospital.name as hospital_name', 'i_agency.name as agency_name', 'i_employee.name as employee_name')
            ->leftJoin('i_agency', 'v_robot.agency_id', '=', 'i_agency.id')
            ->leftJoin('i_hospital', 'v_robot.hospital_id', '=', 'i_hospital.id')
            ->leftJoin('i_employee', 'v_robot.employee_id', '=', 'i_employee.id');

        $where = [];

        if(Input::has("where.cust_id")) {
            // $sql .= ' and v_robot.cust_id like "%'.Input::get('where.cust_id').'%"';
            $builder = $builder->where('v_robot.cust_id', 'like', '%'.Input::get('where.cust_id').'%');
            //$where[] = Input::get('where.cust_id');
        }

        if(Input::has("where.province_id")) {
            $builder->where('v_robot.province_id', Input::get('where.province_id'));
        }
        if(Input::has("where.city_id")) {
            $builder->where('v_robot.city_id', Input::get('where.city_id'));
        }

        $lease_type_id = Input::get('where.lease_type_id');
        if(Input::has("where.lease_type_id") && !empty($lease_type_id)) {
            $id = array_map('intval',$lease_type_id);
            // array_push($id, 'null');
            if(in_array(-1, $id)){
                $builder->whereRaw('(v_robot.lease_type_id is null or v_robot.lease_type_id in ('.implode(',', $id).') )');
            }else{
                $builder->whereIn('v_robot.lease_type_id', $id);
            }
        }

        $action_type_id = Input::get('where.action_type_id');
        if(Input::has("where.action_type_id") && !empty($action_type_id)) {
            $id = array_map('intval', $action_type_id);
            $builder->whereIn('v_robot.status', $id);
        }

        if(Input::has("where.agency_id")) {
            $builder->where('v_robot.agency_id', Input::get('where.agency_id'));
        }
        if(Input::has("where.hospital_id")) {
            $builder->where('v_robot.hospital_id', Input::get('where.hospital_id'));
        }

        if(Input::has('where.created_start')) {
            //$builder = $builder->where('v_robot.production_date', '>=', Carbon::createFromFormat('Y-m-d', Input::get('where.created_start')));
            $builder = $builder->where('v_robot.production_date', '>=', Input::get('where.created_start'));
        }
        
        if(Input::has("where.created_end")) {
            $builder = $builder->where('v_robot.production_date', '<=', Carbon::createFromFormat('Y-m-d', Input::get('where.created_end')));
        }

        if (Input::has('where.log_action_tid')) {
            $value = Input::get('where.log_action_tid');
            if ($value == 0) {
                $builder = $builder->where('v_robot.log_count', '=', null);
            }else if($value == 1){
                $builder = $builder->where('v_robot.log_count', '>', 0);
            }
        }
        
        $pagination = Input::get("pagination", 1);
        $offset = 0;
        $perpage = $this->default_limit;
        // dd($perpage, $this->default_limit);
        $result = $builder->groupBy('v_robot.cust_id')->skip(($pagination - 1) * $perpage)->take($perpage)->get();
        
        $r = [
            'count' => count($result),
            'main'  => $result,
            'rq' => $builder->toSql()
        ];

        return ss($r);
    }

    public function cu_($in = null)
    {
        $in = $in ? $in : rq();
        $rq = rq();

        $ins = parent::cu($rq);

        if ($ins['status'] == 0) {
            return $ins;
        }

        if (!rq('id')) {
            $lease_log_ins = M('robot_lease_log');

            $lease_log_ins->robot_id = $ins['d']['id'];
            $lease_log_ins->lease_type_id = -1;
            $lease_log_ins->agency_id = -1;
            $lease_log_ins->hospital_id = -1;
            $lease_log_ins->recent = 1;
            $r = $lease_log_ins->save();
        }
        
        return $ins;
    }

    public function search_by_log($in = null)
    {
        $in = $in ? $in : rq();
        $log_ins = M('robot_lease_log');

        $r = $this->whereHas('robot_lease_log', function ($q) use ($in)
        {
            $q->where($in)->orderBy('id', 'desc')->first();
        });

        return $r;
    }

    public function get_lease_type($id)
    {
        $r = $this->with('robotLeaseLog')->findOrFail($id)->toArray();
        return $r;
    }

    /**
     * 关联职员
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\IEmployee', 'employee_id');
    }

    //public function hospital()
    //{
    //    return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    //}

    /**
     * 关联Mark
     */
    public function mark()
    {
        return $this->hasMany('App\Models\IMark', 'robot_id');
    }

    /**
     * 关联机器人记录
     */
    public function robotLog()
    {
        return $this->hasMany('App\Models\IRobotLog', 'robot_id');
    }

    // todo
    public function used_mark()
    {
        return $this->hasMany('App\Models\IMark', 'robot_id')->select('id', 'robot_id')->whereNotNull('used_at');
    }

    // /**
    //  * 关联机器人记录 -- 最新
    //  */
    // public function robotLogNow()
    // {
    //     return $this->hasMany('App\Models\IRobotLog', 'robot_id')->where('');
    // }

    /**
     * 关联机器人销售记录
     */
    public function robotLeaseLog()
    {
        return $this->hasMany('App\Models\IRobotLeaseLog', 'robot_id');
    }
    
    /**
     * 医院关联设备
     */
    public function getRobotByHospitalId() {
        $builder = $this;
        
        $builder = DB::table('i_robot_lease_log')->select('i_robot.cust_id as robot_id', 'i_robot.status', 'i_robot_lease_log.lease_type_id', 'i_employee.name',
            'i_robot_lease_log.lease_started_at', 'i_robot_lease_log.lease_ended_at')
        ->leftJoin('i_robot', 'i_robot_lease_log.robot_id', '=', 'i_robot.id')
        ->leftJoin('i_employee', 'i_employee.id', '=', 'i_robot.employee_id');
        
        $where = [];
        $builder->where('i_robot_lease_log.hospital_id', Input::get('hospital_id'));
        $builder->where('i_robot_lease_log.recent', Input::get('recent'));
        $result = $builder->get();
        $r = [
            'count' => count($result),
            'main'  => $result,
            'rq' => $builder->toSql()
        ];
        
        return ss($r);
    }
    
    /**
     * 根据设备id获取上次usb数据采集时间
     */
    public function getLeaseUploadByRobotId() {
        $main = DB::select(DB::raw('select max(upload_at) as upload_at from i_usblog where robot_id='.Input::get('robot_id')));
        $r = [
            'count' => count($main),
            'main'  => $main,
        ];
    
        return ss($r);
    }
}
