<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IUsblog extends BaseModel
{
    protected $guarded = ['id'];

    protected $ins_name = 'usblog';

    public $timestamps = false;

    public function r()
    {
    	if (!intval(rq('id'))) {
    		ss('无效ID', 0);
    	}
        $data = $this->find(rq('id'));
        $this->eventFire('r', $data);
    	return ss($data);
    }
}
