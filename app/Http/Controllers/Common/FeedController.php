<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostHasComments;
use App\Models\PostHasLikes;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('common.feed.index', compact('posts'));
    }

    public function like(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $user = auth()->user();

        // Check if user has already liked the post
        $alreadyLiked = PostHasLikes::where('user_id',$user->id)->where('post_id',$post->id);

        if($alreadyLiked->exists()){
            $alreadyLiked = $alreadyLiked->first();
            $alreadyLiked->delete();

            return response()->json(['message' => 'You already liked this post',],400);
        }

        // Like the post
        PostHasLikes::create([
            'post_id' => $request->post_id,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Liked the post successfully',], 201);
    }

    public function comment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:post_has_comments,id',
        ]);

        $user = auth()->user();

        // Comment on the post
        $comment = PostHasComments::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => $user->id,
            'parent_id' => $request->parent_id,
        ]);

        $comments = PostHasComments::with(['user','replies.user'])->where('post_id',$request->post_id)->whereNull('parent_id')->get();
        return response()->json([
            'id' => $comment->id,
            'comments' => $comments,
        ], 201);
    }

    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Post::create([
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        return redirect()->route('common.feed')->with('success', 'Post created successfully!');
    }
}