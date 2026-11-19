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
            'question' => 'Kaj se zgodi, ko se čas za vajo izteče?',
            'answer' => 'Vaja se odda z odgovori, ki jih je otrok vpisal do takrat, prazni pa štejejo kot napačni. S paketom Premium omejitev nastaviš, ko ustvariš vajo: 3, 5, 10 ali 15 minut ali poljubno število minut od 1 do 60. Na natisnjenem PDF-ju časovne omejitve ni.',
        ],
        [
            'question' => 'Ali lahko dodam več otrok?',
            'answer' => 'Da. Z enim računom lahko ustvarjaš vaje za poljubno število otrok. S paketom Premium lahko dodaš še največ 4 profile otrok, tako da so rezultati, zvezdice in značke vsakega otroka ločeni.',
        ],
        [
            'question' => 'Kaj so zvezdice, tedenski niz in značke?',
            'answer' => 'To so nagrade v paketu Premium in pripadajo profilu otroka. Vsaka oddana vaja prinese do 3 zvezdice: pri 75 % pravilnih 2 in pri 90 % 3; šteje najboljši poskus. Če otrok vadi 3 dni v tednu (od ponedeljka do nedelje), se tedenski niz nadaljuje, osvojiti pa je mogoče 12 značk.',
        ],
        [
            'question' => 'Ali lahko zamenjam jezik?',
            'answer' => 'Da, aplikacija je na voljo v slovenščini, angleščini, nemščini, hrvaščini in bosanščini.',
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
            'question' => 'What happens when the time limit runs out?',
            'answer' => 'The exercise is handed in with the answers given so far, and any left empty count as wrong. With Premium you set the limit when you create the exercise: 3, 5, 10 or 15 minutes, or any number of minutes from 1 to 60. The printed PDF does not show the time limit.',
        ],
        [
            'question' => 'Can I add more than one child?',
            'answer' => 'Yes. One account can create exercises for as many children as you like. With Premium you can also add up to 4 child profiles, so each child\'s results, stars and badges are kept apart.',
        ],
        [
            'question' => 'What are stars, the weekly streak and badges?',
            'answer' => 'They are the Premium rewards, and they belong to a child profile. Every exercise handed in earns up to 3 stars: 2 stars at 75% correct and 3 stars at 90%; the best try counts. Practising on 3 days in a week, Monday to Sunday, keeps the weekly streak going, and there are 12 badges to earn.',
        ],
        [
            'question' => 'Can I change the language?',
            'answer' => 'Yes, the app is available in Slovene, English, German, Croatian and Bosnian.',
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
            'question' => 'Was passiert, wenn das Zeitlimit abläuft?',
            'answer' => 'Die Übung wird mit den bis dahin gegebenen Antworten abgegeben, und leere zählen als falsch. Mit Premium legst du das Limit beim Erstellen der Übung fest: 3, 5, 10 oder 15 Minuten oder eine beliebige Minutenzahl von 1 bis 60. Im ausgedruckten PDF steht das Zeitlimit nicht.',
        ],
        [
            'question' => 'Kann ich mehrere Kinder hinzufügen?',
            'answer' => 'Ja. Mit einem Konto kannst du Übungen für beliebig viele Kinder erstellen. Mit Premium kannst du zusätzlich bis zu 4 Kinderprofile anlegen, damit Ergebnisse, Sterne und Abzeichen jedes Kindes getrennt bleiben.',
        ],
        [
            'question' => 'Was sind Sterne, die Wochenserie und Abzeichen?',
            'answer' => 'Das sind die Belohnungen in Premium, und sie gehören zu einem Kinderprofil. Jede abgegebene Übung bringt bis zu 3 Sterne: ab 75 % richtig 2 und ab 90 % 3; der beste Versuch zählt. Wer an 3 Tagen in einer Woche (Montag bis Sonntag) übt, hält die Wochenserie, und es gibt 12 Abzeichen zu verdienen.',
        ],
        [
            'question' => 'Kann ich die Sprache ändern?',
            'answer' => 'Ja, die App ist auf Slowenisch, Englisch, Deutsch, Kroatisch und Bosnisch verfügbar.',
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
            'question' => 'Što se događa kad istekne vrijeme za vježbu?',
            'answer' => 'Vježba se predaje s dotad upisanim odgovorima, a prazni se računaju kao netočni. S paketom Premium ograničenje zadaješ kad izrađuješ vježbu: 3, 5, 10 ili 15 minuta ili bilo koji broj minuta od 1 do 60. Na ispisanom PDF-u vremensko ograničenje ne piše.',
        ],
        [
            'question' => 'Mogu li dodati više djece?',
            'answer' => 'Da. S jednim računom možeš izrađivati vježbe za koliko god djece želiš. S paketom Premium možeš dodati i do 4 dječja profila, pa su rezultati, zvjezdice i značke svakog djeteta odvojeni.',
        ],
        [
            'question' => 'Što su zvjezdice, tjedni niz i značke?',
            'answer' => 'To su nagrade u paketu Premium i pripadaju profilu djeteta. Svaka predana vježba donosi do 3 zvjezdice: uz 75 % točnih 2, a uz 90 % 3; računa se najbolji pokušaj. Vježbanje 3 dana u tjednu (od ponedjeljka do nedjelje) održava tjedni niz, a može se osvojiti 12 znački.',
        ],
        [
            'question' => 'Mogu li promijeniti jezik?',
            'answer' => 'Da, aplikacija je dostupna na slovenskom, engleskom, njemačkom, hrvatskom i bosanskom jeziku.',
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

    /**
     * @var array<int, array{question: string, answer: string, is_visible?: bool}>
     */
    private array $bsFaqs = [
        [
            'question' => 'Je li Numibo stvarno besplatan?',
            'answer' => 'Da. U ranom pristupu sve je besplatno i ne trebaš karticu. Za nove radne listove vrijedi izdašno mjesečno ograničenje.',
        ],
        [
            'question' => 'Šta se događa kad rani pristup završi?',
            'answer' => 'Numibo će postati aplikacija koja se plaća. Na vrijeme ćemo te obavijestiti e-mailom i ništa ti nećemo naplatiti dok ne odabereš paket.',
        ],
        [
            'question' => 'Postoji li besplatni probni period?',
            'answer' => 'Da, prilikom registracije dobijaš 7-dnevni besplatni probni period.',
            'is_visible' => false,
        ],
        [
            'question' => 'Koje su vrste vježbi dostupne?',
            'answer' => 'Sabiranje, oduzimanje, množenje i dijeljenje – uključujući osnovnu tablicu i zadatke po želji.',
        ],
        [
            'question' => 'Šta se događa kad istekne vrijeme za vježbu?',
            'answer' => 'Vježba se predaje s dotad upisanim odgovorima, a prazni se računaju kao netačni. S paketom Premium ograničenje zadaješ kad praviš vježbu: 3, 5, 10 ili 15 minuta ili bilo koji broj minuta od 1 do 60. Na odštampanom PDF-u vremensko ograničenje ne piše.',
        ],
        [
            'question' => 'Mogu li dodati više djece?',
            'answer' => 'Da. S jednim računom možeš praviti vježbe za koliko god djece želiš. S paketom Premium možeš dodati i do 4 dječija profila, pa su rezultati, zvjezdice i značke svakog djeteta odvojeni.',
        ],
        [
            'question' => 'Šta su zvjezdice, sedmični niz i značke?',
            'answer' => 'To su nagrade u paketu Premium i pripadaju profilu djeteta. Svaka predana vježba donosi do 3 zvjezdice: uz 75 % tačnih 2, a uz 90 % 3; računa se najbolji pokušaj. Vježbanje 3 dana u sedmici (od ponedjeljka do nedjelje) održava sedmični niz, a može se osvojiti 12 znački.',
        ],
        [
            'question' => 'Mogu li promijeniti jezik?',
            'answer' => 'Da, aplikacija je dostupna na slovenskom, engleskom, njemačkom, hrvatskom i bosanskom jeziku.',
        ],
        [
            'question' => 'Kako mogu otkazati pretplatu?',
            'answer' => 'Pretplatu možeš otkazati u bilo kojem trenutku u postavkama računa; pristup ostaje do kraja obračunskog perioda.',
            'is_visible' => false,
        ],
        [
            'question' => 'Mogu li odštampati vježbe?',
            'answer' => 'Da, svaki skup vježbi možeš izvesti i odštampati kao PDF.',
        ],
    ];

    public function run(): void
    {
        $languages = [
            'sl' => $this->slFaqs,
            'en' => $this->enFaqs,
            'de' => $this->deFaqs,
            'hr' => $this->hrFaqs,
            'bs' => $this->bsFaqs,
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
