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

    /**
     * 医院 Log
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function hospital($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(11, 2, $data->id, '新建医院');
        }

        if ($method == 'r' && rq('log')) {
            ILog::add_log(10, 2, $data->id, '查看医院详情');
        }
    }

    /**
     * 科室 Log
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
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

    /**
     * 医生 Log
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function doctor($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(15, 4, $data->id, '新建医生');
        }

        if ($method == 'u') {
            ILog::add_log(16, 4, $data->id, '编辑医生');
        }

        if ($method == 'disable') {
            ILog::add_log(17, 4, $data->id, '医生被禁用');
        }

    }

    /**
     * 代理商
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function agency($method = null, $data = null)
    {
        if ($method == 'r') {
            ILog::add_log(18, 5, $data, '查看代理商详情');
        }

        if ($method == 'u') {
            ILog::add_log(21, 5, $data->id, '修改代理商信息');
        }

        if ($method == 'enable') {
            ILog::add_log(19,5, $data, '代理商被恢复');
        }

        if ($method == 'disable') {
            ILog::add_log(20,5, $data, '代理商被禁用');
        }
    }

    /**
     * Mark 相关 Log
     * 
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function mark($method = null, $data = null)
    {
        if ($method == 'r') {
            ILog::add_log(22, 3, $data, '查看mark详情');
        }

        if ($method == 'modify') {
            ILog::add_log(23, 3, $data->id, '手工将Mark绑定给代理商 '.$data->agency_id);
        }

        if ($method == 'modify') {
            ILog::add_log(24, 3, $data->id, '手工将Mark解绑');
        }

        if ($method == 'recycle') {
            ILog::add_log(25, 3, $data->id, '将Mark设为损坏报废');
        }

        if ($method == 'replace') {
            ILog::add_log(26, 3, $data->id, '手工将Mark设为损坏更新');
        }

        if ($method == 'add' && he_is('employee')) {
            ILog::add_log(27, 3, -1, $data);
        }

        if ($method == 'bind' && he_is('employee')) {
            ILog::add_log(28, 3, -1, $data);
        }

        if ($method == 'unbind' && he_is('employee')) {
            ILog::add_log(29, 3, -1, $data);
        }
    }

    /**
     * usb 导入
     * @param  [type] $method [description]
     * @param  [type] $data   [description]
     * @return [type]         [description]
     */
    public function usblog($method = null, $data = null)
    {
        if ($method == 'r') {
            ILog::add_log(30, 3, -1, $data->id);
        }
    }

    public function employee($method = null, $data = null)
    {
        if ($method == 'pass' && $data->id == uid()) {
            ILog::add_log(31, 6, -1, '员工自己修改密码');
        }

        if ($method == 'u' && $data->id == uid() && !rq('toggle')) {
            return ILog::add_log(32, 6, -1, '员工修改个人信息');
        }

        if ($method == 'u') {
            if (rq('toggle') && !rq('status')) {
                return ILog::add_log(34, 6, $data->id, '员工被设为离职');
            }

            if (rq('toggle') && rq('status')) {
                return ILog::add_log(35, 6, $data->id, '员工恢复在岗');
            }

            ILog::add_log(36, 6, $data->id, '编辑员工');
        }

    }

    public function auth($method = null, $data = null)
    {
        $action_type_id = 44;

        if ($method == 'reminder' && $data['type'] == 'agency') {
            $action_type_id = 45;
        }

        $user = $data['user'];
        $hash = hash_password($user->email.time());

        // find or save 
        ILog::add_log($action_type_id, -1, $user->id, $hash);
    }
}
