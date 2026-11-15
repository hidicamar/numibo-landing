<?php

use App\Actions\Newsletter\SubscribeToNewsletter as SubscribeAction;
use App\Livewire\SubscribeToNewsletter;
use Database\Seeders\PageSeeder;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;

it('subscribes a valid email through the Brevo action', function () {
    $action = Mockery::mock(SubscribeAction::class);
    $action->shouldReceive('handle')->once()->with('reader@gmail.com');

    $component = new SubscribeToNewsletter;
    $component->email = 'reader@gmail.com';

    $component->subscribe($action);

    expect($component->subscribed)->toBeTrue()
        ->and($component->email)->toBe('');
});

it('rejects an invalid email without calling the action', function () {
    $action = Mockery::mock(SubscribeAction::class);
    $action->shouldNotReceive('handle');

    $component = new SubscribeToNewsletter;
    $component->email = 'not-an-email';

    expect(fn () => $component->subscribe($action))->toThrow(ValidationException::class);
    expect($component->subscribed)->toBeFalse();
});

it('silently reports success and skips the action for honeypot submissions', function () {
    $action = Mockery::mock(SubscribeAction::class);
    $action->shouldNotReceive('handle');

    $component = new SubscribeToNewsletter;
    $component->email = 'reader@gmail.com';
    $component->website = 'https://spam.example';

    $component->subscribe($action);

    expect($component->subscribed)->toBeTrue();
});

it('renders the newsletter form on the home page', function () {
    $this->seed(PageSeeder::class);

    $this->get(route('home'))
        ->assertOk()
        ->assertSeeLivewire(SubscribeToNewsletter::class)
        ->assertSee(__('home.newsletter.placeholder'));
});

it('links the privacy policy next to the newsletter form', function () {
    Livewire::test(SubscribeToNewsletter::class)
        ->assertSee(route('legal.privacy-policy'))
        ->assertSee(__('titles.legal.privacy_policy'));
});
