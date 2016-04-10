<?php

namespace App\Models;
use Input;
use Illuminate\Database\Eloquent\Model;
use Session;
use Requests;
use DB;

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

    public function bat_mark()
    {
        $action = rq('action');
        // action data 必须
        if (he_is('agency')){
            $user = uid();
            $row = M('agency')->select('password')->where('id', $user)->first();
            if ($action == 'checkout' || $action == 'checkout2'){
                // $action='checkout';
            }else{
                $action ='a'.$action;
                if (!in_array($action, array('abind','aunbind'))){
                    return '非法操作';
                }
            }
        }else{
            $user = Session::get('uid');
            $row = M('employee')->select('password')->where('id', $user)->first();
            if (!in_array($action, array('bind','unbind','add'))){
                return '非法操作';
            }
        }

        $baseUrl = env('ISAPI_URL');
        $pass = substr($row->password, -4);
        $time = time();

        $params = [
            'a' => $action,
            'b' => $time,
            'c' => $user * 3 * substr($time, -4),
            'd' => $pass
        ];

        $url = $baseUrl.http_build_query($params);
        $data = rq('data');
        try {
            $response = Requests::post($url, [], $data);
        } catch (Exception $e) {
            return ss(['msg'=> '请求异常'], 0);
        }

        $this->eventFire($action, $response->body);
        $res = $response->body;
        return ss($res);
    }

    public function r()
    {
        if (Input::get('log')) {
            $this->eventFire('r', rq('id'));
        }
        return parent::r();
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

    public function modify()
    {
        $action = rq('action');
        $mark = $this->where('id', rq('mark'))->first();

        if ($action == 'bind') {
            $mark->agency_id = rq('agency_id');
            $mark->sold_at = date("Y-m-d H:i:s");
            $this->eventFire('modify', $mark);

        }else if($action == 'unbind'){
            $mark->agency_id = -1;
            $mark->sold_at = null;
            $this->eventFire('unmodify', $mark);

        }
        $mark->save();

        return ss($mark);
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

    public function recycle()
    {   
        $mark = rq('id');
        $row = $this->where('id', $mark)->first();
        $row->status = 3;
        $res = $row->save();
        $this->eventFire('recycle', $row);

        return ss($res);
    }

    public function replace()
    {   
        $mark = rq('id');
        $cmid = rq('cmid');
        // 验证 cmid todo
        $row = $this->where('id', $mark)->first();
        $newMark = $this->where(['cust_id'=>$cmid, 'status'=>1, 'agency_id'=>-1])->first();
        $res = null;
        if(empty($newMark)) {
            
        }
        else { 
            $row->status = 4;
            $row->cmid = $newMark->cust_id;
            $res = $row->save();
            if($row->agency_id != -1) {
                $newMark->agency_id = $row->agency_id;
                $newMark->shipped_at = date("Y-m-d H:i:s");
            }
            if($row->hospital_id != -1) {
                $newMark->hospital_id = $row->hospital_id;
                $newMark->sold_at = date("Y-m-d H:i:s");
            }
            $newMark->save();
        }
        $this->eventFire('replace', $row);
        return ss($res);
    }

    /**
     * mark归档
     * @author tanqing
     * @date 2015年10月19日
     */
    public function ck_mark(){
        if (he_is('agency')){
            $time = rq('d');
            $time = date("Y-m-d H:i:s",strtotime($time .'+1 days')-1);
            $ins = M($this->ins_name);
            $ins->where('agency_id',uid())
            ->where('doctor_id','>',0)
            ->whereNull('archive_at')
            ->where(function($query) use ($time)
            {
                $query->where(DB::raw('CAST(used_at as datetime)') ,'<=',$time)
                      ->orWhereNull('used_at');
            })
            ->update(['archive_at'=>date("Y-m-d H:i:s")]);
            return ss('归档成功'); 
        }  
    }
    /**
     * 归档历史
     * 
     * @author tanqing
     * @date 2015年10月19日
     */
    public function ck_mark_history(){
        if (he_is('agency')){
            $pagination = Input::get("pagination",1);
            DB::enableQueryLog();
            $main = DB::table('i_mark')->select('archive_at',DB::raw('count(1) as mark_count'))
            ->where('agency_id',uid())
            ->whereNotNull('archive_at')
            ->groupBy('archive_at')
            ->orderBy('archive_at','DESC')->get();
           $main2 = DB::select(DB::raw('select count(1) as total from (select count(1) as mark_count from `i_mark` where agency_id = '.uid().' and  archive_at is not null group by `archive_at` order by `archive_at` desc) as c'));
           $sql = DB::getQueryLog();
            $r = [
                'count' => $main2[0]->total,
                'main'  => $main,
                'where' => $sql
            ];
            return ss($r);
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

    public function robot()
    {
        return $this->belongsTo('App\Models\IRobot', 'robot_id');
    }

    /**
     * 根据医生id获取已归档或未归档mark
     */
    public function getMarkByDoctorId() {
        $builder = $this;
    
        $builder = DB::table('i_mark')->select('i_mark.id')
        ->leftJoin('i_doctor', 'i_mark.doctor_id', '=', 'i_doctor.id');
    
        $where = [];
        $builder->where('i_doctor.id', Input::get('doctor_id'));
        if(Input::get('type')==0) {
            $builder->whereNotNull('archive_at');
        }
        else if(Input::get('type')==1) {
            $builder->whereNull('archive_at');
        }
        $result = $builder->get();
        $r = [
            'count' => count($result),
            'main'  => $result,
            'rq' => $builder->toSql()
        ];
    
        return ss($r);
    }
}
