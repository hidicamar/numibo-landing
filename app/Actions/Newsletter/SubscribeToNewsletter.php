<?php

namespace App\Actions\Newsletter;

use Brevo\Brevo;
use Brevo\Contacts\Requests\CreateContactRequest;

class SubscribeToNewsletter
{
    /**
     * Add the given email address to the Brevo newsletter list.
     */
    public function handle(string $email): void
    {
        $brevo = new Brevo(config('services.brevo.key'));

        $brevo->contacts->createContact(new CreateContactRequest([
            'email' => $email,
            'listIds' => [(int) config('services.brevo.lists.newsletter')],
            'updateEnabled' => true,
        ]));
    }
}
