<?php

namespace App\Listeners;

use App\Events\PengumumanEvent;
use App\Mail\PengumumanMail;
use App\Models\Pengumuman;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PengumummanNotification
{
    /**
     * Handle the event.
     *
     * @param  PengumumanEvent  $event
     * @return void
     */
    public function handle(PengumumanEvent $event)
    {
        Mail::to($event->email)->send(new PengumumanMail($event->pengumuman));
    }
}
