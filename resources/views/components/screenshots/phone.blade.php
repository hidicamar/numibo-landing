@props(['slides' => null])

@php
    $slides ??= config('screenshots.slides');
    $locale = app()->getLocale();
@endphp

{{-- Mounted by resources/js/app.js. No arrows: the dots below signal there is
     more to swipe, and buttons over a phone screen this narrow cover the app UI.
     The caption names the slide on screen; app.js swaps it on every change. --}}
<div {{ $attributes->class('flex flex-col items-center gap-5') }} data-screenshots>
    <div class="w-[17rem] rounded-[2.5rem] bg-white p-2 shadow-custom inset-ring-4 inset-ring-blue-50 motion-safe:animate-float sm:w-[19rem]">
        <div class="relative overflow-hidden rounded-[2rem] border border-blue-100 bg-light">
            <div class="pointer-events-none absolute inset-x-0 top-0 z-20 flex justify-center pt-2.5">
                <span class="h-1.5 w-14 rounded-full bg-blue-100/80"></span>
            </div>

            <div class="swiper" aria-label="{{ __('home.hero.screenshots_label') }}">
                <div class="swiper-wrapper">
                    @foreach ($slides as $slide)
                        <div wire:key="screenshot-{{ $slide['key'] }}" class="swiper-slide aspect-[780/1688]" data-caption="{{ __('home.hero.screenshots.'.$slide['key']) }}">
                            <img
                                src="{{ asset("img/usage/{$locale}/img-{$slide['image']}-mobile.png") }}"
                                alt="{{ __('home.hero.screenshots.'.$slide['key']) }}"
                                width="780"
                                height="1688"
                                class="h-full w-full object-cover object-top"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                @if ($loop->first) fetchpriority="high" @endif
                                decoding="async"
                                draggable="false"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center gap-3">
        {{-- Hidden from assistive tech: each slide's alt text already says the same. --}}
        <p class="text-sm font-medium text-dark" data-screenshot-caption aria-hidden="true">
            {{ __('home.hero.screenshots.'.$slides[0]['key']) }}
        </p>

        <div class="swiper-pagination flex items-center justify-center gap-2" aria-label="{{ __('home.hero.screenshots_label') }}"></div>
    </div>
</div>
