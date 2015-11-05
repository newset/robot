<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IMessage extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'privatemessage';
  
    public $timestamps = false;

    function __construct() {
        parent::__construct();
    }

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
        // 验证发信规则
        $valid = $this->verify($rq);

    	$rq['senderid'] = uid();
    	$rq['sendername'] = username();
    	// return his_chara()[0];
    	$rq['sendertype'] = $type[his_chara()[0]];
    	if (his_chara()[0] == 'agency') {
    		$rq['recipienttype'] = 1;
    		$rq['recipientid'] = 1;
    		$rq['recipientname'] = 'admin';
    	}elseif (his_chara()[0] == 'employee') {
	    	$rq['recipienttype'] = $type[$rq['recipienttype']];
    	}

    	return parent::c($rq);
    }

    public function verify($rq = null)
    {
        if ($rq['sendertype'] == 1) {
            return true;
        };

        if ($rq['sendertype'] == 2 && $rq['recipientname'] == 'admin') {
            return true;
        };
        return true;
    }

    public function read()
    {
        $id = rq('id');
        $data = $this->find($id)->update(['read'=> 1]);
        return ss($data);
    }
}
