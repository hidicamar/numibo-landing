@props(['delay' => 0])

{{-- Fades and lifts its content in once it scrolls into view; styles live under
     `.reveal` in app.css and collapse to a plain block for reduced-motion users. --}}
<div
    {{ $attributes->class('reveal') }}
    @if ($delay) style="transition-delay: {{ $delay }}ms" @endif
    x-data="{ shown: false }"
    x-intersect.once.margin.-48px="shown = true"
    x-bind:class="shown && 'is-visible'"
>
    {{ $slot }}
</div>
