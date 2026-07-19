@props([
    'plan',
    'emphasized' => null,
    'ctaLabel' => null,
])

@php
    $emphasized ??= $plan['recommended'];
    $ctaLabel ??= __('actions.start_free_trial');

    $yearlySavings = (int) round((1 - $plan['prices']['yearly'] / ($plan['prices']['monthly'] * 12)) * 100) ?: null;
@endphp

<div {{ $attributes->class([
    'relative flex h-full flex-col gap-6 rounded-2xl bg-white p-6 shadow-custom sm:p-8',
    'inset-ring-4 inset-ring-blue-50' => ! $emphasized,
    'ring-2 ring-blue-400 inset-ring-4 inset-ring-blue-100 md:scale-[1.03]' => $emphasized,
]) }}>
    @if ($emphasized)
        <flux:badge color="blue" variant="solid" size="sm" class="absolute -top-3 left-1/2 -translate-x-1/2">
            {{ __('labels.recommended') }}
        </flux:badge>
    @endif

    <div class="flex flex-col gap-1">
        <h4 class="text-dark">{{ __("billing.plans.{$plan['slug']}.name") }}</h4>

        <p class="text-sm text-dark/70">{{ __("billing.plans.{$plan['slug']}.description") }}</p>
    </div>

    <div>
        @foreach ($plan['prices'] as $period => $amount)
            <div x-cloak x-show="period === '{{ $period }}'" class="flex items-baseline gap-1">
                <span class="text-4xl font-semibold text-dark">{{ money($amount, config('plans.currency'))->format(app()->getLocale()) }}</span>
                <span class="text-sm text-dark/60">{{ $period === 'monthly' ? __('billing.pricing.per_month') : __('billing.pricing.per_year') }}</span>
            </div>
        @endforeach

        @if ($yearlySavings)
            <p x-cloak x-show="period === 'yearly'" class="mt-1 text-sm font-medium text-green-600">
                {{ __('pricing.save_percent', ['percent' => $yearlySavings]) }}
            </p>
        @endif
    </div>

    <ul class="flex flex-col gap-3 text-sm text-dark/80">
        @foreach (__("billing.plans.{$plan['slug']}.features") as $feature)
            <li class="flex items-start gap-2">
                <flux:icon.check-circle class="mt-0.5 size-5 shrink-0 text-green-500" />
                <span>{{ $feature }}</span>
            </li>
        @endforeach
    </ul>

    <div class="mt-auto flex flex-col gap-2">
        @foreach (array_keys($plan['prices']) as $period)
            <flux:button
                x-cloak
                x-show="period === '{{ $period }}'"
                href="{{ config('app.app_url') }}/register?plan={{ $plan['slug'] }}&period={{ $period }}"
                variant="{{ $emphasized ? 'primary' : 'outline' }}"
                class="w-full"
            >
                {{ $ctaLabel }}
            </flux:button>
        @endforeach

        <p class="text-center text-xs text-dark/50">
            {{ __('pricing.cta_microcopy', ['days' => config('plans.trial_days')]) }}
        </p>
    </div>
</div>
