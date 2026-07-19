<x-layouts.app :title="$post->title">
    <x-slot:seo>
        <x-head.meta.dynamic
            :title="$post->seoTitle"
            :description="$post->seoDescription"
            :image="$post->seo?->getFirstMediaUrl('seo-cover') ?: ($post->getFirstMediaUrl('post-cover') ?: asset('img/banners/seo.png'))"
        />
    </x-slot:seo>

    <article class="pt-34 pb-20 lg:pt-40 lg:pb-24">
        <div class="mx-auto max-w-3xl px-5 lg:px-8">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2" wire:navigate>
                <flux:icon.arrow-left variant="micro" class="text-blue-400" />
                <span class="text-sm font-semibold text-blue-400">{{ __('posts.article.back') }}</span>
            </a>

            <h1 class="mt-3 mb-4 text-3xl! text-dark md:text-4xl!">{{ $post->title }}</h1>

            @if ($post->summary)
                <p class="text-lg text-dark/70">{{ $post->summary }}</p>
            @endif

            <div class="mt-8 flex flex-col gap-1 text-sm text-dark/60">
                <p>{{ __('posts.article.published') }}: <span class="font-medium text-dark">{{ $post->published_at->diffForHumans() }}</span></p>
                <p>{{ __('posts.article.read_time') }}: <span class="font-medium text-dark">{{ $post->read_time }}</span> min / <span class="font-medium text-dark">{{ $post->word_count }}</span> {{ trans_choice('global.words', $post->word_count) }}</p>
            </div>
        </div>

        @if ($post->getFirstMediaUrl('post-cover'))
            <img src="{{ $post->getFirstMediaUrl('post-cover') }}" alt="{{ $post->title }}" class="mx-auto my-10 h-full max-h-[496px] w-full max-w-4xl object-cover object-center lg:rounded-2xl">
        @endif

        <div class="mx-auto max-w-3xl px-5 lg:px-8">
            <div class="rich-text-editor-content">
                {!! $post->content !!}
            </div>

            <div
                class="mt-10 border-t border-blue-100 pt-8"
                x-data="{
                    canShare: 'share' in navigator,
                    share() {
                        if (! this.canShare) {
                            return;
                        }

                        navigator.share({
                            title: @js($post->seoTitle),
                            text: @js($post->seoDescription),
                            url: @js(route('posts.show', $post->slug)),
                        }).catch(() => {});
                    },
                }"
                x-show="canShare"
                x-cloak
            >
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-dark">{{ __('posts.article.share') }}:</span>

                    <button type="button" x-on:click="share" class="flex size-10 items-center justify-center rounded-full border border-blue-100 text-dark transition hover:bg-blue-50" aria-label="{{ __('posts.article.share') }}">
                        <flux:icon.share variant="mini" class="text-dark" />
                    </button>
                </div>
            </div>
        </div>
    </article>
</x-layouts.app>
