<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class PricingController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.pricing', [
            'plans' => config('plans.plans'),
            'frequentlyAskedQuestions' => Faq::query()->visible()->get(),
        ]);
    }
}
