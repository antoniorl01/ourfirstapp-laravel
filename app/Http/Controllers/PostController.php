<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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

        Post::create($body);
    }

    public function viewSinglePost(Post $post)
    {
        # Laravel queries for us 
        return view('single-post', ['post' => $post]);
    }
}
