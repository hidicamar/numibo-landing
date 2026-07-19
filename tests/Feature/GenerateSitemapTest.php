<?php

use App\Models\Post;

afterEach(function () {
    if (file_exists(public_path('sitemap.xml'))) {
        unlink(public_path('sitemap.xml'));
    }
});

it('writes a sitemap with the localized static pages and published posts', function () {
    $published = Post::factory()->create(['lang' => 'en', 'published_at' => now()->subDay()]);
    $unpublished = Post::factory()->unpublished()->create(['lang' => 'en']);

    $this->artisan('sitemap:generate')->assertSuccessful();

    $sitemap = file_get_contents(public_path('sitemap.xml'));

    expect($sitemap)
        ->toContain(route('home'))
        ->toContain(route('pricing'))
        ->toContain($published->slug)
        ->not->toContain($unpublished->slug);
});
