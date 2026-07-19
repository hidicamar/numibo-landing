<div>
    @if ($this->posts->isEmpty())
        <p class="text-center text-lg text-dark/60">{{ __('posts.index.empty') }}</p>
    @else
        <div class="flex flex-col gap-6">
            @foreach ($this->posts as $post)
                <x-cards.post :post="$post" wire:key="post-{{ $post->id }}" />
            @endforeach
        </div>

        <flux:pagination :paginator="$this->posts" class="mt-10" />
    @endif
</div>
