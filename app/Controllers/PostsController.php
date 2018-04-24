<?php

namespace App\Controllers;

use Notification;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Authorizable;
use App\Models\PostTags;
use Illuminate\Http\Request;
use App\DataTables\PostsDataTable;
use App\Models\UserSubscribedTags;
use App\Http\Requests\PostsRequest;
use App\Notifications\NewPostAdded;
use App\Events\SendNotificationsForSubscripers;

class PostsController extends Controller
{

    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('backend.posts.index', [
            'title' => trans('main.show-all') . ' ' . trans('main.posts')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create', [
            'title' => trans('main.add') . ' ' . trans('main.posts'),
            'tags'  => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = UploadImages('posts', $request->file('image'));
        $post->slug = $request->slug;
        $post->later_publish = $request->later_publish;
        if ($request->later_publish == 'yes') {
            $post->publish_date = $request->publish_date;
            $post->publish_time = $request->publish_time;
            $post->status = 'pending';
        } else {
            if (userCan('Change Posts Status')) {
                $post->status = $request->status;
            } else {
                $post->status = 'pending';
            }
        }
        $post->user_id = auth()->user()->id;
        $post->save();
        
        foreach ($request->tags as $t) {
            if ($tag = Tag::find($t)) {
                $post_tag = new PostTags;
                $post_tag->post_id = $post->id;
                $post_tag->tag_id = $t;
                $post_tag->save();

                event(new SendNotificationsForSubscripers($tag, $post->slug));
            }
        }

        // if ($post->status == 'approved') {
        //     $ids = UserSubscribedTags::whereIn('tag_id', $request->tags)->get()->pluck('user_id')->toArray();
        //
        //     foreach (User::findMany($ids) as $user) {
        //         Notification::send($user, new NewPostAdded($post));
        //     }
        // }


        session()->flash('success', trans('main.added-message'));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.posts.show', [
            'title' => trans('main.show') .' ' . trans('main.post') . ' : ' . $post->title,
            'show'  => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.posts.edit', [
            'title' => trans('main.edit') .' ' . trans('main.post') . ' : ' . $post->name,
            'edit'  => $post,
            'tags'  => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->hasFile('image')) {
            if (file_exists(public_path('uploads/' . $post->image))) {
                @unlink(public_path('uploads/' . $post->image));
            }
            $post->image = UploadImages('posts', $request->file('image'));
        }
        $post->slug = $request->slug;
        $post->later_publish = $request->later_publish;
        if ($request->later_publish == 'yes') {
            $post->publish_date = $request->publish_date;
            $post->publish_time = $request->publish_time;
            $post->status = 'pending';
        } else {
            if (userCan('Change Posts Status')) {
                $post->status = $request->status;
            }
        }
        $post->user_id = auth()->user()->id;
        $post->save();

        @$post->tags_table()->delete();

        foreach ($request->tags as $t) {
            if (Tag::find($t)) {
                $post_tag = new PostTags;
                $post_tag->post_id = $post->id;
                $post_tag->tag_id = $t;
                $post_tag->save();
            }
        }

        // if ($post->status == 'approved') {
        //     $ids = UserSubscribedTags::whereIn('tag_id', $request->tags)->get()->pluck('user_id')->toArray();
        //
        //     foreach (User::findMany($ids) as $user) {
        //         Notification::send($user, new NewPostAdded($post));
        //     }
        // }

        session()->flash('success', trans('main.updated'));
        return redirect()->route('posts.show', [$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $redirect = true)
    {
        $post = Post::findOrFail($id);
        if (file_exists(public_path('uploads/' . $post->image))) {
            @unlink(public_path('uploads/' . $post->image));
        }
        $post->delete();
        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('posts.index');
        }
    }


    /**
     * Remove the multible resource from storage.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));
            return redirect()->route('posts.index');
        }
    }

}
