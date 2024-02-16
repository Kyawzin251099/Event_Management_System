<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notification to all event attendes that event starts soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $events = Event::with(['booking.venue', 'adHoc'])
            ->whereHas(
                'booking.venue',
                fn ($query) =>
                $query->whereBetween('avail_start_date', [$today, $tomorrow])
            )->get();
        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);
        $this->info("Found {$eventCount} {$eventLabel}.");
        //dd($eventCount);
        $events->each(
            fn ($event) => $event->adHoc->each(
                fn ($adHoc) => $adHoc->notify(
                    new EventReminderNotification($event)
                )
            )
        );
        $this->info('Event reminder notification sent successfully!');
    }
}
