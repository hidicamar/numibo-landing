<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    /**
     * Page types whose content is seeded from database/seeders/content/legal.
     *
     * @var list<string>
     */
    private array $legalTypes = ['privacy-policy', 'terms-and-conditions', 'cookies'];

    /**
     * @var array<int, array{name: string, type: string, seo: array{title: string, description: string, keywords?: array<int, string>}}>
     */
    private array $slPages = [
        [
            'name' => 'Domov',
            'type' => 'home',
            'seo' => [
                'title' => 'Matematične vaje – hitro in učinkovito učenje!',
                'description' => 'Seštevanje, odštevanje, množenje, deljenje – vse na enem mestu za učinkovito učenje!',
            ],
        ],
        [
            'name' => 'Vaje',
            'type' => 'exercises.index',
            'seo' => [
                'title' => 'Vaje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Reševanje vaje',
            'type' => 'exercises.solve',
            'seo' => [
                'title' => 'Reševanje vaje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Seštevanje in odštevanje',
            'type' => 'addition-and-subtraction.index',
            'seo' => [
                'title' => 'Seštevanje in odštevanje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Množenje in deljenje',
            'type' => 'multiplication-and-division.index',
            'seo' => [
                'title' => 'Množenje in deljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Osnovna tabela – Množenje in deljenje',
            'type' => 'multiplication-and-division.base-table',
            'seo' => [
                'title' => 'Osnovna tabela – Množenje in deljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Naloge po meri – Množenje in deljenje',
            'type' => 'multiplication-and-division.custom-equations',
            'seo' => [
                'title' => 'Naloge po meri – Množenje in deljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Blog',
            'type' => 'posts.index',
            'seo' => [
                'title' => 'Blog',
                'description' => '',
            ],
        ],
        [
            'name' => 'Prijava',
            'type' => 'login',
            'seo' => [
                'title' => 'Prijava',
                'description' => 'Prijavite se v svoj račun in nadaljujte z vajami.',
            ],
        ],
        [
            'name' => 'Registracija',
            'type' => 'register',
            'seo' => [
                'title' => 'Registracija',
                'description' => 'Ustvarite brezplačen račun in začnite z vajami.',
            ],
        ],
        [
            'name' => 'Politika zasebnosti',
            'type' => 'privacy-policy',
            'seo' => [
                'title' => 'Politika zasebnosti',
                'description' => '',
            ],
        ],
        [
            'name' => 'Pogoji uporabe',
            'type' => 'terms-and-conditions',
            'seo' => [
                'title' => 'Pogoji uporabe',
                'description' => '',
            ],
        ],
        [
            'name' => 'Piškotki',
            'type' => 'cookies',
            'seo' => [
                'title' => 'Piškotki',
                'description' => '',
            ],
        ],
    ];

    /**
     * @var array<int, array{name: string, type: string, seo: array{title: string, description: string, keywords?: array<int, string>}}>
     */
    private array $enPages = [
        [
            'name' => 'Home',
            'type' => 'home',
            'seo' => [
                'title' => 'Math Exercises – Fast and Efficient Learning!',
                'description' => 'Addition, subtraction, multiplication, division – all in one place for effective learning!',
            ],
        ],
        [
            'name' => 'Exercises',
            'type' => 'exercises.index',
            'seo' => [
                'title' => 'Exercises',
                'description' => '',
            ],
        ],
        [
            'name' => 'Solve exercise',
            'type' => 'exercises.solve',
            'seo' => [
                'title' => 'Solve exercise',
                'description' => '',
            ],
        ],
        [
            'name' => 'Addition and Subtraction',
            'type' => 'addition-and-subtraction.index',
            'seo' => [
                'title' => 'Addition and Subtraction',
                'description' => '',
            ],
        ],
        [
            'name' => 'Multiplication and Division',
            'type' => 'multiplication-and-division.index',
            'seo' => [
                'title' => 'Multiplication and Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Base Table – Multiplication and Division',
            'type' => 'multiplication-and-division.base-table',
            'seo' => [
                'title' => 'Base Table – Multiplication and Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Custom Exercises – Multiplication and Division',
            'type' => 'multiplication-and-division.custom-equations',
            'seo' => [
                'title' => 'Custom Exercises – Multiplication and Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Blog',
            'type' => 'posts.index',
            'seo' => [
                'title' => 'Blog',
                'description' => '',
            ],
        ],
        [
            'name' => 'Login',
            'type' => 'login',
            'seo' => [
                'title' => 'Login',
                'description' => 'Sign in to your account and continue practicing.',
            ],
        ],
        [
            'name' => 'Register',
            'type' => 'register',
            'seo' => [
                'title' => 'Register',
                'description' => 'Create a free account and start practicing.',
            ],
        ],
        [
            'name' => 'Privacy Policy',
            'type' => 'privacy-policy',
            'seo' => [
                'title' => 'Privacy Policy',
                'description' => '',
            ],
        ],
        [
            'name' => 'Terms and Conditions',
            'type' => 'terms-and-conditions',
            'seo' => [
                'title' => 'Terms and Conditions',
                'description' => '',
            ],
        ],
        [
            'name' => 'Cookies',
            'type' => 'cookies',
            'seo' => [
                'title' => 'Cookies',
                'description' => '',
            ],
        ],
    ];

    /**
     * @var array<int, array{name: string, type: string, seo: array{title: string, description: string, keywords?: array<int, string>}}>
     */
    private array $dePages = [
        [
            'name' => 'Startseite',
            'type' => 'home',
            'seo' => [
                'title' => 'Matheübungen – Schnell und effizient lernen!',
                'description' => 'Addition, Subtraktion, Multiplikation, Division – alles an einem Ort für effektives Lernen!',
            ],
        ],
        [
            'name' => 'Übungen',
            'type' => 'exercises.index',
            'seo' => [
                'title' => 'Übungen',
                'description' => '',
            ],
        ],
        [
            'name' => 'Übung lösen',
            'type' => 'exercises.solve',
            'seo' => [
                'title' => 'Übung lösen',
                'description' => '',
            ],
        ],
        [
            'name' => 'Addition und Subtraktion',
            'type' => 'addition-and-subtraction.index',
            'seo' => [
                'title' => 'Addition und Subtraktion',
                'description' => '',
            ],
        ],
        [
            'name' => 'Multiplikation und Division',
            'type' => 'multiplication-and-division.index',
            'seo' => [
                'title' => 'Multiplikation und Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Grundtabelle – Multiplikation und Division',
            'type' => 'multiplication-and-division.base-table',
            'seo' => [
                'title' => 'Grundtabelle – Multiplikation und Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Benutzerdefinierte Aufgaben – Multiplikation und Division',
            'type' => 'multiplication-and-division.custom-equations',
            'seo' => [
                'title' => 'Benutzerdefinierte Aufgaben – Multiplikation und Division',
                'description' => '',
            ],
        ],
        [
            'name' => 'Blog',
            'type' => 'posts.index',
            'seo' => [
                'title' => 'Blog',
                'description' => '',
            ],
        ],
        [
            'name' => 'Anmelden',
            'type' => 'login',
            'seo' => [
                'title' => 'Anmelden',
                'description' => 'Melden Sie sich an und üben Sie weiter.',
            ],
        ],
        [
            'name' => 'Registrieren',
            'type' => 'register',
            'seo' => [
                'title' => 'Registrieren',
                'description' => 'Erstellen Sie ein kostenloses Konto und beginnen Sie mit dem Üben.',
            ],
        ],
        [
            'name' => 'Datenschutzerklärung',
            'type' => 'privacy-policy',
            'seo' => [
                'title' => 'Datenschutzerklärung',
                'description' => '',
            ],
        ],
        [
            'name' => 'Nutzungsbedingungen',
            'type' => 'terms-and-conditions',
            'seo' => [
                'title' => 'Nutzungsbedingungen',
                'description' => '',
            ],
        ],
        [
            'name' => 'Cookies',
            'type' => 'cookies',
            'seo' => [
                'title' => 'Cookies',
                'description' => '',
            ],
        ],
    ];

    /**
     * @var array<int, array{name: string, type: string, seo: array{title: string, description: string, keywords?: array<int, string>}}>
     */
    private array $bsPages = [
        [
            'name' => 'Početna',
            'type' => 'home',
            'seo' => [
                'title' => 'Matematičke vježbe - brzo i efikasno učenje!',
                'description' => 'Sabiranje, oduzimanje, množenje, dijeljenje - sve na jednom mjestu za efikasno učenje!',
            ],
        ],
        [
            'name' => 'Vježbe',
            'type' => 'exercises.index',
            'seo' => [
                'title' => 'Vježbe',
                'description' => '',
            ],
        ],
        [
            'name' => 'Rješavanje vježbe',
            'type' => 'exercises.solve',
            'seo' => [
                'title' => 'Rješavanje vježbe',
                'description' => '',
            ],
        ],
        [
            'name' => 'Sabiranje i oduzimanje',
            'type' => 'addition-and-subtraction.index',
            'seo' => [
                'title' => 'Sabiranje i oduzimanje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Množenje i dijeljenje',
            'type' => 'multiplication-and-division.index',
            'seo' => [
                'title' => 'Množenje i dijeljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Osnovna tablica – Množenje i dijeljenje',
            'type' => 'multiplication-and-division.base-table',
            'seo' => [
                'title' => 'Osnovna tablica – Množenje i dijeljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Zadaci po želji – Množenje i dijeljenje',
            'type' => 'multiplication-and-division.custom-equations',
            'seo' => [
                'title' => 'Zadaci po želji – Množenje i dijeljenje',
                'description' => '',
            ],
        ],
        [
            'name' => 'Blog',
            'type' => 'posts.index',
            'seo' => [
                'title' => 'Blog',
                'description' => '',
            ],
        ],
        [
            'name' => 'Prijava',
            'type' => 'login',
            'seo' => [
                'title' => 'Prijava',
                'description' => 'Prijavite se na svoj račun i nastavite s vježbanjem.',
            ],
        ],
        [
            'name' => 'Registracija',
            'type' => 'register',
            'seo' => [
                'title' => 'Registracija',
                'description' => 'Kreirajte besplatan račun i počnite s vježbanjem.',
            ],
        ],
        [
            'name' => 'Politika privatnosti',
            'type' => 'privacy-policy',
            'seo' => [
                'title' => 'Politika privatnosti',
                'description' => '',
            ],
        ],
        [
            'name' => 'Uslovi korištenja',
            'type' => 'terms-and-conditions',
            'seo' => [
                'title' => 'Uslovi korištenja',
                'description' => '',
            ],
        ],
        [
            'name' => 'Kolačići',
            'type' => 'cookies',
            'seo' => [
                'title' => 'Kolačići',
                'description' => '',
            ],
        ],
    ];

    public function run(): void
    {
        $languages = [
            'sl' => $this->slPages,
            'en' => $this->enPages,
            'de' => $this->dePages,
            'bs' => $this->bsPages,
        ];

        foreach ($languages as $lang => $pages) {
            foreach ($pages as $page) {
                $pageModel = Page::withoutGlobalScopes()->updateOrCreate(
                    ['lang' => $lang, 'type' => $page['type']],
                    ['name' => $page['name']],
                );

                if (in_array($page['type'], $this->legalTypes) && blank($pageModel->content)) {
                    $pageModel->update([
                        'content' => File::get(database_path("seeders/content/legal/{$page['type']}.{$lang}.html")),
                    ]);
                }

                $pageModel->seo()->updateOrCreate(
                    ['model_type' => $pageModel->getMorphClass(), 'model_id' => $pageModel->id],
                    [
                        'title' => $page['seo']['title'].' | '.config('app.short_url'),
                        'description' => $page['seo']['description'],
                        'keywords' => $page['seo']['keywords'] ?? [],
                    ],
                );
            }
        }
    }
}
