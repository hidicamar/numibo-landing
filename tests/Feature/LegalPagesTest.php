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

it('seeds a privacy policy that describes child profiles in every locale', function (string $lang, string $childProfilesItem, string $retiredNoProfilesClaim) {
    $content = Page::withoutGlobalScopes()
        ->where('lang', $lang)
        ->where('type', 'privacy-policy')
        ->value('content');

    // One item lists the data collected (section 2), the other how long it is kept (section 6).
    expect(substr_count($content, $childProfilesItem))->toBe(2)
        ->and($content)->not->toContain($retiredNoProfilesClaim);
})->with([
    'en' => ['en', '<li><strong>Child profiles:</strong>', 'does not create child profiles'],
    'sl' => ['sl', '<li><strong>Profili otrok:</strong>', 'ne ustvarja profilov otrok'],
    'de' => ['de', '<li><strong>Kinderprofile:</strong>', 'legt keine Kinderprofile an'],
    'hr' => ['hr', '<li><strong>Dječji profili:</strong>', 'ne kreira profile djece'],
    'bs' => ['bs', '<li><strong>Dječiji profili:</strong>', 'ne kreira profile djece'],
]);

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
