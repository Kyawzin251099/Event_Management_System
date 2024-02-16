<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Config;

class EventObserver
{

    public function deleting(Event $event): void
    {
        $event->booking()->delete();
        $event->eventImage()->delete();
    }

}
