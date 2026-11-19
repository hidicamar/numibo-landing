@props(['index' => null, 'visual' => null, 'alt' => null])

@php
    $visual ??= config('screenshots.steps')[$index];
    $alt ??= __('home.steps.items.'.$index.'.image_alt');
    $locale = app()->getLocale();
    $source = fn (int $image): string => asset("img/usage/{$locale}/img-{$image}-{$visual['type']}.png");
@endphp

{{-- The picture for one how-it-works step or Premium feature, see config/screenshots.php.
     Every kind sits in the same box and runs off its bottom edge, so the cards
     line up and each reads as the top of something longer; the fade at the
     bottom keeps that cut soft wherever it lands in a given locale. Panel and
     paper images carry no width/height because the captures differ in height
     per locale and, being absolutely positioned in a fixed square, they cannot
     shift layout. A "mobile" capture is always 780x1688, shown in a phone frame. --}}
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
    @elseif ($visual['type'] === 'mobile')
        <div class="absolute top-5 left-1/2 w-[62%] -translate-x-1/2 rounded-[1.75rem] bg-white p-1.5 shadow-custom inset-ring-2 inset-ring-blue-50">
            <img
                src="{{ $source($visual['images'][0]) }}"
                alt="{{ $alt }}"
                width="780"
                height="1688"
                class="block h-auto w-full rounded-[1.375rem] border border-blue-100 bg-light"
                loading="lazy"
                decoding="async"
            />
        </div>
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
