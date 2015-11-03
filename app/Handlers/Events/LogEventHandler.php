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
     *
     */
    public function robot($method = null, $data = null)
    {
        if ($method == 'c') {
            ILog::add_log(5, 1, $data->id, '新建设备');
        }
    }
}
