<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class LegalPageController extends Controller
{
    public function __invoke(string $type): View
    {
        $page = Page::query()
            ->with('seo')
            ->where('type', $type)
            ->firstOrFail();

        $page->content = strtr($page->content ?? '', [
            '[OPERATOR NAME] s.p.' => config('company.name'),
            '[OPERATOR NAME]' => config('company.name'),
            '[ADDRESS]' => config('company.address'),
            '[REGISTRATION NUMBER]' => config('company.registration_number'),
            '[VAT ID]' => config('company.vat_id'),
            '[EMAIL]' => config('mail.from.address'),
        ]);

        return view('pages.legal.show', [
            'page' => $page,
        ]);
    }
}
