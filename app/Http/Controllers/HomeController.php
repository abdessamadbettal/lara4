<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $posts = Post::whereNotNull("name->$locale")
        ->whereNotNull("slug->$locale")->latest()->take(3)->get();
        return Inertia::render('Welcome', [
            'posts' => PostResource::collection($posts),    
        ]);
    }
}
