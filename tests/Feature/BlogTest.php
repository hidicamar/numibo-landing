<?php

use App\Models\Post;

it('shows the empty state when there are no posts', function () {
    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee(__('posts.index.empty'));
});

it('lists published posts on the blog index', function () {
    $post = Post::factory()->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee($post->title);
});

it('hides unpublished posts from the index', function () {
    $post = Post::factory()->unpublished()->create(['lang' => app()->getLocale()]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertDontSee($post->title);
});

it('paginates the index at five posts per page', function () {
    Post::factory()->count(6)->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    // The blog card is an <article>; page one shows at most the paginate() limit.
    $content = $this->get(route('posts.index'))->assertOk()->getContent();

    expect(substr_count($content, '<article'))->toBe(5);
});

it('renders a published article with a back link', function () {
    $post = Post::factory()->create(['lang' => app()->getLocale(), 'published_at' => now()->subDay()]);

    $this->get(route('posts.show', $post->slug))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee(__('posts.article.back'))
        ->assertSee(route('posts.index'));
});

it('returns 404 for an unpublished article', function () {
    $post = Post::factory()->unpublished()->create(['lang' => app()->getLocale()]);

    $this->get(route('posts.show', $post->slug))->assertNotFound();
});
