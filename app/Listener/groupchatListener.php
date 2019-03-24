<?php

namespace App\Listener;

use App\Events\groupevent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class groupchatListener
{
    /**
     * Create the event listener.
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
     * @param  groupevent  $event
     * @return void
     */
    public function handle(groupevent $event)
    {
        //
    }
}
