<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Hero phone screenshots
    |--------------------------------------------------------------------------
    |
    | The hero shows the child's side of the product: solve -> feedback ->
    | celebrate. Files live at public/img/usage/<locale>/img-<image>-mobile.png
    | and are described in public/img/usage/mapping.txt. The caption under the
    | phone (also the alt text) lives in lang/<locale>/home.php under
    | home.hero.screenshots.<key>.
    |
    | Every shot is a 780:1688 capture with the app's own header and toolbar hidden, so the
    | phone screen opens on worksheet content instead of navigation.
    |
    */

    'slides' => [
        ['key' => 'worksheet_filled', 'image' => 9],
        ['key' => 'worksheet_feedback', 'image' => 10],
        ['key' => 'celebration_perfect', 'image' => 11],
    ],

    /*
    |--------------------------------------------------------------------------
    | How-it-works step visuals
    |--------------------------------------------------------------------------
    |
    | One visual per step, in step order, showing the adult's side: the two
    | generators, then the printed result. A "panel" is a single generator
    | card cropped from its top; "paper" is the real PDF, front page first and
    | the optional answer key behind it. Files live at
    | public/img/usage/<locale>/img-<image>-<type>.png and alt text under
    | home.steps.items.<index>.image_alt.
    |
    */

    'steps' => [
        ['type' => 'panel', 'images' => [12]],
        ['type' => 'panel', 'images' => [13]],
        ['type' => 'paper', 'images' => [14, 15]],
    ],

];
