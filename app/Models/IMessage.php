<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IMessage extends BaseModel
{
    protected $guarded = ['id'];

    protected $ins_name = 'privatemessage';
    public $timestamps = false;

    public $createRule = [
    	'messagecontent'=> 'required',
    	'recipienttype'=> 'required',
    	'recipientid'=> 'required'
    ];

    public function c($rq = null)
    {
    	$type = [
    		'employee' => 1,
    		'agency' => 2,
    		'doctor' => 3
    	];

    	$rq = rq();
    	$rq['senderid'] = uid();
    	$rq['sendername'] = username();
    	// return his_chara()[0];
    	$rq['sendertype'] = $type[his_chara()[0]];

    	$rq['recipienttype'] = $type[$rq['recipienttype']];

    	return parent::c($rq);
    }

}
