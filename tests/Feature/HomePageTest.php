<?php

use App\Models\Faq;
use App\Models\Post;
use Database\Seeders\PageSeeder;

beforeEach(fn () => $this->seed(PageSeeder::class));

it('shows the hero, pricing teaser, and a CTA to register on the app', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('home.hero.title_lead'))
        ->assertSee(__('actions.start_free'))
        ->assertSee(config('app.app_url').'/register')
        ->assertSee(route('pricing'))
        ->assertSee(__('billing.plans.starter.name'))
        ->assertSee(__('billing.plans.premium.name'));
});

it('lists the latest published posts and visible FAQs', function () {
    $post = Post::factory()->create(['lang' => app()->getLocale(), 'published_at' => now()]);
    $faq = Faq::factory()->create(['lang' => app()->getLocale()]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee($faq->question);
});

it('hides invisible FAQs', function () {
    $faq = Faq::factory()->hidden()->create(['lang' => app()->getLocale()]);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee($faq->question);
});
