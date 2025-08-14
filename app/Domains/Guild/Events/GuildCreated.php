<?php

declare(strict_types=1);

namespace App\Domains\Guild\Events;

use App\Domains\Guild\Models\Guild;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class GuildCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Guild $guild
    ) {}

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('guild-created');
    }
}
