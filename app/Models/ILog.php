<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ILog extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'log';

    public function c($rq = null)
    {

    }

    public function add_log($action_type_id, $ins_type_id, $related_id, $memo)
    {
    	
    }

    public static function login($type, $user)
    {
    	
    }
}
