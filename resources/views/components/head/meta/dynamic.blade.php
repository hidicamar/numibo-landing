@props([
    'title' => config('app.name'),
    'description' => config('app.description'),
    'image' => asset('img/banners/seo.png'),
])

<meta name="twitter:card" content="summary_large_image">

<meta property="og:title" content="{{ $title }}">
<meta property="og:site_name" content="{{ $title }}">
<meta name="twitter:title" content="{{ $title }}">

<meta property="og:description" content="{{ Str::limit($description, 200) }}">
<meta name="twitter:description" content="{{ Str::limit($description, 200) }}">
<meta name="description" content="{{ Str::limit($description, 200) }}">

<meta property="og:image" content="{{ $image }}">
<meta property="og:image:secure_url" content="{{ $image }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:image:alt" content="{{ $image }}">

<title>{{ $title }}</title>
