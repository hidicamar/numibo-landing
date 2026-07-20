@php
    $links = [
        ['route' => 'home', 'current' => request()->routeIs('home'), 'label' => __('titles.home')],
        ['route' => 'pricing', 'current' => request()->routeIs('pricing'), 'label' => __('titles.pricing')],
        ['route' => 'posts.index', 'current' => request()->routeIs('posts.*'), 'label' => __('titles.blog')],
    ];
@endphp

<header
    x-data="{ open: false }"
    class="fixed left-1/2 top-5 z-50 mx-auto w-[90%] max-w-5xl -translate-x-1/2"
>
    <nav
        :class="open ? 'bg-white' : 'bg-white/50'"
        class="flex h-min w-full flex-col justify-between rounded-2xl p-5 shadow-lg backdrop-blur-sm"
    >
        <div class="relative flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="w-56" wire:navigate>
                <img src="{{ asset('img/logo/png/primary.png') }}" alt="{{ __('app.name') }}" class="h-9" />
            </a>

            <div class="hidden flex-1 flex-row justify-center gap-10 lg:flex">
                @foreach ($links as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="nav-swap-link text-sm font-medium text-dark"
                        data-replace="{{ $link['label'] }}"
                        @if ($link['current']) data-current @endif
                        wire:navigate
                    >
                        <span>{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="hidden items-center justify-end gap-2 lg:flex w-56">
                <x-partials.locale-switcher />

                <flux:button
                    href="{{ config('app.app_url').'/register' }}"
                    variant="primary"
                    size="sm"
                    icon:trailing="arrow-up-right"
                >
                    {{ __('actions.start_free') }}
                </flux:button>
            </div>

            <div class="flex items-center gap-1 lg:hidden">
                <x-partials.locale-switcher />

                <button
                    type="button"
                    x-on:click="open = ! open"
                    aria-label="{{ __('labels.menu') }}"
                >
                    <flux:icon.bars-3 x-show="! open" />
                    <flux:icon.x-mark x-cloak x-show="open" />
                </button>
            </div>
        </div>

        <div
            x-show="open"
            x-cloak
            x-collapse
            class="flex w-full flex-col items-center gap-5 px-5 pb-5 pt-10"
        >
            @foreach ($links as $link)
                <x-links.responsive-nav-link
                    :href="route($link['route'])"
                    :active="$link['current']"
                    wire:navigate
                >
                    {{ $link['label'] }}
                </x-links.responsive-nav-link>
            @endforeach

            <flux:button
                href="{{ config('app.app_url').'/register' }}"
                variant="primary"
                class="w-full"
                icon:trailing="arrow-up-right"
            >
                {{ __('actions.start_free') }}
            </flux:button>
        </div>
    </nav>
</header>
