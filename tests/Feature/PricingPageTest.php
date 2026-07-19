<?php

it('shows both plans with the recommended emphasis', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee(__('billing.plans.starter.name'))
        ->assertSee(__('billing.plans.premium.name'))
        ->assertSee(__('labels.recommended'));
});

it('links every plan and billing period to registration on the app', function () {
    $response = $this->get(route('pricing'))->assertOk();

    // Two plans × two billing periods → four register targets (toggled client-side).
    foreach (config('plans.plans') as $plan) {
        foreach (array_keys($plan['prices']) as $period) {
            $response->assertSee(config('app.app_url')."/register?plan={$plan['slug']}&period={$period}");
        }
    }
});

it('renders the configured prices', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee('3.99')
        ->assertSee('6.99')
        ->assertSee('29.99')
        ->assertSee('49.99');
});

it('offers a free-trial CTA with the trial notice', function () {
    $this->get(route('pricing'))
        ->assertOk()
        ->assertSee(__('actions.start_free_trial'))
        ->assertSee(__('billing.pricing.trial_notice', [
            'days' => config('plans.trial_days'),
            'count' => config('plans.trial_exercises'),
        ]));
});
