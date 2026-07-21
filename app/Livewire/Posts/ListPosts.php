<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ListPosts extends Component
{
    private const int PER_PAGE = 6;

    public int $page = 1;

    #[Url]
    public ?string $category = null;

    public function loadMore(): void
    {
        $this->page++;
    }

    public function filterBy(?string $categorySlug): void
    {
        $this->category = $categorySlug;
        $this->page = 1;
    }

    /**
     * Ordered by published_at with id as tie-breaker: rows sharing the same
     * timestamp would otherwise shift between the take() windows of
     * consecutive loadMore requests, duplicating or skipping posts.
     */
    #[Computed]
    public function posts(): Collection
    {
        return $this->query()
            ->with('category')
            ->latest('published_at')
            ->latest('id')
            ->take($this->page * self::PER_PAGE)
            ->get();
    }

    #[Computed]
    public function hasMorePosts(): bool
    {
        return $this->query()->count() > $this->posts->count();
    }

    #[Computed]
    public function categories(): Collection
    {
        return PostCategory::query()
            ->whereHas('posts', fn (Builder $query) => $query->published())
            ->orderBy('name')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.posts.list-posts');
    }

    private function query(): Builder
    {
        return Post::query()
            ->published()
            ->when($this->category, fn (Builder $query) => $query->whereHas(
                'category',
                fn (Builder $categoryQuery) => $categoryQuery->where('slug', $this->category),
            ));
    }
}
