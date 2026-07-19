@props(['active'])

@php
    $baseClasses = 'inline-flex gap-x-2 items-center px-3 py-2 text-sm font-medium rounded-xl transition duration-300 ease-in-out';

    $activeClasses = ($active ?? false)
            ? 'bg-blue-50 text-blue-400'
            : 'bg-white text-black hover:bg-blue-50';
@endphp

<a {{ $attributes->merge(['class' => $baseClasses . ' ' . $activeClasses]) }}>
    {{ $slot }}
</a>
