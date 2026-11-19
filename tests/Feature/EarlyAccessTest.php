<?php

use App\Models\Faq;
use Database\Seeders\FaqSeeder;
use Database\Seeders\PageSeeder;

beforeEach(function () {
    $this->seed(PageSeeder::class);

    config(['plans.early_access' => true]);
});

it('replaces the home pricing teaser with the early-access section', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('pricing.early_access.title'))
        ->assertSee(__('pricing.early_access.later'))
        ->assertSee(__('pricing.early_access.microcopy'))
        ->assertSee(__('actions.see_included'))
        ->assertSee('id="pricing"', false)
        ->assertDontSee(__('home.pricing.title'))
        ->assertDontSee(__('actions.see_pricing'))
        ->assertDontSee(__('pricing.cta_microcopy', ['days' => config('plans.trial_days')]));
});

it('replaces the plans and comparison on the pricing page', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee(__('pricing.hero.title'))
        ->assertSee(__('pricing.early_access.hero_subtitle'))
        ->assertSee(__('pricing.early_access.title'))
        ->assertSee(__('pricing.early_access.cta_subtitle'))
        ->assertDontSee(__('pricing.comparison.title'))
        ->assertDontSee(__('actions.start_free_trial'))
        ->assertDontSee(__('billing.pricing.monthly'))
        ->assertDontSee(__('billing.pricing.trial_notice', [
            'days' => config('plans.trial_days'),
            'count' => config('plans.trial_exercises'),
        ]));
});

it('hides every price and plan checkout link', function (string $routeName) {
    $response = $this->get(route($routeName))->assertOk();

    foreach (config('plans.plans') as $plan) {
        foreach ($plan['prices'] as $amount) {
            $response->assertDontSee(money($amount, config('plans.currency'))->format(app()->getLocale()));
        }
    }

    $response
        ->assertDontSee('/register?plan=', false)
        ->assertSee(config('app.app_url').'/register');
})->with(['home', 'pricing']);

it('lists every included feature', function (string $routeName) {
    $response = $this->get(route($routeName))
        ->assertOk()
        ->assertSee(__('pricing.early_access.subtitle'));

    foreach (__('pricing.early_access.features') as $feature) {
        $response->assertSee($feature);
    }
})->with(['home', 'pricing']);

it('does not promise unlimited generation while a fair-use cap applies', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertDontSee(__('pricing.comparison.rows.unlimited'));
});

it('keeps the paid pricing when early access is off', function () {
    config(['plans.early_access' => false]);

    $firstPrice = collect(config('plans.plans'))->first()['prices']['monthly'];

    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee(__('actions.start_free_trial'))
        ->assertSee(money($firstPrice, config('plans.currency'))->format(app()->getLocale()))
        ->assertDontSee(__('pricing.early_access.title'));

    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('home.pricing.title'))
        ->assertDontSee(__('pricing.early_access.title'));
});

it('has early-access copy in every supported locale', function () {
    $english = require lang_path('en/pricing.php');

    foreach (['en', 'sl', 'de', 'hr', 'bs'] as $locale) {
        $copy = require lang_path($locale.'/pricing.php');
        $actions = require lang_path($locale.'/actions.php');

        expect(array_keys($copy['early_access']))->toBe(array_keys($english['early_access']))
            ->and($copy['early_access']['features'])->toHaveCount(count($english['early_access']['features']))
            ->and($actions['see_included'] ?? null)->toBeString();
    }
});

it('seeds an FAQ that matches early access in every locale', function (string $routeName) {
    $this->seed(FaqSeeder::class);

    foreach (['en', 'sl', 'de', 'hr', 'bs'] as $locale) {
        $faqs = Faq::withoutGlobalScopes()->where('lang', $locale)->get();

        expect($faqs->where('is_visible', true))->toHaveCount(8)
            ->and($faqs->where('is_visible', false))->toHaveCount(2)
            ->and($faqs->where('is_visible', true)->pluck('answer')->implode(' '))
            ->not->toContain((string) config('plans.trial_days').'-');
    }

    $response = $this->get(route($routeName))->assertOk();

    Faq::query()->visible()->get()->each(fn (Faq $faq) => $response->assertSee($faq->question));
    Faq::query()->hidden()->get()->each(fn (Faq $faq) => $response->assertDontSee($faq->question));
})->with(['home', 'pricing']);
