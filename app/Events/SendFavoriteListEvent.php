<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;

class SendFavoriteListEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $favorites;

    public function __construct(User $user, Array $favorites)
    {
        $this->user = $user;
        $this->favorites = $favorites;
    }
}
