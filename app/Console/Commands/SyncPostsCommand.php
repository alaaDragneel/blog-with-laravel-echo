<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class SyncPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishs The Posts Were Pending';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::where('status', 'pending')->where('later_publish', 'yes')->where('publish_date', date('Y-m-d'))->get();
        foreach ($posts as $post) {
            if (Carbon::createFromTimestamp(strtotime($post->publish_time))->format('Y-m-d H:i') == date('Y-m-d H:i')) {
                $post->later_publish = 'no';
                $post->status = 'approved';
                $post->save();
                // $ids = UserSubscribedTags::whereIn('tag_id', $request->tags)->get()->pluck('user_id')->toArray();
                //
                // foreach (User::findMany($ids) as $user) {
                //     Notification::send($user, new NewPostAdded($post));
                // }
            }
        }
    }
}
