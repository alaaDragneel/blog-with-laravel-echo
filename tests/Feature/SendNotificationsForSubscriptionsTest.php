<?php

namespace Tests\Feature;

use Event;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Events\SendNotificationsForSubscripers;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendNotificationsForSubscriptionsTest extends TestCase
{
    use RefreshDatabase;

    
    /** @test */
    public function it_send_notifications_after_add_new_post_for_tag_subscriptions()
    {
        Event::fake();

        $this->signIn(factory('App\Models\User')->states('admin')->create());
            
        $post = create('App\Models\Post');
        $tag = create('App\Models\Tag');
        $post->slug = 'hay-slug'; // NOTE Error In Slug So We Hard Coded Here

        $this->post(route('posts.store'), $post->toArray() + ['tags' => $tag->toArray()]);

        Event::assertDispatched(SendNotificationsForSubscripers::class);

    }
}
