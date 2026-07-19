@php
    $locales = LaravelLocalization::getLocalesOrder();
    $flagFor = fn (array $properties): string => 'flag-country-'.strtolower(substr($properties['regional'], -2));
@endphp

<flux:dropdown position="bottom" align="end">
    <flux:button variant="ghost" size="sm">
        {{ svg($flagFor($locales[app()->getLocale()]), 'size-5 rounded-xs') }}
    </flux:button>

    <flux:menu>
        @foreach ($locales as $localeCode => $properties)
            <flux:menu.item
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                hreflang="{{ $localeCode }}"
            >
                {{ svg($flagFor($properties), 'mr-2 size-5 rounded-xs') }}
                {{ ucfirst($properties['native']) }}
            </flux:menu.item>
        @endforeach
    </flux:menu>
</flux:dropdown>
