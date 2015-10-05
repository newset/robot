<?php

namespace App\Models;
use Input;
use Illuminate\Database\Eloquent\Model;

class IMark extends BaseModel
{
    protected $guarded = ['id'];

    protected $ins_name = 'mark';

    public function bat_exists($in = [])
    {
        $in = $in ? $in : rq();

        $exists_id = [];
        foreach ($in as $cust_id)
        {
            if ($this->where('cust_id', $cust_id)->exists())
            {
                $exists_id[] = $cust_id;
            }
        }

        if (count($exists_id))
            return ee(2, $exists_id);
        else
            return ss();
    }

    public function bat_cu($in = [])
    {
        $in = $in ? $in : rq();
        if (rq('mark_list'))
        {
            //dd($in['mark_list']);
            $mark_list = $in['mark_list'];
            $bat_c = [];

            foreach ($mark_list as $cust_id)
            {
                if ($this->where('cust_id', $cust_id)->exists())
                {
                    $ins = $this->where('cust_id', $cust_id)->first();
                    if (he_is('employee'))
                        $ins->agency_id = $in['agency_id'];
                    $ins->hospital_id = $in['hospital_id'];
                    $ins->save();
                    continue;
                }

                if (!empty($in['only_update']))
                    continue;

                $bat_c[] = [
                    'cust_id' => $cust_id,
                    'agency_id' => $in['agency_id'],
                    'hospital_id' => $in['hospital_id'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];
            }
            $ins = M($this->ins_name);
            if (he_is('employee'))
            {
                $r = $ins->insert($bat_c);
                return $r ? ss() : ee(1);
            }
            return ss();
        }
        return ee(2);
    }

    public function scan_u()
    {
        if(rq('cust_id'))
            $ins = $this->where('cust_id', rq('cust_id'))->first();
        else return ee(2, 'missing_cust_id');

        if(!$ins) return ee(2, 'record_not_found');
        if($ins->used_at) return ee(2, 'mark_is_already_used');
        $ins->doctor_id= uid();
        $ins->used_at = \Carbon\Carbon::now();
        if($ins->save())
        {
            return ss();
        }
    }

    public function import_data()
    {
        $file = Input::file('file');

        $ext = $file->getClientOriginalExtension();
        if ($ext != 'mdb') return ee(2);

        $dir = base_path() . '/storage/mdb/';
        $name = uniqid() . '.' . time() . '.' . $ext;
        $path = $dir . $name;

        $file->move($dir, $name);

        $d = $this->parse_mdb($path, 'tb_exp');
        $rob_ins = M('robot');
        $hos_ins = M('hospital');
        foreach ($d as $row)
        {
            $ins = $this->where('cust_id', $row['code'])->first();
            if ($ins)
            {
                $rob = $rob_ins->where('cust_id', $row['robot_sn'])->first();
                $hos = $hos_ins->where('name', $row['hospital'])->first();
                if ($rob)
                    $ins->robot_id = $rob->id;
                if ($hos)
                    $ins->hospital_id = $hos->id;
                $ins->save();
            }
        }
    }

    public function r_()
    {
        dd(uid());
        $cond = rq();
        if (he_is('agency'))
        {
            $cond['where']['agency_id'] = uid();
        }
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\IDoctor', 'doctor_id');
    }


    public function hospital()
    {
        return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }


    public function agency()
    {
        return $this->belongsTo('App\Models\IAgency', 'agency_id');
    }

    //public function cu_()
    //{
    //    if(he_is('agency'))
    //    {
    //        $safe_data = array_only(rq(), ['id', 'doctor_id', 'hospital_id']);
    //        $ins = M($this->ins_name);
    //        return $ins->cu($safe_data);
    //    }
    //}


    public function robot()
    {
        return $this->belongsTo('App\Models\IRobot', 'robot_id');
    }

}
