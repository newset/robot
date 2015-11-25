<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Requests;
use DB;

class IDepartment extends BaseModel
{
    // 登出和登出
    use AuthTrait;

    protected $table = null;
    protected $guarded = ['id', 'password'];
    protected $ins_name = 'department';

    public function __construct()
    {
        parent::__construct();

        $this->table = table_name($this->ins_name);

        $this->createRule = [
            'name'        => 'required',
            'username'    => 'required|unique:'. table_name($this->ins_name),
            'password'    => 'required|min:6|regex:/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z\d]{6,20}$/',
            'hospital_id' => 'required|exists:' . table_name('hospital') . ',id',
        ];

        $this->updateRule = [
            'id'          => 'required|numeric',
            'password'    => 'required|min:6|regex:/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z\d]{6,20}$/',
        ];

        $this->messages = [
            'password.regex' => '密码不符合要求，必选包含字母和数字且不低于6位'
        ];
    }

    protected $hidden = ['password'];

    public function rl()
    {
        $user = uid();
        $time = time();
        $row = $this->select(DB::raw('right(password, 4) as pass, name'))->where('id', $user)->first();

        $params = [
            'a' => 'department',
            'b' => $time,
            'd' => $row->pass,
            'c' => substr($time, -4)*3*$user
        ];

        $baseUrl = 'http://www.remebot.cn/isapi/remeisapi.dll/?';
        $url = $baseUrl.http_build_query($params);
        $res = Requests::get($url);
        $data = json_decode($res->body);
        $data->name = $row->name;

        return response()->json($data);
    }

    /**
     * 关联医生
     */
    public function doctor()
    {
        return $this->hasMany('App\Models\IDoctor', 'department_id');
    }

    /**
     * 关联医院
     */
    public function hospital()
    {
         return $this->belongsTo('App\Models\IHospital', 'hospital_id');
    }

    /**
     * 创建
     */
    public function c($rq = NULL)
    {
        $this->guarded = arr_except_vals($this->guarded, ['password']);

        if (!$rq) {
            $rq = rq();
        }
        if (isset($rq['password'])) {
            $rq['password'] = hash_password($rq['password']);
        }
        return parent::c($rq);
    }

    /**
     * 更新
     */
    public function u($rq = NULL)
    {
        $this->guarded = arr_except_vals($this->guarded, ['password']);

        if (!$rq) {
            $rq = rq();
        }
        if (isset($rq['password'])) {
            $rq['password'] = hash_password($rq['password']);
        }
        return parent::u($rq);
    }

}
