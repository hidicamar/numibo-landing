<?php

it('renders a Flux flag for the current locale and one per language in the switcher', function () {
    $html = $this->get(route('pricing'))->assertOk()->getContent();

    // The header renders the switcher twice (desktop and mobile); each shows the
    // current flag on the trigger plus one entry per locale in the menu.
    expect(substr_count($html, 'data-country="SI"'))->toBe(4)
        ->and(substr_count($html, 'data-country="GB"'))->toBe(2)
        ->and(substr_count($html, 'data-country="DE"'))->toBe(2)
        ->and(substr_count($html, 'data-country="HR"'))->toBe(2)
        ->and($html)->toContain('hreflang="en"', 'hreflang="de"', 'hreflang="hr"')
        ->and($html)->not->toContain('flag-country-');
});
