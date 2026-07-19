<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'page' => Page::query()->with('seo')->where('type', 'home')->first(),
            'posts' => Post::query()->published()->latest('published_at')->limit(3)->get(),
            'plans' => config('plans.plans'),
            'frequentlyAskedQuestions' => Faq::query()->visible()->get(),
        ]);
    }
}
