<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = \App\Models\Post::all();
        return view('posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = \App\Models\Post::all();
        $showForm = true;
        return view('posts', compact('posts', 'showForm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        \App\Models\Post::create($request->only('title', 'content'));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Post $post)
    {
        $posts = \App\Models\Post::all();
        $showPost = true;
        return view('posts', compact('posts', 'post', 'showPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Post $post)
    {
        $posts = \App\Models\Post::all();
        $showForm = true;
        $edit = true;
        return view('posts', compact('posts', 'post', 'showForm', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post->update($request->only('title', 'content'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
