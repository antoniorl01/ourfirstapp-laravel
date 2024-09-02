<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function showCreateForm()
    {
        return view('create-post');
    }

    public function storeNewPost(Request $request) 
    {
        $body = $request->validate([
            "title" => "required",
            "body" => "required"
        ]);

        $body["title"] = strip_tags($body["title"]);
        $body["body"] = strip_tags($body["body"]);
        $body["user_id"] = auth()->id(); // get the user id from the session

        $new_post = Post::create($body);
        return redirect("/post/{$new_post->id}")->with('success', 'New Post Created');
    }

    public function viewSinglePost(Post $post)
    {
        # Laravel queries for us directly
        $post['body'] = strip_tags(Str::markdown($post->body), '<p><ul><ol><il><strong><em><h3><br>');
        return view('single-post', ['post' => $post]);
    }
}
