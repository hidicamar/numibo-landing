@props([
    'post'
])

<article {{ $attributes }} class="pt-6 lg:pt-2 pr-2 pb-2 lg:pl-16 pl-2 gap-10 lg:gap-20 flex flex-col lg:flex-row items-center justify-between overflow-hidden isolate rounded-2xl shadow-custom bg-white">
    <div class="flex flex-col items-start gap-5 lg:max-w-sm flex-1 px-5 pt-5 lg:p-0">
        <div class="flex flex-col gap-4">
            <time class="text-sm text-black/50" datetime="{{ $post->published_at->format('d.m.Y') }}">{{ $post->published_at->diffForHumans() }}</time>

            <h4 class="text-dark">{{ $post->title }}</h4>
            
            <p>{{ $post->summary }}</p>
        </div>

        <flux:button variant="primary" :href="route('posts.show', $post->slug)" icon:trailing="arrow-up-right">
            {{ __('Read more') }}
        </flux:button>
    </div>

    <img src="{{ $post->getFirstMediaUrl('post-cover') }}" alt="{{ $post->title }}" class="rounded-xl object-cover object-center h-48 lg:h-96 lg:max-w-md w-full">
</article>