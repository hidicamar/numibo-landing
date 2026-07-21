@php
    $primaryCtaHref = config('app.app_url').'/register';
    $maxYearlySavings = collect($plans)
        ->map(fn (array $plan) => (int) round((1 - $plan['prices']['yearly'] / ($plan['prices']['monthly'] * 12)) * 100))
        ->max();
@endphp

<x-layouts.app :title="__('titles.home')">
    <x-slot:seo>
        <x-head.meta.dynamic
            :title="$page?->seo?->title ?: __('titles.home').' - '.config('app.name')"
            :description="$page?->seo?->description ?: __('home.hero.subtitle')"
            :image="$page?->seo?->getFirstMediaUrl('seo-cover') ?: asset('img/banners/seo.png')"
        />
    </x-slot:seo>

    <section class="border-b border-blue-100 bg-radial-picton px-5 pt-40 pb-24 lg:px-8 lg:pt-48 lg:pb-32">
        <div class="flex flex-col items-center justify-center gap-8">
            <div class="flex flex-col gap-5">
                <h1 class="mx-auto max-w-4xl text-center text-3xl! text-dark md:text-5xl!">
                    {{ __('home.hero.title_lead') }}

                    <span class="relative inline-block whitespace-nowrap text-blue-400">
                        <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute top-2/3 left-0 h-[0.58em] w-full fill-blue-200" preserveAspectRatio="none">
                            <path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path>
                        </svg>

                        <span class="relative">{{ __('home.hero.title_highlight') }}</span>
                    </span>

                    {{ __('home.hero.title_trail') }}
                </h1>

                <p class="mx-auto max-w-2xl text-center text-lg text-dark/70 md:text-xl">
                    {{ __('home.hero.subtitle') }}
                </p>
            </div>

            <div class="flex w-full flex-col items-center justify-center gap-3 sm:flex-row">
                <flux:button :href="$primaryCtaHref" variant="primary" class="w-full sm:w-auto" icon:trailing="arrow-up-right">
                    {{ __('actions.start_free') }}
                </flux:button>

                <flux:button :href="route('pricing')" variant="ghost" class="w-full sm:w-auto" wire:navigate>
                    {{ __('actions.see_pricing') }}
                </flux:button>
            </div>
        </div>
    </section>

    {{-- Product preview --}}
    <section class="overflow-hidden px-5 py-20 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-5xl">
            <div class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.preview.eyebrow') }}</span>
                <h2 class="text-dark">{{ __('home.preview.title') }}</h2>
                <p class="text-lg text-dark/70">{{ __('home.preview.subtitle') }}</p>
            </div>

            <div class="mt-14 grid gap-6 lg:grid-cols-5">
                {{-- Worksheet mock --}}
                <div class="rounded-3xl bg-white p-2 shadow-custom inset-ring-4 inset-ring-blue-50 lg:col-span-3">
                    <div class="overflow-hidden rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-2 border-b border-blue-100 bg-blue-50/60 px-4 py-3">
                            <span class="size-3 rounded-full bg-red-300"></span>
                            <span class="size-3 rounded-full bg-yellow-300"></span>
                            <span class="size-3 rounded-full bg-green-300"></span>
                            <span class="ml-3 text-xs font-medium text-dark/50">{{ __('home.preview.worksheet_title') }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-x-10 gap-y-4 p-6 font-medium text-dark sm:grid-cols-3">
                            @foreach (['7 + 6 =', '15 − 8 =', '3 × 4 =', '20 − 7 =', '8 + 5 =', '18 ÷ 2 =', '6 × 3 =', '14 − 6 =', '9 + 9 =', '12 ÷ 4 =', '5 + 7 =', '7 × 2 =', '16 − 8 =', '24 ÷ 3 =', '9 + 4 =', '5 × 5 =', '11 − 3 =', '8 × 2 ='] as $equation)
                                <div wire:key="eq-{{ $loop->index }}" class="flex items-center gap-2 border-b border-dashed border-blue-100 pb-1.5 text-sm">
                                    <span>{{ $equation }}</span>
                                    <span class="inline-block h-4 w-8 rounded bg-blue-50"></span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Two output modes --}}
                <div class="flex flex-col gap-6 lg:col-span-2">
                    <div class="flex flex-1 flex-col gap-3 rounded-3xl bg-white p-8 shadow-custom inset-ring-4 inset-ring-blue-50">
                        <div class="flex size-12 items-center justify-center rounded-xl bg-blue-50 text-blue-500">
                            <flux:icon.cursor-arrow-rays class="size-6" />
                        </div>
                        <h6 class="text-dark">{{ __('home.preview.solve_online') }}</h6>
                        <p class="text-sm text-dark/70">{{ __('home.preview.solve_online_description') }}</p>
                    </div>

                    <div class="flex flex-1 flex-col gap-3 rounded-3xl bg-white p-8 shadow-custom inset-ring-4 inset-ring-blue-50">
                        <div class="flex size-12 items-center justify-center rounded-xl bg-blue-50 text-blue-500">
                            <flux:icon.document-arrow-down class="size-6" />
                        </div>
                        <h6 class="text-dark">{{ __('home.preview.download_pdf') }}</h6>
                        <p class="text-sm text-dark/70">{{ __('home.preview.download_pdf_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="bg-radial-picton-2 px-5 py-20 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-5xl">
            <div class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.steps.eyebrow') }}</span>
                <h2 class="text-dark">{{ __('home.steps.title') }}</h2>
            </div>

            <div class="mt-14 grid gap-6 md:grid-cols-3">
                @foreach (['cursor-arrow-rays', 'adjustments-horizontal', 'printer'] as $index => $icon)
                    <div wire:key="step-{{ $index }}" class="relative flex flex-col gap-4 rounded-2xl bg-white p-8 shadow-custom inset-ring-4 inset-ring-white">
                        <div class="flex items-center gap-3">
                            <span class="flex size-9 items-center justify-center rounded-full bg-blue-500 text-sm font-semibold text-white">{{ $index + 1 }}</span>
                            <flux:icon :name="$icon" class="size-6 text-blue-500" />
                        </div>
                        <h6 class="text-dark">{{ __('home.steps.items.'.$index.'.title') }}</h6>
                        <p class="text-sm text-dark/70">{{ __('home.steps.items.'.$index.'.description') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing teaser --}}
    <section class="px-5 py-20 lg:px-8 lg:py-28" x-data="{ period: 'monthly' }">
        <div class="mx-auto max-w-5xl">
            <div class="mx-auto flex max-w-2xl flex-col gap-4 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.pricing.eyebrow') }}</span>

                <h2 class="text-dark">{{ __('home.pricing.title') }}</h2>

                <p class="text-lg text-dark/70">{{ __('home.pricing.subtitle') }}</p>

                <div class="mt-2 flex justify-center">
                    <x-pricing.toggle :savings="$maxYearlySavings" />
                </div>
            </div>

            <div class="mx-auto mt-12 grid max-w-3xl gap-6 md:grid-cols-2">
                @foreach ($plans as $plan)
                    <x-pricing.plan-card wire:key="teaser-{{ $plan['slug'] }}" :plan="$plan" />
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                <flux:button :href="route('pricing')" variant="ghost" icon:trailing="arrow-up-right" wire:navigate>
                    {{ __('home.pricing.cta') }}
                </flux:button>
            </div>
        </div>
    </section>

    {{-- Feature bento grid --}}
    <section class="bg-radial-picton-2 px-5 py-20 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-5xl">
            <div class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                <span class="text-sm font-semibold tracking-wide text-blue-500 uppercase">{{ __('home.features.eyebrow') }}</span>
                <h2 class="text-dark">{{ __('home.features.title') }}</h2>
                <p class="text-lg text-dark/70">{{ __('home.features.subtitle') }}</p>
            </div>

            <div class="mt-14 grid gap-5 md:grid-cols-2">
                <x-cards.feature icon="academic-cap" :title="__('home.features.items.coverage.title')" :description="__('home.features.items.coverage.description')" />
                <x-cards.feature icon="clock" :title="__('home.features.items.no_prep.title')" :description="__('home.features.items.no_prep.description')" />
                <x-cards.feature icon="check-badge" :title="__('home.features.items.solutions.title')" :description="__('home.features.items.solutions.description')" />
                <x-cards.feature icon="bolt" :title="__('home.features.items.fast_learning.title')" :description="__('home.features.items.fast_learning.description')" />
            </div>
        </div>
    </section>

    {{-- Blog --}}
    @if ($posts->isNotEmpty())
        <section class="px-5 py-20 lg:px-8 lg:py-28">
            <div class="mx-auto max-w-5xl">
                <div class="mx-auto flex max-w-2xl flex-col gap-3 text-center">
                    <h2 class="text-dark">{{ __('home.blog.title') }}</h2>
                    <p class="text-lg text-dark/70">{{ __('home.blog.subtitle') }}</p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <x-cards.post :post="$post" wire:key="post-{{ $post->id }}" />
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

    {{-- FAQ --}}
    @if ($frequentlyAskedQuestions->isNotEmpty())
        <section class="overflow-hidden px-5 py-20 lg:px-8 lg:py-28">
            <div class="mx-auto max-w-5xl">
                <div class="lg:grid lg:grid-cols-12 lg:gap-10">
                    <div class="lg:col-span-5">
                        <h2 class="text-center text-dark lg:text-left">{{ __('home.faq.title') }}</h2>
                        <p class="mt-4 text-center text-lg text-dark/70 lg:text-left">{{ __('home.faq.subtitle') }}</p>
                    </div>

                    <div class="mt-10 lg:col-span-7 lg:mt-0">
                        <flux:accordion transition exclusive>
                            @foreach ($frequentlyAskedQuestions as $frequentlyAskedQuestion)
                                <flux:accordion.item wire:key="faq-{{ $frequentlyAskedQuestion->id }}">
                                    <flux:accordion.heading>{{ $frequentlyAskedQuestion->question }}</flux:accordion.heading>
                                    <flux:accordion.content>{!! $frequentlyAskedQuestion->answer !!}</flux:accordion.content>
                                </flux:accordion.item>
                            @endforeach
                        </flux:accordion>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="px-5 pb-20 lg:px-8 lg:pb-28">
        <div class="mx-auto max-w-5xl">
            <div class="relative isolate overflow-hidden rounded-3xl bg-radial-picton-2 px-6 py-16 shadow-custom inset-ring-4 inset-ring-white lg:px-12 lg:py-20">
                <div class="mx-auto flex max-w-lg flex-col gap-3 text-center">
                    <h2 class="text-dark">{{ __('home.newsletter.title') }}</h2>
                    <p class="text-lg text-dark/70">{{ __('home.newsletter.subtitle') }}</p>
                </div>

                <livewire:subscribe-to-newsletter />
            </div>
        </div>
    </section>

    {{-- Final CTA band --}}
    <section class="px-5 pb-24 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="flex flex-col items-center gap-6 rounded-3xl bg-blue-950 px-6 py-16 text-center lg:px-12 lg:py-20">
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
            </div>
        </div>
    </section>
</x-layouts.app>
