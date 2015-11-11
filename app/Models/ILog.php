<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input;

class ILog extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'log';
    public $timestamps = false;

    /**
     * 自定义查询
     * @return [type] [description]
     */
    public function r()
    {
        $builder = $this;
    	if (Input::has('where.start')) {
    		$builder = $builder->where('at', '>', Input::get('where.start'));
    	}

    	if (Input::has('where.end')) {
    		$builder = $builder->where('at', '<', Input::get('where.end'));
    	}

    	if (Input::has('where.memo')) {
    		$builder = $builder->where('memo', 'like', '%'.Input::get('where.memo').'%');
    	}

    	$page = rq('pagination') ? rq('pagination') : 1;
    	$per_page = rq('limit') ? rq('limit') : 20;
    	$skip = ($page-1) * $per_page;
    	$count = $builder->count();

    	$builder = $builder->skip($skip)->take($per_page)->orderBy('at', 'desc');
        $data = $builder->get();
    	return ss(['main' => $data, 'count' => $count, 'sql' => $builder->toSql(), 'start'=> Input::get('where.start')]);
    }

    /**
     * 添加日志
     * @param [type] $action_type_id [description]
     * @param [type] $ins_type_id    [description]
     * @param [type] $related_id     [description]
     * @param [type] $memo           [description]
     */
    public static function add_log($action_type_id, $ins_type_id, $related_id, $memo)
    {
    	Self::insert([
    		'action_type_id' => $action_type_id,
    		'ins_type_id' => $ins_type_id,
    		'related_id' => $related_id,
    		'memo' => $memo,
    		'operator_id' => uid() ? uid() : -1
    	]);
    }

    /**
     * 登录日志
     * @param  [type] $type [description]
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public static function login($type, $user)
    {
		$related_id = $user->id;

    	switch ($type) {
    		case 'employee':
    			$action_type_id = 1;
		    	$ins_type_id = 6;
		    	$memo = '员工登录';
    			break;
    		case 'agency':
    			$action_type_id = 2;
		    	$ins_type_id = 5;
		    	$memo = '代理商登录';
    			break;
    		case 'department':
    			$action_type_id = 3;
		    	$ins_type_id = 4;
		    	$memo = '科室登录';
    			break;
    		default:
    			break;
    	}
    	$memo = $memo.'-'.username();

    	Self::add_log($action_type_id, $ins_type_id, $related_id, $memo);
    }
}
