<?php

namespace App\Handlers\Events;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\AuthTrait;

class UserEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(Event $event)
    {
    }

    /**
     *
     */
    public function userSignup($event)
    {
        $input = rq();
        $input['form_vals']['user_type'] = rq('user_type');
        return M(rq('user_type'))->login($input['form_vals']);
    }
}
