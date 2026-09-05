<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Operator identity
    |--------------------------------------------------------------------------
    |
    | Legal details of the site operator, substituted into the bracket tokens
    | ([OPERATOR NAME], [ADDRESS], ...) of the admin-managed legal pages at
    | render time (see LegalPageController). The contact email intentionally
    | reuses mail.from.address so the whole site shares one address.
    |
    */

    'name' => env('COMPANY_NAME'),

    'address' => env('COMPANY_ADDRESS'),

    'registration_number' => env('COMPANY_REGISTRATION_NUMBER'),

    'vat_id' => env('COMPANY_VAT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Social profiles
    |--------------------------------------------------------------------------
    |
    | Public social media profiles, rendered in the footer. Each key matches an
    | icon component in resources/views/components/icons, and profiles without
    | a configured URL are dropped so unlaunched channels stay hidden.
    |
    */

    'socials' => array_filter([
        'facebook' => ['name' => 'Facebook', 'url' => env('SOCIAL_FACEBOOK_URL')],
        'instagram' => ['name' => 'Instagram', 'url' => env('SOCIAL_INSTAGRAM_URL')],
        'tiktok' => ['name' => 'TikTok', 'url' => env('SOCIAL_TIKTOK_URL')],
    ], fn (array $social): bool => filled($social['url'])),

];
