{{-- Consent banner for the one optional thing the site sets: Google Analytics cookies.
     The `cookieConsent` Alpine component lives in resources/js/app.js. Reject is the
     quieter colour, but stays a full button of the same size next to accept: refusing
     must be as easy as agreeing. --}}
<div
    x-data="cookieConsent"
    x-on:cookie-settings.window="open = true"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.300ms
    role="region"
    aria-label="{{ __('cookies.banner.title') }}"
    class="fixed inset-x-0 bottom-0 z-50 p-3 sm:p-5"
>
    <div class="mx-auto flex max-w-3xl flex-col gap-4 rounded-2xl bg-white p-5 shadow-custom ring-1 ring-blue-100 sm:flex-row sm:items-center sm:gap-6 sm:p-6">
        <div class="flex flex-col gap-1">
            <p class="font-semibold text-dark">{{ __('cookies.banner.title') }}</p>

            <p class="text-sm/6 text-dark/70">
                {{ __('cookies.banner.body') }}
                <a href="{{ route('legal.cookies') }}" class="font-medium text-blue-600 underline underline-offset-2 hover:text-blue-700" wire:navigate>{{ __('cookies.banner.policy_link') }}</a>
            </p>
        </div>

        <div class="grid shrink-0 grid-cols-2 gap-3">
            <flux:button variant="outline" x-on:click="reject">{{ __('cookies.banner.reject') }}</flux:button>

            <flux:button variant="primary" x-on:click="accept">{{ __('cookies.banner.accept') }}</flux:button>
        </div>
    </div>
</div>
