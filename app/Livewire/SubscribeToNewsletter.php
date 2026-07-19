<?php

namespace App\Livewire;

use App\Actions\Newsletter\SubscribeToNewsletter as SubscribeToNewsletterAction;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Component;
use Throwable;

class SubscribeToNewsletter extends Component
{
    public string $email = '';

    public string $website = '';

    public bool $subscribed = false;

    public function subscribe(SubscribeToNewsletterAction $action): void
    {
        // Honeypot: only bots fill the hidden field, so silently report success.
        if (filled($this->website)) {
            $this->subscribed = true;

            return;
        }

        $this->validate([
            'email' => 'required|email:rfc,dns|max:255',
        ], attributes: [
            'email' => __('home.newsletter.placeholder'),
        ]);

        try {
            $action->handle($this->email);
        } catch (Throwable $exception) {
            report($exception);

            Flux::toast(variant: 'danger', text: __('home.newsletter.error'));

            return;
        }

        $this->subscribed = true;

        $this->reset('email');
    }

    public function render(): View
    {
        return view('livewire.subscribe-to-newsletter');
    }
}
