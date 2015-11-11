<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookController extends Controller
{
    private $ins_name = null;
    private $action_name = null;

    /* 权限添加
     * 第一级为用户类型
     * 第二级为model名
     * 第三级为方法名
     * */
    private $permission_api_set = [];

    public function __construct()
    {
        $this->permission_api_set = config('permission');
    }

    /**
     * 主方法
     * @param  [type] $p1 用户类型
     * @param  [type] $p2 model名
     * @return [type]     [description]
     */
    public function leader($p1 = null, $p2 = null, $p3 = null)
    {
        if (empty($p1)) return ee(2);

        $ins_name = $p1;
        $action_name = $p2;

        if ( ! $this->has_permission($ins_name, $action_name)) abort(403, d(403));

        // If exists model in univ, use it.
        if (class_exists(MName($ins_name, 'v')) && !rq('write_data'))
        {
            $ins = M($ins_name, 'v');
        }
        else if (class_exists(MName($ins_name, 'i')))
        {
            $ins = M($ins_name, 'i');
        }
        else return ee(2, 'ins_not_exists'.MName($ins_name, 'i'));

        return $ins->$action_name();
    }

    public function lastId($p1 = null, $p2=null)
    {
        if (!$p1) {
            return ee(2, 'ins_not_exists');
        }

        if (class_exists(MName($p1, 'i'))) {
            $ins = M($p1, 'i');
        }

        return $ins->lastId($p2);
    }

    public function has_permission($ins_name, $action_name)
    {
        if (in_array($ins_name, config('permission.public_ins')) || $action_name == 'exist') return true; // for user login or signup.
        if (he_is('employee')) return true;

        foreach ($this->permission_api_set as $test_chara => $user_type_set)
        {
            if (he_is($test_chara))
            {
                if ( ! array_key_exists($ins_name, $this->permission_api_set[$test_chara])) return false;
                if ( ! in_array($action_name, $this->permission_api_set[$test_chara][$ins_name])) return false;
                return true;
            }
        }
    }
    
    public function report($p1 = null)
    {
        if (!$p1) {
            abort(404);
        }
        $file = app_path() . '/Report/'.$p1.'.php';
        if (file_exists($file)) {
            include_once($file);
        }else{
            abort(404);
        }
    }
}