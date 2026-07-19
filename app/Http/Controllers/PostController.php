<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('pages.posts.index');
    }

    public function show(Post $post): View
    {
        abort_unless($post->published_at !== null && $post->published_at->isPast(), 404);

        return view('pages.posts.show', [
            'post' => $post->load('seo', 'category'),
        ]);
    }
}
