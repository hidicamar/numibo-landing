@production
    <x-head.cookieyes />
@endproduction

<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@unless ($hasSeo ?? false)
    <title>
        {{ filled($title ?? null) ? $title.' | '.config('app.short_url') : config('app.name') }}
    </title>
@endunless

<x-head.touch-icons />

<x-head.favicons />

@production
    <x-head.gtag />
@endproduction

@vite(['resources/css/app.css', 'resources/js/app.js'])
