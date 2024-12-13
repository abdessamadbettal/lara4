<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return request()->wantsJson()
            ? PostResource::collection($posts)
            : Inertia::render('Post/Posts', ['posts' => PostResource::collection($posts)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());

        return $request->wantsJson()
            ? new PostResource($post)
            : redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return request()->wantsJson()
            ? new PostResource($post)
            : Inertia::render('Post/Post', ['post' => new PostResource($post)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // update the post
        $post->update($request->all());

        return $request->wantsJson()
            ? new PostResource($post)
            : redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return request()->wantsJson()
            ? response()->noContent()
            : redirect()->route('posts.index');
    }
}
