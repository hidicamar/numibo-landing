<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ListPosts extends Component
{
    use WithPagination;

    #[Computed]
    public function posts(): LengthAwarePaginator
    {
        return Post::query()
            ->published()
            ->with('category')
            ->latest('published_at')
            ->paginate(5);
    }

    public function render(): View
    {
        return view('livewire.posts.list-posts');
    }
}
