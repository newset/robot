<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IDoctor extends BaseModel
{

    protected $guarded = ['id'];

    protected $ins_name = 'doctor';

    public function get_his_history()
    {
        $d['all'] = M('mark')->where('doctor_id', uid())->orderBy('archive_at')->get();
        $d['archived'] = M('mark')->where('doctor_id', uid())->whereNotNull('archive_at')->get();
        return $d;
    }

    public function lastId($id = null)
    {   
        if ($id) {
            $row = M('doctor')->where('cust_id', $id)->first();

            if ($row) {
                return ss($row, 0);
            }else{
                return ss($id);
            }
        }
        return M('doctor')->max('cust_id');
    }

    /**
     * 关联Mark
     */
    public function mark()
    {
        return $this->hasMany('App\Models\IMark', 'doctor_id');
    }

    /**
     * 关联医生
     */
    public function hospital()
    {
        return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }

    /**
     * 关联科室
     */
    public function department()
    {
        return $this->belongsTo('App\Models\IDepartment', 'department_id');
    }
}

