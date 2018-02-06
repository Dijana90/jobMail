<?php

namespace App\Http\Controllers;

use App\Mail\FirstJobPost;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::where('confirmed', true)->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show()
    {
        return view('posts.show');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //Validate submission
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'email' => 'required|email'
        ]);

        //Fill request data into new Post
        $post = new Post;
        $post->fill(request()->only(['title', 'description', 'email']));
        //Fill user who submitted job offer
        $post->user_id = Auth::user()->id;

        //If user already have approved posts then save & redirect to /
        if (Post::where('user_id', Auth::user()->id)->where('confirmed', true)->count() > 0) {
            $post->confirmed = true;
            $post->save();
            return redirect('/');
        } else {
            //else set post for moderation, send email to moderator, show message to user
            $post->confirmed = false;
            $post->save();
            Mail::to('pantic.dijana@gmail.com')->send(new FirstJobPost($post));
            return view('posts.wait_moderation');
        }
    }

    public function approve($post_id)
    {
        $post = Post::findOrFail($post_id);

        $post->confirmed=true;
        $post->save();
        return view('posts.approve');
    }

    public function spam($post_id)
    {
        $post = Post::findOrFail($post_id);

        $post->delete();
        return view('posts.spam');
    }
}
