<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISetting extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'settings';
    protected $softDelete = false;

    public $timestamp = false;

    function __construct() {
    	parent::__construct();

    	$this->createRule = [
	        'k' => 'required|exists:i_setting,k',
	        'v' => json
	    ];
    }

    public function getAttributeV($value)
    {
    	$value ? 1 : $value = '{}';
    	return json_decode($value);
    }

    public function r($rq = null)
    {
    	$data = $this->get();
    	$obj = [];
    	foreach ($data as $k => $v)
        {
            $obj[$k] = $v;
        }

    	return ss($obj);
    }
}
