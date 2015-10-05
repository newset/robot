<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\Wechat\Server;
use Log;

class IWechatMsg extends BaseModel
{

    protected $guarded = ['id'];

    protected $ins_name = 'wechat_msg';

    public function leader()
    {

    }

    public function config()
    {
        return $server = new Server(env('WECHAT_APPID'), env('WECHAT_TOKEN'), env('WECHAT_ENCODING_KEY'));
        echo $server->serve();
    }

    public function check_signature()
    {
        //dd(env('WECHAT_TOKEN'));
        $rq = rq();
        $signature = $rq["signature"];
        $timestamp = $rq["timestamp"];
        $nonce = $rq["nonce"];

        $token = env('WECHAT_TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
