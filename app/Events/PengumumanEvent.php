<?php

namespace App\Events;

use App\Models\Pengumuman;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PengumumanEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pengumuman, $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pengumuman $pengumuman, $email)
    {
        $this->pengumuman = $pengumuman;
        $this->email = $email;
    }
}
