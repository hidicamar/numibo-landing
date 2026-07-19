@blaze(fold: true)

@props([
    'size' => null,
])

@php
// The marketing card recipe (rounded-2xl + shadow-custom + blue inset ring), applied app-wide.
// Everything sits behind [:where(&)] so any consumer class can override a piece of the recipe.
$classes = Flux::classes()
    ->add('[:where(&)]:bg-white')
    ->add('[:where(&)]:shadow-custom [:where(&)]:inset-ring-4 [:where(&)]:inset-ring-blue-50')
    ->add(match ($size) {
        default => '[:where(&)]:p-6 [:where(&)]:rounded-2xl',
        'sm' => '[:where(&)]:p-4 [:where(&)]:rounded-xl',
    })
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-card>
    {{ $slot }}
</div>
