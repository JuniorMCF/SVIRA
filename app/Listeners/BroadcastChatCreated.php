<?php

namespace App\Listeners;

use App\Events\ChatCreated;
use App\Models\Chat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastChatCreated
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
     * @param  Chat  $event
     * @return void
     */
    public function handle(Chat $event)
    {
        //
        broadcast(new ChatCreated($event));
    }
}
