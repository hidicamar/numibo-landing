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
                'title' => 'Numibo – hitro in učinkovito učenje matematike!',
                'description' => 'Seštevanje, odštevanje, množenje, deljenje – z Numibo vadi matematiko, vse na enem mestu za učinkovito učenje!',
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
                'title' => 'Numibo – Fast and Efficient Math Learning!',
                'description' => 'Addition, subtraction, multiplication, division – practice math with Numibo, all in one place for effective learning!',
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
                'title' => 'Numibo – Mathe schnell und effizient lernen!',
                'description' => 'Addition, Subtraktion, Multiplikation, Division – übe Mathe mit Numibo, alles an einem Ort für effektives Lernen!',
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
    private array $hrPages = [
        [
            'name' => 'Početna',
            'type' => 'home',
            'seo' => [
                'title' => 'Numibo - brzo i učinkovito učenje matematike!',
                'description' => 'Zbrajanje, oduzimanje, množenje, dijeljenje - vježbaj matematiku uz Numibo, sve na jednom mjestu za učinkovito učenje!',
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
            'name' => 'Politika privatnosti',
            'type' => 'privacy-policy',
            'seo' => [
                'title' => 'Politika privatnosti',
                'description' => '',
            ],
        ],
        [
            'name' => 'Uvjeti korištenja',
            'type' => 'terms-and-conditions',
            'seo' => [
                'title' => 'Uvjeti korištenja',
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
            'hr' => $this->hrPages,
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
