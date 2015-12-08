<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class ISetting extends BaseModel
{
    protected $guarded = ['id'];
    protected $ins_name = 'settings';
    protected $softDelete = false;
    protected $primaryKey = 'id';

    public $timestamps = false;

    function __construct() {
    	parent::__construct();

    	$this->createRule = [
	        'k' => 'required|exists:i_setting,k',
	        'v' => 'json'
	    ];
    }

    public function getVAttribute($value)
    {
    	$value ? 1 : $value = '{}';
    	return json_decode($value);
    }

    public function setVAttribute($value)
    {
    	$value ? 1 : $value = "{}";
    	$this->attributes['v'] = json_encode($value);
    }

    /**
     * 查询设置
     * @param  [type] $rq [description]
     * @return [type]     [description]
     */
    public function r($rq = null)
    {
    	$data = $this->get()->reduce(function ($carry, $item) {
		    $carry[$item->k] = $item->v;
		    return $carry;
		}, []);

    	return ss($data);
    }

    /**
     * 保存设置
     * @param  [type] $rq [description]
     * @return [type]     [description]
     */
    public function c($rq = NULL)
    {
    	// add pattern
    	$rq = rq('data');
    	$res = [];
        $cache = [];
    	if ($rq) {
    		foreach ($rq as $key => $value) {
    			$item = $this->firstOrNew(['k'=> $key]);
    			$item->k = $key;
    			$item->v = $value;
    			$item->save();
    			$res[] = $item;
                $cache[$item->k] = $value;
    		}
    	}
        // reset cache
        Cache::forever('i_settings', $cache);        

    	return ss($res);
    }
}
