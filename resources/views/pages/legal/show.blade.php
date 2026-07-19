<x-layouts.app :title="$page->seo->title ?? $page->name">
    <section class="px-5 pt-34 pb-20 lg:pt-40 lg:pb-24">
        <div class="mx-auto w-full max-w-2xl space-y-6">
            <flux:heading size="xl" level="1">{{ $page->name }}</flux:heading>

            @if (filled($page->content))
                <div class="rich-text-editor-content">
                    {!! $page->content !!}
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
