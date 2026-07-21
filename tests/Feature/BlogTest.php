<?php

use App\Livewire\Posts\ListPosts;
use App\Models\Post;
use Livewire\Livewire;

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

it('shows six posts on the initial load', function () {
    Post::factory()->count(7)->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    // The blog card is an <article>; the first batch shows at most PER_PAGE posts.
    $content = $this->get(route('posts.index'))->assertOk()->getContent();

    expect(substr_count($content, '<article'))->toBe(6);
});

it('appends the next batch of posts on loadMore', function () {
    $posts = Post::factory()->count(7)->create(['lang' => app()->getLocale()])
        ->each(fn (Post $post, int $index) => $post->update(['published_at' => now()->subDays($index)]));

    Livewire::test(ListPosts::class)
        ->assertSee($posts[5]->title)
        ->assertDontSee($posts[6]->title)
        ->assertSee('wire:intersect', false)
        ->call('loadMore')
        ->assertSee($posts[6]->title);
});

it('hides the infinite scroll sentinel once all posts are shown', function () {
    Post::factory()->count(6)->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    Livewire::test(ListPosts::class)
        ->assertDontSee('wire:intersect');
});

it('filters posts by category', function () {
    $mathPost = Post::factory()->create(['lang' => app()->getLocale(), 'published_at' => now()]);
    $newsPost = Post::factory()->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    Livewire::test(ListPosts::class)
        ->call('filterBy', $mathPost->category->slug)
        ->assertSee($mathPost->title)
        ->assertDontSee($newsPost->title)
        ->call('filterBy', null)
        ->assertSee($mathPost->title)
        ->assertSee($newsPost->title);
});

it('resets infinite scroll when the category filter changes', function () {
    Post::factory()->count(7)->create(['lang' => app()->getLocale(), 'published_at' => now()]);

    Livewire::test(ListPosts::class)
        ->call('loadMore')
        ->assertSet('page', 2)
        ->call('filterBy', null)
        ->assertSet('page', 1);
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
