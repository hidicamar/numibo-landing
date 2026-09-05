@php
    $primaryCtaHref = config('app.app_url').'/register';
    $maxYearlySavings = collect($plans)
        ->map(fn (array $plan) => (int) round((1 - $plan['prices']['yearly'] / ($plan['prices']['monthly'] * 12)) * 100))
        ->max();
@endphp

<x-layouts.app :title="__('titles.home')">
    <x-slot:seo>
        <x-head.meta.dynamic
            :title="$page->seo->title"
            :suffix="false"
            :description="$page->seo->description"
            :image="$page->seo->getFirstMediaUrl('seo-cover') ?: asset('img/banners/seo.png')"
        />
    </x-slot:seo>

    {{-- Hero --}}
    <section class="overflow-hidden border-b border-blue-100 bg-radial-picton px-5 pt-36 pb-16 lg:px-8 lg:pt-44 lg:pb-24">
        <div class="mx-auto grid max-w-5xl items-center gap-12 lg:grid-cols-12 lg:gap-8">
            <div class="flex flex-col items-center gap-8 text-center lg:col-span-7 lg:items-start lg:text-left">
                <x-reveal class="flex flex-col gap-5">
                    <h1 class="text-3xl! leading-[1.15]! text-dark md:text-5xl!">
                        {{ __('home.hero.title_lead') }}

                        <span class="relative inline-block whitespace-nowrap">
                            <svg aria-hidden="true" viewBox="0 0 418 42" class="reveal-swoosh absolute bottom-0 left-0 h-[0.4em] w-full fill-blue-200" preserveAspectRatio="none">
                                <path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path>
                            </svg>

                            <span class="text-shimmer relative">{{ __('home.hero.title_highlight') }}</span>
                        </span>

                        {{ __('home.hero.title_trail') }}
                    </h1>

                    <p class="max-w-xl text-lg text-dark/70 md:text-xl">
                        {{ __('home.hero.subtitle') }}
                    </p>
                </x-reveal>

                <x-reveal :delay="150" class="flex w-full flex-col items-center gap-3">
                    <div class="flex w-full flex-col items-center justify-center gap-3 sm:flex-row lg:justify-start">
                        <flux:button :href="$primaryCtaHref" variant="primary" class="w-full sm:w-auto" icon:trailing="arrow-up-right">
                            {{ __('actions.start_free') }}
                        </flux:button>

                        <flux:button href="#pricing" variant="ghost" class="w-full sm:w-auto">
                            {{ __('actions.see_pricing') }}
                        </flux:button>
                    </div>

                    <p class="text-sm text-dark/60 lg:self-start">
                        {{ __('pricing.cta_microcopy', ['days' => config('plans.trial_days')]) }}
                    </p>
                </x-reveal>
            </div>

            <x-reveal :delay="250" class="relative lg:col-span-5">
                <div aria-hidden="true" class="absolute inset-x-6 top-1/2 -z-10 aspect-square -translate-y-1/2 rounded-full bg-blue-300/40 blur-3xl"></div>

                <x-screenshots.phone />
            </x-reveal>
        </div>
    </section>

    {{-- How it works --}}
    <section class="px-5 py-20 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-5xl">
            <x-reveal class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.steps.eyebrow') }}</span>
                <h2 class="text-dark">{{ __('home.steps.title') }}</h2>
            </x-reveal>

            <div class="mt-14 grid gap-6 md:grid-cols-3">
                @foreach (['cursor-arrow-rays', 'adjustments-horizontal', 'printer'] as $index => $icon)
                    <x-reveal wire:key="step-{{ $index }}" :delay="$index * 120" class="flex flex-col gap-4 rounded-2xl bg-white p-8 shadow-custom inset-ring-4 inset-ring-blue-50">
                        <div class="flex items-center gap-3">
                            <span class="flex size-9 items-center justify-center rounded-full bg-blue-500 text-sm font-semibold text-white">{{ $index + 1 }}</span>
                            <flux:icon :name="$icon" class="size-6 text-blue-500" />
                        </div>
                        <h6 class="text-dark">{{ __('home.steps.items.'.$index.'.title') }}</h6>
                        <p class="text-sm text-dark/70">{{ __('home.steps.items.'.$index.'.description') }}</p>
                    </x-reveal>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing --}}
    <section id="pricing" class="scroll-mt-28 bg-radial-picton-2 px-5 py-20 lg:px-8 lg:py-28" x-data="{ period: 'monthly' }">
        <div class="mx-auto max-w-5xl">
            <x-reveal class="mx-auto flex max-w-2xl flex-col gap-4 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.pricing.eyebrow') }}</span>

                <h2 class="text-dark">{{ __('home.pricing.title') }}</h2>

                <p class="text-lg text-dark/70">{{ __('home.pricing.subtitle') }}</p>

                <div class="mt-2 flex justify-center">
                    <x-pricing.toggle :savings="$maxYearlySavings" />
                </div>
            </x-reveal>

            <div class="mx-auto mt-12 grid max-w-3xl gap-6 md:grid-cols-2">
                @foreach ($plans as $plan)
                    <x-reveal wire:key="teaser-{{ $plan['slug'] }}" :delay="$loop->index * 120">
                        <x-pricing.plan-card :plan="$plan" />
                    </x-reveal>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <flux:button :href="route('pricing')" variant="ghost" icon:trailing="arrow-up-right" wire:navigate>
                    {{ __('home.pricing.cta') }}
                </flux:button>
            </div>
        </div>
    </section>

    {{-- Why it works --}}
    <section class="px-5 py-20 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-5xl">
            <x-reveal class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.features.eyebrow') }}</span>
                <h2 class="text-dark">{{ __('home.features.title') }}</h2>
            </x-reveal>

            <div class="mt-14 grid gap-5 md:grid-cols-3">
                @foreach (['feedback' => 'check-badge', 'answer_key' => 'document-check', 'any_device' => 'device-phone-mobile'] as $key => $icon)
                    <x-reveal wire:key="feature-{{ $key }}" :delay="$loop->index * 120">
                        <x-cards.feature :icon="$icon" :title="__('home.features.items.'.$key.'.title')" :description="__('home.features.items.'.$key.'.description')" />
                    </x-reveal>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    @if ($frequentlyAskedQuestions->isNotEmpty())
        <section class="overflow-hidden bg-radial-picton-2 px-5 py-20 lg:px-8 lg:py-28">
            <div class="mx-auto max-w-5xl">
                <div class="lg:grid lg:grid-cols-12 lg:gap-10">
                    <x-reveal class="lg:col-span-5">
                        <h2 class="text-center text-dark lg:text-left">{{ __('home.faq.title') }}</h2>
                        <p class="mt-4 text-center text-lg text-dark/70 lg:text-left">{{ __('home.faq.subtitle') }}</p>
                    </x-reveal>

                    <x-reveal :delay="120" class="mt-10 lg:col-span-7 lg:mt-0">
                        <flux:accordion transition exclusive>
                            @foreach ($frequentlyAskedQuestions as $frequentlyAskedQuestion)
                                <flux:accordion.item wire:key="faq-{{ $frequentlyAskedQuestion->id }}">
                                    <flux:accordion.heading>{{ $frequentlyAskedQuestion->question }}</flux:accordion.heading>
                                    <flux:accordion.content>{!! $frequentlyAskedQuestion->answer !!}</flux:accordion.content>
                                </flux:accordion.item>
                            @endforeach
                        </flux:accordion>
                    </x-reveal>
                </div>
            </div>
        </section>
    @endif

    {{-- Blog --}}
    @if ($posts->isNotEmpty())
        <section class="px-5 py-20 lg:px-8 lg:py-28">
            <div class="mx-auto max-w-5xl">
                <x-reveal class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                    <h2 class="text-dark">{{ __('home.blog.title') }}</h2>
                    <p class="text-lg text-dark/70">{{ __('home.blog.subtitle') }}</p>
                </x-reveal>

                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <x-reveal wire:key="post-{{ $post->id }}" :delay="$loop->index * 120">
                            <x-cards.post :post="$post" />
                        </x-reveal>
                    @endforeach
                </div>

                <div class="mt-10 flex justify-center">
                    <flux:button :href="route('posts.index')" variant="ghost" icon:trailing="arrow-up-right" wire:navigate>
                        {{ __('home.blog.cta') }}
                    </flux:button>
                </div>
            </div>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="px-5 pb-20 lg:px-8 lg:pb-28">
        <div class="mx-auto max-w-5xl">
            <x-reveal class="relative isolate overflow-hidden rounded-3xl bg-radial-picton-2 px-6 py-16 shadow-custom inset-ring-4 inset-ring-white lg:px-12 lg:py-20">
                <div class="mx-auto flex max-w-lg flex-col gap-3 text-center">
                    <h2 class="text-dark">{{ __('home.newsletter.title') }}</h2>
                    <p class="text-lg text-dark/70">{{ __('home.newsletter.subtitle') }}</p>
                </div>

                <livewire:subscribe-to-newsletter />
            </x-reveal>
        </div>
    </section>

    {{-- Final CTA band --}}
    <section class="px-5 pb-24 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <x-reveal class="flex flex-col items-center gap-6 rounded-3xl bg-blue-950 px-6 py-16 text-center lg:px-12 lg:py-20">
                <h2 class="max-w-2xl text-white">{{ __('home.cta.title') }}</h2>
                <p class="max-w-xl text-lg text-white/70">{{ __('home.cta.subtitle') }}</p>

                <div class="flex w-full flex-col items-center justify-center gap-3 sm:flex-row">
                    <flux:button :href="$primaryCtaHref" variant="primary" class="w-full sm:w-auto" icon:trailing="arrow-up-right">
                        {{ __('actions.start_free') }}
                    </flux:button>

                    <flux:button :href="route('pricing')" class="w-full sm:w-auto" wire:navigate>
                        {{ __('actions.see_pricing') }}
                    </flux:button>
                </div>
            </x-reveal>
        </div>
    </section>
</x-layouts.app>
