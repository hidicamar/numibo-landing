<?php

use Database\Seeders\PageSeeder;

beforeEach(fn () => $this->seed(PageSeeder::class));

it('renders no analytics or consent scripts when the services are not configured', function () {
    config(['services.google.analytics_id' => null, 'services.cookieyes.id' => null]);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('googletagmanager.com')
        ->assertDontSee('cdn-cookieyes.com');
});

it('renders the gtag snippet with consent-mode defaults when configured', function () {
    config(['services.google.analytics_id' => 'G-TEST123']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('googletagmanager.com/gtag/js?id=G-TEST123', false)
        ->assertSee("gtag('consent', 'default'", false);
});

it('renders the CookieYes script when configured', function () {
    config(['services.cookieyes.id' => 'abc123']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('cdn-cookieyes.com/client_data/abc123/script.js', false);
});
