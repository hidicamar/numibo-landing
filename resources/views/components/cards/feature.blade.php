@props([
    'title',
    'description',
    'icon' => null,
])

<div {{ $attributes->class('relative') }}>
    <div class="flex h-full flex-col gap-4 overflow-hidden rounded-2xl bg-white p-6 shadow-custom inset-ring-4 inset-ring-blue-50 sm:p-8">
        @if ($icon)
            <div class="flex size-12 items-center justify-center rounded-xl bg-blue-50 text-blue-500 max-lg:mx-auto">
                <flux:icon :name="$icon" class="size-6" />
            </div>
        @endif

        <div>
            <h6 class="text-dark max-lg:text-center">{{ $title }}</h6>
            <p class="mt-2 text-sm text-dark/70 max-lg:text-center">{{ $description }}</p>
        </div>

        {{ $slot }}
    </div>
</div>
