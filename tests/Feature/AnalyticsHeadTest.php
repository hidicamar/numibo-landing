<?php

use Database\Seeders\PageSeeder;
use Illuminate\Support\Arr;

beforeEach(fn () => $this->seed(PageSeeder::class));

it('renders no analytics or consent banner outside production', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('googletagmanager.com')
        ->assertDontSee('name="analytics-id"', false)
        ->assertDontSee('x-data="cookieConsent"', false)
        ->assertDontSee(__('cookies.settings'));
});

it('denies consent by default and never requests gtag.js from the served page in production', function () {
    $this->app->detectEnvironment(fn () => 'production');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<meta name="analytics-id" content="G-', false)
        ->assertSee("gtag('consent', 'default'", false)
        ->assertSee("analytics_storage: 'denied'", false)
        ->assertDontSee('googletagmanager.com')
        ->assertDontSee("gtag('config'", false)
        ->assertDontSee('cdn-cookieyes.com');
});

it('renders the consent banner with reject and accept as sibling buttons in production', function () {
    $this->app->detectEnvironment(fn () => 'production');

    $response = $this->get(route('home'))
        ->assertOk()
        ->assertSee('x-data="cookieConsent"', false)
        ->assertSee(__('cookies.banner.title'))
        ->assertSee(__('cookies.banner.accept'))
        ->assertSee(__('cookies.banner.reject'))
        ->assertSee(__('cookies.settings'));

    preg_match_all('/<button[^>]*x-on:click="(accept|reject)"[^>]*>/', $response->getContent(), $buttons);

    expect($buttons[1])->toBe(['reject', 'accept'])
        ->and($buttons[0])->each->toContain('data-flux-button', 'h-10');
});

it('translates the consent banner in every locale', function (string $locale) {
    $translations = Arr::dot(require lang_path($locale.'/cookies.php'));

    expect(array_keys($translations))->toBe(array_keys(Arr::dot(require lang_path('en/cookies.php'))))
        ->and(array_filter($translations, 'filled'))->toHaveCount(count($translations));
})->with(['sl', 'en', 'hr', 'de', 'bs']);

it('names the first-party consent cookie in the seeded cookie policy', function () {
    $this->get(route('legal.cookies'))
        ->assertOk()
        ->assertSee('numibo_consent')
        ->assertDontSee('cookieyes', false);
});
