<x-layouts.app :title="__('posts.index.title')">
    <x-slot:seo>
        <x-head.meta.dynamic
            :title="__('posts.index.title').' - '.config('app.name')"
            :description="__('posts.index.subtitle')"
        />
    </x-slot:seo>

    <section class="border-b border-blue-100 bg-radial-picton px-5 pt-40 pb-16 lg:px-8 lg:pt-48 lg:pb-20">
        <div class="mx-auto flex max-w-2xl flex-col items-center gap-4 text-center">
            <h1 class="text-3xl! text-dark md:text-5xl!">{{ __('posts.index.title') }}</h1>
            <p class="text-lg text-dark/70 md:text-xl">{{ __('posts.index.subtitle') }}</p>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-5 py-16 lg:px-8 lg:py-20">
        <livewire:posts.list-posts />
    </div>
</x-layouts.app>
