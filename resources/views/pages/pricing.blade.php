@php
    $maxYearlySavings = collect($plans)
        ->map(fn (array $plan) => (int) round((1 - $plan['prices']['yearly'] / ($plan['prices']['monthly'] * 12)) * 100))
        ->max();

    $comparisonRows = [
        ['label' => __('pricing.comparison.rows.unlimited'), 'starter' => true, 'premium' => true],
        ['label' => __('pricing.comparison.rows.all_types'), 'starter' => true, 'premium' => true],
        ['label' => __('pricing.comparison.rows.history'), 'starter' => false, 'premium' => true],
        ['label' => __('pricing.comparison.rows.statistics'), 'starter' => false, 'premium' => true],
    ];
@endphp

<x-layouts.app :title="__('billing.pricing.title')">
    <x-slot:seo>
        <x-head.meta.dynamic
            :title="__('billing.pricing.title').' - '.__('app.name')"
            :description="__('pricing.hero.subtitle')"
        />
    </x-slot:seo>

    <div x-data="{ period: 'monthly' }">
        {{-- Hero + toggle --}}
        <section class="border-b border-blue-100 bg-radial-picton px-5 pt-40 pb-16 lg:px-8 lg:pt-48 lg:pb-20">
            <div class="mx-auto flex max-w-2xl flex-col items-center gap-5 text-center">
                <h1 class="text-3xl! text-dark md:text-5xl!">{{ __('pricing.hero.title') }}</h1>
                <p class="text-lg text-dark/70 md:text-xl">{{ __('pricing.hero.subtitle') }}</p>

                <div class="mt-2">
                    <x-pricing.toggle :savings="$maxYearlySavings" />
                </div>
            </div>
        </section>

        {{-- Plans --}}
        <section class="px-5 py-16 lg:px-8 lg:py-20">
            <div class="mx-auto max-w-4xl">
                <div class="grid items-stretch gap-6 md:grid-cols-2">
                    @foreach ($plans as $plan)
                        <x-pricing.plan-card wire:key="plan-{{ $plan['slug'] }}" :plan="$plan" />
                    @endforeach
                </div>

                <p class="mt-8 text-center text-sm text-dark/60">
                    {{ __('billing.pricing.trial_notice', ['days' => config('plans.trial_days'), 'count' => config('plans.trial_exercises')]) }}
                </p>
            </div>
        </section>

        {{-- Micro-comparison --}}
        <section class="bg-radial-picton-2 px-5 py-16 lg:px-8 lg:py-20">
            <div class="mx-auto max-w-3xl">
                <h2 class="text-center text-dark">{{ __('pricing.comparison.title') }}</h2>

                <div class="mt-10 overflow-hidden rounded-2xl bg-white shadow-custom inset-ring-4 inset-ring-white">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-blue-100 text-sm">
                                <th class="px-5 py-4 font-medium text-dark/60">{{ __('pricing.comparison.feature') }}</th>
                                <th class="px-5 py-4 text-center font-semibold text-dark">{{ __('billing.plans.starter.name') }}</th>
                                <th class="px-5 py-4 text-center font-semibold text-dark">{{ __('billing.plans.premium.name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comparisonRows as $row)
                                <tr wire:key="cmp-{{ $loop->index }}" @unless ($loop->last) class="border-b border-blue-50" @endunless>
                                    <td class="px-5 py-4 text-sm text-dark/80">{{ $row['label'] }}</td>
                                    <td class="px-5 py-4 text-center">
                                        @if ($row['starter'])
                                            <flux:icon.check-circle class="mx-auto size-5 text-green-500" />
                                        @else
                                            <flux:icon.minus class="mx-auto size-5 text-dark/25" />
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if ($row['premium'])
                                            <flux:icon.check-circle class="mx-auto size-5 text-green-500" />
                                        @else
                                            <flux:icon.minus class="mx-auto size-5 text-dark/25" />
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        @if ($frequentlyAskedQuestions->isNotEmpty())
            <section class="px-5 py-16 lg:px-8 lg:py-20">
                <div class="mx-auto max-w-3xl">
                    <h2 class="text-center text-dark">{{ __('home.faq.title') }}</h2>

                    <div class="mt-10">
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
            </section>
        @endif

        {{-- Final CTA band --}}
        <section class="px-5 pb-24 lg:px-8">
            <div class="mx-auto max-w-5xl">
                <div class="flex flex-col items-center gap-6 rounded-3xl bg-blue-950 px-6 py-16 text-center lg:px-12 lg:py-20">
                    <h2 class="max-w-2xl text-white">{{ __('pricing.cta.title') }}</h2>
                    <p class="max-w-xl text-lg text-white/70">{{ __('pricing.cta.subtitle') }}</p>

                    <flux:button href="{{ config('app.app_url').'/register' }}" variant="primary" icon:trailing="arrow-up-right">
                        {{ __('actions.start_free') }}
                    </flux:button>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
