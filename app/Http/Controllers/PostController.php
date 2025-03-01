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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $locale = app()->getLocale();
        $post = Post::where("slug->$locale", $slug)->first();

        if (!$post) {
            $languages = ['en', 'fr', 'es', 'ar'];
            foreach ($languages as $lang) {
                if ($lang !== $locale) {
                    $post = Post::where("slug->$lang", $slug)->first();
                    if ($post) {
                        return redirect()->route('posts.show', ['post' => $post->slug]);
                    }
                }
            }
        }

        if (!$post) {
            abort(404);
        }

        $post->increment('views_count');
        // with relatedposts
        $related_posts = Post::where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return request()->wantsJson()
            ? new PostResource($post)
            : Inertia::render('Post/Post', [
                'post' => new PostResource($post),
                'related_posts' => PostResource::collection($related_posts),
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {}
}
