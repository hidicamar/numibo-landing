<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * @var array<int, array{question: string, answer: string}>
     */
    private array $slFaqs = [
        [
            'question' => 'Ali obstaja brezplačno preizkusno obdobje?',
            'answer' => 'Da, ob registraciji dobiš 7-dnevno brezplačno preizkusno obdobje.',
        ],
        [
            'question' => 'Katere vrste vaj so na voljo?',
            'answer' => 'Seštevanje, odštevanje, množenje in deljenje – vključno s poštevanko in nalogami po meri.',
        ],
        [
            'question' => 'Ali lahko zamenjam jezik?',
            'answer' => 'Da, aplikacija je na voljo v slovenščini, angleščini, nemščini in hrvaščini.',
        ],
        [
            'question' => 'Kako prekličem naročnino?',
            'answer' => 'Naročnino lahko kadar koli prekličeš v nastavitvah računa; dostop ti ostane do konca obračunskega obdobja.',
        ],
        [
            'question' => 'Ali lahko vaje natisnem?',
            'answer' => 'Da, vsak sklop vaj lahko izvoziš in natisneš kot PDF.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string}>
     */
    private array $enFaqs = [
        [
            'question' => 'Is there a free trial?',
            'answer' => 'Yes, you get a 7-day free trial when you sign up.',
        ],
        [
            'question' => 'What types of exercises are available?',
            'answer' => 'Addition, subtraction, multiplication and division – including the base times table and custom exercises.',
        ],
        [
            'question' => 'Can I change the language?',
            'answer' => 'Yes, the app is available in Slovene, English, German and Croatian.',
        ],
        [
            'question' => 'How do I cancel my subscription?',
            'answer' => 'You can cancel anytime from your account settings; access remains until the end of your billing period.',
        ],
        [
            'question' => 'Can I print the exercises?',
            'answer' => 'Yes, every exercise set can be exported and printed as a PDF.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string}>
     */
    private array $deFaqs = [
        [
            'question' => 'Gibt es eine kostenlose Testphase?',
            'answer' => 'Ja, bei der Registrierung erhalten Sie eine 7-tägige kostenlose Testphase.',
        ],
        [
            'question' => 'Welche Arten von Übungen gibt es?',
            'answer' => 'Addition, Subtraktion, Multiplikation und Division – einschließlich Grundtabelle und benutzerdefinierter Aufgaben.',
        ],
        [
            'question' => 'Kann ich die Sprache ändern?',
            'answer' => 'Ja, die App ist auf Slowenisch, Englisch, Deutsch und Kroatisch verfügbar.',
        ],
        [
            'question' => 'Wie kündige ich mein Abonnement?',
            'answer' => 'Sie können jederzeit in den Kontoeinstellungen kündigen; der Zugriff bleibt bis zum Ende des Abrechnungszeitraums bestehen.',
        ],
        [
            'question' => 'Kann ich die Übungen ausdrucken?',
            'answer' => 'Ja, jeder Übungssatz kann als PDF exportiert und gedruckt werden.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string}>
     */
    private array $hrFaqs = [
        [
            'question' => 'Postoji li besplatno probno razdoblje?',
            'answer' => 'Da, prilikom registracije dobivate 7-dnevno besplatno probno razdoblje.',
        ],
        [
            'question' => 'Koje su vrste vježbi dostupne?',
            'answer' => 'Zbrajanje, oduzimanje, množenje i dijeljenje – uključujući osnovnu tablicu i zadatke po želji.',
        ],
        [
            'question' => 'Mogu li promijeniti jezik?',
            'answer' => 'Da, aplikacija je dostupna na slovenskom, engleskom, njemačkom i hrvatskom jeziku.',
        ],
        [
            'question' => 'Kako mogu otkazati pretplatu?',
            'answer' => 'Pretplatu možete otkazati u bilo kojem trenutku u postavkama računa; pristup ostaje do kraja obračunskog razdoblja.',
        ],
        [
            'question' => 'Mogu li ispisati vježbe?',
            'answer' => 'Da, svaki skup vježbi možete izvesti i ispisati kao PDF.',
        ],
    ];

    public function run(): void
    {
        $languages = [
            'sl' => $this->slFaqs,
            'en' => $this->enFaqs,
            'de' => $this->deFaqs,
            'hr' => $this->hrFaqs,
        ];

        foreach ($languages as $lang => $faqs) {
            foreach ($faqs as $index => $faq) {
                Faq::withoutGlobalScopes()->updateOrCreate(
                    ['question' => $faq['question'], 'lang' => $lang],
                    [
                        'answer' => $faq['answer'],
                        'is_visible' => true,
                        'sort' => $index + 1,
                    ],
                );
            }
        }
    }
}
