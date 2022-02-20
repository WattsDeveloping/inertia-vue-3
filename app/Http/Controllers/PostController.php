<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Summary of index
     * @return \Inertia\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return Inertia::render('Post/Index', ['posts' => $posts]);
    }

    /**
     * Summary of create
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Summary of store
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Post::create(
            Request::validate([
            'title' => ['required', 'max:90'],
            'description' => ['required'],
        ])
        );

        return Redirect::route('posts.index');
    }

    /**
     * Summary of show
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
    //
    }

    /**
     * Summary of edit
     * @param Post $post
     * @return \Inertia\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description
            ]
        ]);
    }

    /**
     * Summary of update
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $data = Request::validate([
            'title' => ['required', 'max:90'],
            'description' => ['required'],
        ]);
        $post->update($data);


        return Redirect::route('posts.index');
    }

    /**
     * Summary of destroy
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::route('posts.index');
    }
}