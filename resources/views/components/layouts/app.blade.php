@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scheme-light">
    <head>
        @include('partials.head', ['title' => $title, 'hasSeo' => isset($seo)])

        {{ $seo ?? '' }}
    </head>
    <body class="min-h-screen bg-light antialiased">
        <x-header />

        <main>
            {{ $slot }}
        </main>

        <x-footer />

        <x-back-to-top />

        <div class="blurred-footer"></div>

        @persist('toast')
            <flux:toast />
        @endpersist

        @fluxScripts
        @stack('scripts')
    </body>
</html>
