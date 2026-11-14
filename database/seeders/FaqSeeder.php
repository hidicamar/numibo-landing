<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

/**
 * Seeds the FAQ for early access: the paid-plan rows (trial, cancelling) are
 * created hidden, and the early-access rows visible. Swap them with the
 * `is_visible` toggle in the admin panel once paid plans launch.
 */
class FaqSeeder extends Seeder
{
    /**
     * @var array<int, array{question: string, answer: string, is_visible?: bool}>
     */
    private array $slFaqs = [
        [
            'question' => 'Ali je Numibo res brezplačen?',
            'answer' => 'Da. V zgodnjem dostopu je vse brezplačno in ne potrebuješ kartice. Za nove delovne liste velja radodarna mesečna omejitev.',
        ],
        [
            'question' => 'Kaj se zgodi, ko se zgodnji dostop konča?',
            'answer' => 'Numibo bo postal plačljiv. O tem te bomo pravočasno obvestili po e-pošti, zaračunali pa ti ne bomo ničesar, dokler ne izbereš paketa.',
        ],
        [
            'question' => 'Ali obstaja brezplačno preizkusno obdobje?',
            'answer' => 'Da, ob registraciji dobiš 7-dnevno brezplačno preizkusno obdobje.',
            'is_visible' => false,
        ],
        [
            'question' => 'Katere vrste vaj so na voljo?',
            'answer' => 'Seštevanje, odštevanje, množenje in deljenje – vključno s poštevanko in nalogami po meri.',
        ],
        [
            'question' => 'Ali lahko dodam več otrok?',
            'answer' => 'Ni ti jih treba dodajati: z enim računom lahko ustvarjaš delovne liste za poljubno število otrok.',
        ],
        [
            'question' => 'Ali lahko zamenjam jezik?',
            'answer' => 'Da, aplikacija je na voljo v slovenščini, angleščini, nemščini in hrvaščini.',
        ],
        [
            'question' => 'Kako prekličem naročnino?',
            'answer' => 'Naročnino lahko kadar koli prekličeš v nastavitvah računa; dostop ti ostane do konca obračunskega obdobja.',
            'is_visible' => false,
        ],
        [
            'question' => 'Ali lahko vaje natisnem?',
            'answer' => 'Da, vsak sklop vaj lahko izvoziš in natisneš kot PDF.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string, is_visible?: bool}>
     */
    private array $enFaqs = [
        [
            'question' => 'Is Numibo really free?',
            'answer' => 'Yes. During early access everything is free and you don\'t need a card. A generous monthly limit applies to new worksheets.',
        ],
        [
            'question' => 'What happens when early access ends?',
            'answer' => 'Numibo will become a paid app. We will email you well before that happens, and nothing is charged until you choose a plan.',
        ],
        [
            'question' => 'Is there a free trial?',
            'answer' => 'Yes, you get a 7-day free trial when you sign up.',
            'is_visible' => false,
        ],
        [
            'question' => 'What types of exercises are available?',
            'answer' => 'Addition, subtraction, multiplication and division – including the base times table and custom exercises.',
        ],
        [
            'question' => 'Can I add more than one child?',
            'answer' => 'You don\'t need to add them: one account can create worksheets for as many children as you like.',
        ],
        [
            'question' => 'Can I change the language?',
            'answer' => 'Yes, the app is available in Slovene, English, German and Croatian.',
        ],
        [
            'question' => 'How do I cancel my subscription?',
            'answer' => 'You can cancel anytime from your account settings; access remains until the end of your billing period.',
            'is_visible' => false,
        ],
        [
            'question' => 'Can I print the exercises?',
            'answer' => 'Yes, every exercise set can be exported and printed as a PDF.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string, is_visible?: bool}>
     */
    private array $deFaqs = [
        [
            'question' => 'Ist Numibo wirklich kostenlos?',
            'answer' => 'Ja. Im Early Access ist alles kostenlos, und du brauchst keine Karte. Für neue Arbeitsblätter gilt ein großzügiges monatliches Limit.',
        ],
        [
            'question' => 'Was passiert, wenn der Early Access endet?',
            'answer' => 'Numibo wird kostenpflichtig. Wir informieren dich rechtzeitig per E-Mail, und berechnet wird erst etwas, wenn du einen Tarif wählst.',
        ],
        [
            'question' => 'Gibt es eine kostenlose Testphase?',
            'answer' => 'Ja, bei der Registrierung erhältst du eine 7-tägige kostenlose Testphase.',
            'is_visible' => false,
        ],
        [
            'question' => 'Welche Arten von Übungen gibt es?',
            'answer' => 'Addition, Subtraktion, Multiplikation und Division – einschließlich Grundtabelle und benutzerdefinierter Aufgaben.',
        ],
        [
            'question' => 'Kann ich mehrere Kinder hinzufügen?',
            'answer' => 'Das ist nicht nötig: Mit einem Konto kannst du Arbeitsblätter für beliebig viele Kinder erstellen.',
        ],
        [
            'question' => 'Kann ich die Sprache ändern?',
            'answer' => 'Ja, die App ist auf Slowenisch, Englisch, Deutsch und Kroatisch verfügbar.',
        ],
        [
            'question' => 'Wie kündige ich mein Abonnement?',
            'answer' => 'Du kannst jederzeit in den Kontoeinstellungen kündigen; der Zugriff bleibt bis zum Ende des Abrechnungszeitraums bestehen.',
            'is_visible' => false,
        ],
        [
            'question' => 'Kann ich die Übungen ausdrucken?',
            'answer' => 'Ja, jeder Übungssatz kann als PDF exportiert und gedruckt werden.',
        ],
    ];

    /**
     * @var array<int, array{question: string, answer: string, is_visible?: bool}>
     */
    private array $hrFaqs = [
        [
            'question' => 'Je li Numibo stvarno besplatan?',
            'answer' => 'Da. U ranom pristupu sve je besplatno i ne trebaš karticu. Za nove radne listove vrijedi izdašno mjesečno ograničenje.',
        ],
        [
            'question' => 'Što se događa kad rani pristup završi?',
            'answer' => 'Numibo će postati aplikacija koja se plaća. Na vrijeme ćemo te obavijestiti e-poštom i ništa ti nećemo naplatiti dok ne odabereš paket.',
        ],
        [
            'question' => 'Postoji li besplatno probno razdoblje?',
            'answer' => 'Da, prilikom registracije dobivaš 7-dnevno besplatno probno razdoblje.',
            'is_visible' => false,
        ],
        [
            'question' => 'Koje su vrste vježbi dostupne?',
            'answer' => 'Zbrajanje, oduzimanje, množenje i dijeljenje – uključujući osnovnu tablicu i zadatke po želji.',
        ],
        [
            'question' => 'Mogu li dodati više djece?',
            'answer' => 'Ne trebaš ih dodavati: s jednim računom možeš izrađivati radne listove za koliko god djece želiš.',
        ],
        [
            'question' => 'Mogu li promijeniti jezik?',
            'answer' => 'Da, aplikacija je dostupna na slovenskom, engleskom, njemačkom i hrvatskom jeziku.',
        ],
        [
            'question' => 'Kako mogu otkazati pretplatu?',
            'answer' => 'Pretplatu možeš otkazati u bilo kojem trenutku u postavkama računa; pristup ostaje do kraja obračunskog razdoblja.',
            'is_visible' => false,
        ],
        [
            'question' => 'Mogu li ispisati vježbe?',
            'answer' => 'Da, svaki skup vježbi možeš izvesti i ispisati kao PDF.',
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
                        'is_visible' => $faq['is_visible'] ?? true,
                        'sort' => $index + 1,
                    ],
                );
            }
        }
    }
}
