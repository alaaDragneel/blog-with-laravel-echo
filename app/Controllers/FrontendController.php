<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\SavedPosts;
use App\Models\Comment;
use App\Models\Like;
use App\Models\UserSubscribedTags;
use Share;
class FrontendController extends Controller
{



    public function index()
    {
        $posts = Post::where('status', 'approved')->get();
        return view('frontend.home', [
            'title' => 'All Posts',
            'posts' => $posts
        ]);
    }

    public function tags($id)
    {
        $posts = Post::where('status', 'approved')->whereHas('tags', function ($q) use($id) {
            return $q->where('tags.id', $id);
        })->get();

        if (auth()->check()) {
            if (in_array($id, auth()->user()->subscribed_tags_table->pluck('tag_id')->toArray())) {
                $link = '  <a href="' . url('/subscribe/tag/' . Tag::find($id)->id) . '">UnSubscribe This Tag</a>';
            } else {
                $link = '  <a href="' . url('/subscribe/tag/' . Tag::find($id)->id) . '">Subscribe This Tag</a>';
            }
        } else {
            $link = '';
        }
        return view('frontend.home', [
            'title' => 'Posts Has Tag: ' . Tag::find($id)->name . $link,
            'posts' => $posts
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $posts = Post::where('status', 'approved')->where('title', 'LIKE', '%'.$keyword.'%')->orWhereHas('tags', function ($q) use($keyword) {
            return $q->where('tags.name', 'LIKE', '%'.$keyword.'%');
        })->get();

        return response()->json([
            'posts' => $posts,
        ], 200);

    }

    public function single($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.single', [
            'post' => $post
        ]);
    }


    public function savePost($post_id)
    {
        $saved_posts = SavedPosts::where('user_id', auth()->user()->id)->where('post_id', $post_id)->get();
        if (count($saved_posts->toArray()) == 0) {
            $sp = new SavedPosts;
            $sp->post_id = $post_id;
            $sp->user_id = auth()->user()->id;
            $sp->save();
        } else {
            foreach ($saved_posts as $p) {
                $p->delete();
            }
        }
        return redirect()->back();
    }

    public function likePost($post_id)
    {
        $likes = Like::where('user_id', auth()->user()->id)->where('post_id', $post_id)->get();
        if (count($likes->toArray()) == 0) {
            $like = new Like;
            $like->post_id = $post_id;
            $like->user_id = auth()->user()->id;
            $like->save();
        } else {
            foreach ($likes as $p) {
                $p->delete();
            }
        }

        return redirect()->back();
    }

    public function AddComment(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return response()->json([
            'comment' => Comment::find($comment->id),
        ], 200);
    }

    public function DeleteComment(Request $request)
    {
        Comment::find($request->id)->delete();
        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function clogout()
    {
        auth()->logout();
        return redirect()->back();
    }

    public function savedPosts()
    {
        $posts = Post::where('status', 'approved')->whereIn('id', auth()->user()->saved_posts->pluck('id')->toArray())->get();
        return view('frontend.home', [
            'title' => 'Saved Posts',
            'posts' => $posts
        ]);
    }

    public function subscribe($tag_id)
    {
        if (!Tag::find($tag_id)) {
            abort(404);
        }
        $s_tags = UserSubscribedTags::where('user_id', auth()->user()->id)->where('tag_id', $tag_id)->get();
        if (count($s_tags->toArray()) == 0) {
            $ust = new UserSubscribedTags;
            $ust->user_id = auth()->user()->id;
            $ust->tag_id = $tag_id;
            $ust->save();
        } else {
            foreach ($s_tags as $p) {
                $p->delete();
            }
        }
        return redirect()->back();
    }

}
