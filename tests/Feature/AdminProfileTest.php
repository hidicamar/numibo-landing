<?php

use App\Models\User;
use Filament\Auth\Pages\EditProfile;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

beforeEach(function () {
    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $this->user = User::factory()->create(['password' => 'current-password']);

    $this->actingAs($this->user);
});

it('shows the profile page to an authenticated user', function () {
    $this->get(Filament::getProfileUrl())
        ->assertOk()
        ->assertSee($this->user->email);
});

it('redirects guests away from the profile page', function () {
    auth()->logout();

    $this->get(Filament::getProfileUrl())->assertRedirect(Filament::getLoginUrl());
});

it('updates the name without asking for the current password', function () {
    Livewire::test(EditProfile::class)
        ->fillForm(['name' => 'New Name'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->user->refresh()->name)->toBe('New Name');
});

it('updates the email when the current password is confirmed', function () {
    Livewire::test(EditProfile::class)
        ->fillForm([
            'email' => 'new@example.com',
            'currentPassword' => 'current-password',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->user->refresh()->email)->toBe('new@example.com');
});

it('updates the password when the current password is confirmed', function () {
    Livewire::test(EditProfile::class)
        ->fillForm([
            'password' => 'brand-new-password',
            'passwordConfirmation' => 'brand-new-password',
            'currentPassword' => 'current-password',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(Hash::check('brand-new-password', $this->user->refresh()->password))->toBeTrue();
});

it('rejects a password change with a wrong current password', function () {
    Livewire::test(EditProfile::class)
        ->fillForm([
            'password' => 'brand-new-password',
            'passwordConfirmation' => 'brand-new-password',
            'currentPassword' => 'wrong-password',
        ])
        ->call('save')
        ->assertHasFormErrors(['currentPassword']);

    expect(Hash::check('current-password', $this->user->refresh()->password))->toBeTrue();
});

it('rejects a password change when the confirmation does not match', function () {
    Livewire::test(EditProfile::class)
        ->fillForm([
            'password' => 'brand-new-password',
            'passwordConfirmation' => 'something-else',
            'currentPassword' => 'current-password',
        ])
        ->call('save')
        ->assertHasFormErrors(['password']);

    expect(Hash::check('current-password', $this->user->refresh()->password))->toBeTrue();
});
