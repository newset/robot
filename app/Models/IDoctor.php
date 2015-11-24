<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IDoctor extends BaseModel
{

    protected $guarded = ['id'];

    protected $ins_name = 'doctor';

    public function __construct()
    {
        parent::__construct();
        $this->table = table_name($this->ins_name, 'i');
        $this->createRule = [
            'email' => 'required|email'
        ];
    }

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

    public function disable()
    {
        if (rq('id')) {
            $row = $this->find(rq('id'));
            //$row->update(['status' => -1, 'cust_id'=> null, 'wechat_id'=> null]);
            $row->update(['status' => -1]);

            $this->eventFire('disable', $row);
            return ss($row);
        }else{
            ee(2);
        }
    }
    
    public function recover()
    {
        if (rq('id')) {
            $row = $this->find(rq('id'));
            $row->update(['status' => 1, 'wechat_id' => null]);
    
            $this->eventFire('recover', $row);
            return ss($row);
        }else{
            ee(2);
        }
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

