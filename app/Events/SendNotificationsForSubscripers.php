<?php

namespace App\Events;

use App\Models\Tag;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendNotificationsForSubscripers implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 
    public $tag;
    protected $new_post_name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tag $tag, $new_post_name)
    {
        $this->tag = $tag;
        $this->new_post_name = $new_post_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-post-added');
    }

    public function broadcastWith()
    {
        $extra = [ 
            'subscriptionsIds' => $this->tag->subscriptions()->pluck('user_id')->toArray(),
            'new_post_name' => $this->new_post_name
        ];

        return array_merge($this->tag->toArray(), $extra);
    }
}
