<div
    x-data="{ show: false }"
    x-on:scroll.window.throttle.150ms="show = window.scrollY > 400"
    x-show="show"
    x-cloak
    x-transition.opacity.duration.300ms
    class="fixed right-6 bottom-6 z-40"
>
    <button
        type="button"
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="flex size-11 items-center justify-center rounded-full bg-blue-500 text-white shadow-custom transition hover:bg-blue-600"
        aria-label="{{ __('actions.back_to_top') }}"
    >
        <flux:icon.arrow-up variant="mini" />
    </button>
</div>
