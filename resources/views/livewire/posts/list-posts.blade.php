<div class>
    @if ($this->categories->isNotEmpty())
        <div class="mb-10 flex flex-wrap items-center justify-center gap-2">
            <flux:badge as="button" size="lg" :color="$this->category === null ? 'blue' : 'zinc'" wire:click="filterBy(null)" class="cursor-pointer">
                {{ __('posts.index.all') }}
            </flux:badge>

            @foreach ($this->categories as $postCategory)
                <flux:badge as="button" size="lg" :color="$this->category === $postCategory->slug ? 'blue' : 'zinc'" wire:click="filterBy('{{ $postCategory->slug }}')" class="cursor-pointer" wire:key="category-{{ $postCategory->id }}">
                    {{ $postCategory->name }}
                </flux:badge>
            @endforeach
        </div>
    @endif

    @if ($this->posts->isEmpty())
        <p class="text-center text-lg text-dark/60">{{ __('posts.index.empty') }}</p>
    @else
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->posts as $post)
                <x-cards.post :post="$post" filterable wire:key="post-{{ $post->id }}" />
            @endforeach
        </div>

        @if ($this->hasMorePosts)
            <div wire:intersect="loadMore" class="mt-10 flex justify-center">
                <flux:icon.loading class="text-dark/40" />
            </div>
        @endif
    @endif
</div>
