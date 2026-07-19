<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class LegalPageController extends Controller
{
    /**
     * Show an admin-managed legal page. The type comes from the route defaults;
     * the current locale's row is selected by the Page model's language scope.
     */
    public function __invoke(string $type): View
    {
        $page = Page::query()
            ->with('seo')
            ->where('type', $type)
            ->firstOrFail();

        return view('pages.legal.show', [
            'page' => $page,
        ]);
    }
}
