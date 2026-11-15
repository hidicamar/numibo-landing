<?php

use App\Models\Faq;
use App\Models\Post;
use Database\Seeders\PageSeeder;
use Illuminate\Support\Str;

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

it('shows every app screenshot in the hero phone', function () {
    $locale = app()->getLocale();

    $response = $this->get(route('home'))->assertOk();

    foreach (config('screenshots.slides') as $slide) {
        $response
            ->assertSee("img/usage/{$locale}/img-{$slide['image']}-mobile.png")
            ->assertSee(__("home.hero.screenshots.{$slide['key']}"));
    }
});

it('orders the screenshots along the user journey', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    $positions = collect(config('screenshots.slides'))
        ->map(fn (array $slide) => strpos($html, "img-{$slide['image']}-mobile.png"));

    expect($positions->first())->not->toBeFalse()
        ->and($positions->all())->toBe($positions->sort()->values()->all());
});

it('eagerly loads only the first screenshot', function () {
    $slides = config('screenshots.slides');
    $html = $this->get(route('home'))->assertOk()->getContent();

    $carousel = Str::between($html, 'data-screenshots', 'swiper-pagination');

    expect(substr_count($carousel, 'loading="eager"'))->toBe(1)
        ->and(substr_count($carousel, 'fetchpriority="high"'))->toBe(1)
        ->and(substr_count($carousel, 'loading="lazy"'))->toBe(count($slides) - 1);
});

it('has screenshot copy in every supported locale', function () {
    foreach (['en', 'sl', 'de', 'hr', 'bs'] as $locale) {
        $copy = require lang_path($locale.'/home.php');

        expect($copy['hero']['screenshots_label'] ?? null)->toBeString();

        foreach (config('screenshots.slides') as $slide) {
            expect($copy['hero']['screenshots'][$slide['key']] ?? null)->toBeString();
        }
    }
});

it('has a mobile screenshot file for every slide and locale', function () {
    foreach (['en', 'sl', 'de', 'hr', 'bs'] as $locale) {
        foreach (config('screenshots.slides') as $slide) {
            expect(public_path("img/usage/{$locale}/img-{$slide['image']}-mobile.png"))->toBeFile();
        }
    }
});

it('shows the first slide caption under the hero phone', function () {
    $slide = config('screenshots.slides')[0];
    $html = $this->get(route('home'))->assertOk()->getContent();

    expect(Str::between($html, 'data-screenshot-caption', '</p>'))
        ->toContain(__("home.hero.screenshots.{$slide['key']}"));
});

it('pairs every how-it-works step with its visual', function () {
    $locale = app()->getLocale();
    $steps = config('screenshots.steps');

    $response = $this->get(route('home'))->assertOk();

    expect($steps)->toHaveCount(count(__('home.steps.items')));

    foreach ($steps as $index => $visual) {
        $response->assertSee(__("home.steps.items.{$index}.image_alt"));

        foreach ($visual['images'] as $image) {
            $response->assertSee("img/usage/{$locale}/img-{$image}-{$visual['type']}.png");
        }
    }
});

it('has a step visual file and alt text for every step and locale', function () {
    foreach (['en', 'sl', 'de', 'hr', 'bs'] as $locale) {
        $copy = require lang_path($locale.'/home.php');

        foreach (config('screenshots.steps') as $index => $visual) {
            expect($copy['steps']['items'][$index]['image_alt'] ?? null)->toBeString();

            foreach ($visual['images'] as $image) {
                expect(public_path("img/usage/{$locale}/img-{$image}-{$visual['type']}.png"))->toBeFile();
            }
        }
    }
});

it('builds the case before pricing and keeps blog and newsletter below the final CTA', function () {
    Faq::factory()->create(['lang' => app()->getLocale()]);
    Post::factory()->create(['lang' => app()->getLocale()]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSeeInOrder([
            __('home.steps.title'),
            __('home.features.title'),
            __('home.pricing.title'),
            __('home.faq.title'),
            __('home.cta.title'),
            __('home.blog.title'),
            __('home.newsletter.title'),
        ]);
});

it('sends both secondary CTAs to the pricing section', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    expect(substr_count($html, 'href="#pricing"'))->toBe(2);
});

it('renders the shared FAQ list with the row padding on the heading button', function (string $routeName) {
    $faq = Faq::factory()->create(['lang' => app()->getLocale()]);

    $html = $this->get(route($routeName))
        ->assertOk()
        ->assertSee($faq->question)
        ->assertSee($faq->answer, false)
        ->getContent();

    expect($html)->toMatch('/<button[^>]*class="[^"]*\bpt-4 pb-2\b[^"]*"[^>]*data-flux-accordion-heading/');
})->with(['home', 'pricing']);

it('promises a card-free start in the final CTA only during early access', function () {
    config(['plans.early_access' => true]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('home.cta.subtitle'));

    config(['plans.early_access' => false]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee(__('pricing.cta.subtitle'))
        ->assertDontSee(__('home.cta.subtitle'));
});
