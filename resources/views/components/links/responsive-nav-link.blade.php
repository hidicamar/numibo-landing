@props(['active'])

@php
    $baseClasses = 'block text-center text-lg';

    $activeClasses = ($active ?? false)
        ? 'text-blue-400'
        : 'text-dark';
@endphp

<a {{ $attributes->merge(['class' => $baseClasses . ' ' . $activeClasses]) }}>
    {{ $slot }}
</a>
