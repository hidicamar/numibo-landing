@props(['index'])

@php
    $visual = config('screenshots.steps')[$index];
    $locale = app()->getLocale();
    $alt = __('home.steps.items.'.$index.'.image_alt');
    $source = fn (int $image): string => asset("img/usage/{$locale}/img-{$image}-{$visual['type']}.png");
@endphp

{{-- The picture for one how-it-works step, see config/screenshots.php. Both
     kinds sit in the same box and run off its bottom edge, so the three steps
     line up and each reads as the top of something longer; the fade at the
     bottom keeps that cut soft wherever it lands in a given locale. The images
     carry no width/height because the captures differ in height per locale and,
     being absolutely positioned in a fixed square, they cannot shift layout. --}}
<div {{ $attributes->class('relative aspect-square overflow-hidden rounded-xl bg-blue-50') }}>
    @if ($visual['type'] === 'paper')
        <img
            src="{{ $source($visual['images'][1]) }}"
            alt=""
            class="absolute top-[9%] left-[5%] h-auto w-[68%] -rotate-3 bg-white shadow-custom"
            loading="lazy"
            decoding="async"
        />

        <img
            src="{{ $source($visual['images'][0]) }}"
            alt="{{ $alt }}"
            class="absolute top-[22%] right-[5%] h-auto w-[68%] rotate-2 bg-white shadow-custom"
            loading="lazy"
            decoding="async"
        />
    @else
        <img
            src="{{ $source($visual['images'][0]) }}"
            alt="{{ $alt }}"
            class="absolute inset-x-4 top-4 h-auto w-[calc(100%-2rem)] rounded-2xl shadow-custom"
            loading="lazy"
            decoding="async"
        />
    @endif

    <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 bottom-0 h-[14%] bg-linear-to-t from-blue-50 to-blue-50/0"></div>
</div>
