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

it('substitutes the operator identity tokens from config', function (string $routeName) {
    config()->set([
        'company.name' => 'Test Operator s.p.',
        'company.address' => 'Test Street 1, Test City 1000',
        'company.registration_number' => '1234567000',
        'company.vat_id' => '87654321',
        'mail.from.address' => 'legal@example.com',
    ]);

    $this->get(route($routeName))
        ->assertOk()
        ->assertSee('Test Operator s.p.')
        ->assertSee('Test Street 1, Test City 1000')
        ->assertSee('1234567000')
        ->assertSee('87654321')
        ->assertSee('<a href="mailto:legal@example.com">legal@example.com</a>', false)
        ->assertDontSee('Test Operator s.p. s.p.')
        ->assertDontSee('[OPERATOR NAME]')
        ->assertDontSee('[ADDRESS]')
        ->assertDontSee('[REGISTRATION NUMBER]')
        ->assertDontSee('[VAT ID]')
        ->assertDontSee('[EMAIL]');
})->with([
    'privacy policy' => ['legal.privacy-policy'],
    'terms and conditions' => ['legal.terms-and-conditions'],
]);

it('links the legal pages from the footer', function () {
    $this->get(route('legal.cookies'))
        ->assertOk()
        ->assertSee(route('legal.privacy-policy'))
        ->assertSee(route('legal.terms-and-conditions'));
});
