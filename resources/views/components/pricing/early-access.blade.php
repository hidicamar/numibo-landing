@props(['showMicrocopy' => false])

{{-- Stands in for the plan cards while `plans.early_access` is on: one panel that says
     the app is free for now, what that includes, and that paid plans follow later. --}}
<div {{ $attributes->class('overflow-hidden rounded-3xl bg-white shadow-custom ring-2 ring-blue-400 inset-ring-4 inset-ring-blue-100') }}>
    <div class="grid gap-8 p-6 sm:p-10 lg:grid-cols-12 lg:gap-12 lg:p-12">
        <div class="flex flex-col gap-5 lg:col-span-7">
            <h2 class="text-dark">{{ __('pricing.early_access.title') }}</h2>

            <p class="text-lg text-dark/70">{{ __('pricing.early_access.subtitle') }}</p>

            <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-5">
                <flux:button
                    href="{{ config('app.app_url') }}/register"
                    variant="primary"
                    class="w-full sm:w-auto"
                    icon:trailing="arrow-up-right"
                >
                    {{ __('actions.start_free') }}
                </flux:button>

                @if ($showMicrocopy)
                    <p class="text-center text-sm text-balance text-dark/70 sm:text-left">{{ __('pricing.early_access.microcopy') }}</p>
                @endif
            </div>
        </div>

        <div class="border-t border-blue-100 pt-8 lg:col-span-5 lg:border-t-0 lg:border-l lg:pt-0 lg:pl-12">
            <h6 class="text-dark">{{ __('pricing.early_access.included') }}</h6>

            <ul class="mt-4 flex flex-col gap-3 text-sm text-dark/80">
                @foreach (__('pricing.early_access.features') as $feature)
                    <li class="flex items-start gap-2">
                        <flux:icon.check-circle class="mt-0.5 size-5 shrink-0 text-green-500" />
                        <span>{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex items-start gap-3 border-t border-blue-100 bg-blue-50 px-6 py-5 sm:px-10 lg:px-12">
        <flux:icon.bell-alert class="mt-0.5 size-5 shrink-0 text-blue-600" />

        <p class="text-sm text-dark/80">
            <strong class="font-semibold text-dark">{{ __('pricing.early_access.later_title') }}.</strong>
            {{ __('pricing.early_access.later') }}
        </p>
    </div>
</div>
