<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('/c2c/community-all-posts')->with(['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post/create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'username' => 'required',
            'description' => 'required',
            'like' => 'required',
            'dislike' => 'required',
            'view' => 'required',
            'comment' => 'required',
            'star' => 'required',
            'picture' => 'required',
        ]);
        $username = $request->input('username');
        $description = $request->input('description'); 
        $like = $request->input('like'); 
        $dislike = $request->input('dislike'); 
        $view = $request->input('view'); 
        $comment = $request->input('comment'); 
        $star = $request->input('star'); 
        $picture = $request->file('picture'); 

        $post = new Post();

        $post->username = $username;
        $post->description = $description;
        $post->like = $like;
        $post->dislike = $dislike;
        $post->view = $view;
        $post->comment = $comment;
        $post->star = $star;

        $file_name = $picture->getClientOriginalName($picture);
        $file_path = $picture->move('storage/post',$file_name);
        $post->picture = $file_path;

        $post->save();

        return redirect('community-all-posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
