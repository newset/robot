<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ILog extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'log';
    public $timestamps = false;

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
    		'operator_id' => uid()
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
