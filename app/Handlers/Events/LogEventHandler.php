<?php

namespace App\Handlers\Events;

use App\Events\LogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\AuthTrait;
use App\Models\ILog;

class LogEventHandler
{

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        if(method_exists($this, $event->table)){
            call_user_func_array([$this, $event->table], [$event->eventName, $event->data]);
        }
    }

    /**
     * robot
     */
    public function robot($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(5, 1, $data->id, '新建设备');
        }

        if ($method == 'u') {
            ILog::add_log(7, 1, $data->id, '新建设备');
        }
    }

    /**
     * robot_lease_log
     */
    public function robot_lease_log($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(6, 1, $data->robot_id, '修改设备租售信息');
        }
    }

    /**
     * 设备维修
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function robot_log($method = null, $data = null)
    {
        if ($method == 'c') {
            $type = 8;
            $memo = '设备USB数据导出错误';
            if ($data->action_type == 2) {
                $type = 9;
                $memo = '设备客户报修';
            }

            ILog::add_log($type, 1, $data->robot_id, $memo);
        }
    }

    public function hospital($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(11, 2, $data->id, '新建医院');
        }

        if ($method == 'r' && rq('log')) {
            ILog::add_log(10, 2, $data->id, '查看医院详情');
        }
    }

    public function department($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(12, 2, $data->hospital_id, '新建科室: '.$data->name.'（'.$data->username.')');
        }

        if ($method == 'u') {
            ILog::add_log(13, 2, $data->hospital_id, '编辑科室: '.'（'.$data->username.')');
        }

        if ($method == 'd') {
            ILog::add_log(14, 2, $data->hospital_id, '删除科室: '.$data->name.'（'.$data->username.')');
        }
    }
}
