<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Hero phone screenshots
    |--------------------------------------------------------------------------
    |
    | Ordered along the user journey: generate -> worksheet -> solve -> feedback
    | -> celebrate. Files live at public/img/usage/<locale>/img-<image>-mobile.png
    | and are described in public/img/usage/mapping.txt. Alt text lives in
    | lang/<locale>/home.php under home.hero.screenshots.<key>.
    |
    | The phone screen is a fixed 780:1688 box (the worksheet shots' size) that
    | crops from the top, so the generator shot may lose a few percent of its
    | edges in locales where it renders slightly taller or wider.
    |
    */

    'slides' => [
        ['key' => 'generator', 'image' => 7],
        ['key' => 'worksheet_blank', 'image' => 1],
        ['key' => 'worksheet_filled', 'image' => 2],
        ['key' => 'worksheet_feedback', 'image' => 4],
        ['key' => 'celebration_perfect', 'image' => 5],
    ],

];
