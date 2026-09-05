@php
    $locales = LaravelLocalization::getLocalesOrder();
    $countryFor = fn (array $properties): string => substr($properties['regional'], -2);
@endphp

<flux:dropdown position="bottom" align="end">
    <flux:button variant="ghost" size="sm">
        <flux:flag :country="$countryFor($locales[app()->getLocale()])" size="xs" :alt="ucfirst($locales[app()->getLocale()]['native'])" />
    </flux:button>

    <flux:menu>
        @foreach ($locales as $localeCode => $properties)
            <flux:menu.item
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                hreflang="{{ $localeCode }}"
            >
                <flux:flag :country="$countryFor($properties)" size="xs" class="mr-2" />
                {{ ucfirst($properties['native']) }}
            </flux:menu.item>
        @endforeach
    </flux:menu>
</flux:dropdown>
