<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@unless ($hasSeo ?? false)
    <title>
        {{ filled($title ?? null) ? $title.' - '.__('app.name') : __('app.name') }}
    </title>
@endunless

<x-head.touch-icons />

<x-head.favicons />

<x-head.cookieyes />

<x-head.gtag />

@vite(['resources/css/app.css', 'resources/js/app.js'])
