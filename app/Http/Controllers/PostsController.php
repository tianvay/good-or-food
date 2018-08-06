<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index','show'])
        ;
    }

    public function index()
    {

        $posts = Post::latest()
            ->where('published', 1)
            ->where('deleted', 0)
            ->filter(request(['month', 'year']))
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function review()
    {

        $posts = Post::latest()
            ->where('published', '=', false)
            ->filter(request(['month', 'year']))
            ->get();

        return view('posts.review', compact('posts'));
    }


    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    public function create()
    {

        return view('posts.create');
    }

    public function store()
    {

        $this->validate(request(), [
            'title' => 'required|min:5',
            'body' => 'required|min:5',
        ]);

        if(auth()->user()->is_admin){
            Post::create([
                'title' => request('title'),
                'body' => request('body'),
                'user_id' => auth()->user()->id
            ]);
        }

        return redirect('/');
    }

    public function publish(Post $post)
    {
        $post->published = true;
        $post->save();

        return redirect('/');
    }

    public function delete(Post $post)
    {
        $post->deleted = true;
        $post->save();

        return redirect('/');
    }
}
