@props([
    'post',
    'filterable' => false,
])

<article {{ $attributes }} class="group relative isolate flex flex-col overflow-hidden rounded-2xl bg-white shadow-custom inset-ring-4 inset-ring-blue-50 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="aspect-3/2 w-full overflow-hidden">
        @if ($post->getFirstMediaUrl('post-cover'))
            <img src="{{ $post->getFirstMediaUrl('post-cover') }}" alt="{{ $post->title }}" class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-105">
        @else
            <div class="bg-radial-picton h-full w-full transition duration-500 group-hover:scale-105"></div>
        @endif
    </div>

    <div class="flex grow flex-col gap-4 p-6">
        <div class="flex items-center gap-3 text-sm">
            <time class="text-black/50" datetime="{{ $post->published_at->format('d.m.Y') }}">{{ $post->published_at->diffForHumans() }}</time>

            {{-- z-10 lifts the badge above the card's stretched link so it stays clickable --}}
            @if ($filterable)
                <flux:badge as="button" size="sm" color="blue" wire:click="filterBy('{{ $post->category->slug }}')" class="relative z-10 cursor-pointer">
                    {{ $post->category->name }}
                </flux:badge>
            @else
                <flux:badge size="sm" color="blue">{{ $post->category->name }}</flux:badge>
            @endif
        </div>

        <h5 class="text-dark transition group-hover:text-blue-600">
            <a href="{{ route('posts.show', $post->slug) }}">
                <span class="absolute inset-0"></span>

                {{ $post->title }}
            </a>
        </h5>

        <p class="line-clamp-3">{{ $post->summary }}</p>
    </div>
</article>
