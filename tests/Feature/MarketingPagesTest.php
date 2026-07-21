<?php

use Database\Seeders\PageSeeder;

beforeEach(fn () => $this->seed(PageSeeder::class));

/*
 * Only the default locale (en) is reachable over HTTP in the test kernel — the
 * LaravelLocalization prefix routes for non-default locales are not registered
 * there. These tests smoke the full request → render stack in the default locale.
 */
it('renders the home page with localized copy', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('home.hero.title_lead'))
        ->assertSee(__('home.hero.subtitle'));
});

it('renders the pricing page', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee(__('pricing.hero.title'));
});

it('renders the blog index', function () {
    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee(__('posts.index.title'));
});

it('links the footer to pricing, blog, and legal pages', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(route('pricing'))
        ->assertSee(route('posts.index'))
        ->assertSee(route('legal.privacy-policy'));
});

it('points the header CTAs at the app domain', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(config('app.app_url').'/login')
        ->assertSee(config('app.app_url').'/register');
});
