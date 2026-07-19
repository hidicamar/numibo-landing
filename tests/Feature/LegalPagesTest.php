<?php

use App\Models\Page;
use Database\Seeders\PageSeeder;

beforeEach(fn () => $this->seed(PageSeeder::class));

it('shows each legal page to guests', function (string $routeName, string $type) {
    $name = Page::withoutGlobalScopes()
        ->where('lang', app()->getLocale())
        ->where('type', $type)
        ->value('name');

    $this->get(route($routeName))
        ->assertOk()
        ->assertSee($name);
})->with([
    'privacy policy' => ['legal.privacy-policy', 'privacy-policy'],
    'terms and conditions' => ['legal.terms-and-conditions', 'terms-and-conditions'],
    'cookies' => ['legal.cookies', 'cookies'],
]);

it('renders the seeded legal content to guests', function () {
    $this->get(route('legal.privacy-policy'))
        ->assertOk()
        ->assertSee('Data controller')
        ->assertSee('Brevo');
});

it('renders the admin-managed page content as HTML', function () {
    Page::withoutGlobalScopes()
        ->where('lang', app()->getLocale())
        ->where('type', 'privacy-policy')
        ->update(['content' => '<h2>Data controller test</h2><p>Test paragraph.</p>']);

    $this->get(route('legal.privacy-policy'))
        ->assertOk()
        ->assertSee('<h2>Data controller test</h2>', false)
        ->assertSee('Test paragraph.');
});

it('links the legal pages from the footer', function () {
    $this->get(route('legal.cookies'))
        ->assertOk()
        ->assertSee(route('legal.privacy-policy'))
        ->assertSee(route('legal.terms-and-conditions'));
});
