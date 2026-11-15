<?php

namespace App\Actions\Newsletter;

use Brevo\Brevo;
use Brevo\Contacts\Requests\CreateDoiContactRequest;

class SubscribeToNewsletter
{
    /**
     * Ask Brevo to send the double opt-in email for the newsletter list.
     *
     * The address joins the list only after its owner clicks the confirmation
     * link, which is what proves consent to receiving the newsletter.
     */
    public function handle(string $email): void
    {
        $brevo = new Brevo(config('services.brevo.key'));

        $brevo->contacts->createDoiContact(new CreateDoiContactRequest([
            'email' => $email,
            'includeListIds' => [(int) config('services.brevo.lists.newsletter')],
            'templateId' => (int) config('services.brevo.templates.double_opt_in'),
            'redirectionUrl' => route('home'),
        ]));
    }
}
