<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IRobot extends BaseModel
{
    protected $guarded = ['id'];
    protected $softDelete = false;
    protected $ins_name = 'robot';

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

    public function cu_($in = null)
    {
        $in = $in ? $in : rq();
        $rq = rq();

        if (rq('id'))
            $ins = $this->findOrFail($rq['id']);
        else $ins = $this;

        $ins->cust_id = $rq['cust_id'];
        $ins->production_date = $rq['production_date'];
        $ins->save();

        $lease_log_ins = M('robot_lease_log');

        $lease_log_ins->robot_id = $ins->id;
        $lease_log_ins->lease_type_id = $rq['lease_type_id'];
        $lease_log_ins->lease_started_at = $rq['lease_started_at'];
        $lease_log_ins->lease_ended_at = $rq['lease_ended_at'];
        $lease_log_ins->agency_id = $rq['agency_id'];
        $lease_log_ins->hospital_id = $rq['hospital_id'];
        $r = $lease_log_ins->save();
        if ($r)
            return ss();
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

    /**
     * 关联机器人销售记录
     */
    public function robotLeaseLog()
    {
        return $this->hasMany('App\Models\IRobotLeaseLog', 'robot_id');
    }
}
