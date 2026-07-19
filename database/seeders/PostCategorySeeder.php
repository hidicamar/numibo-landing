<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * @var array<int, string>
     */
    private array $slCategories = [
        'Matematika',
        'Izobraževanje',
        'Vodiči',
        'Nasveti in triki',
        'Novice',
    ];

    /**
     * @var array<int, string>
     */
    private array $enCategories = [
        'Mathematics',
        'Education',
        'Tutorials',
        'Tips & Tricks',
        'News',
    ];

    /**
     * @var array<int, string>
     */
    private array $deCategories = [
        'Mathematik',
        'Bildung',
        'Tutorials',
        'Tipps & Tricks',
        'Nachrichten',
    ];

    /**
     * @var array<int, string>
     */
    private array $bsCategories = [
        'Matematika',
        'Obrazovanje',
        'Tutorijali',
        'Savjeti i Trikovi',
        'Vijesti',
    ];

    public function run(): void
    {
        $languages = [
            'sl' => $this->slCategories,
            'en' => $this->enCategories,
            'de' => $this->deCategories,
            'bs' => $this->bsCategories,
        ];

        foreach ($languages as $lang => $categories) {
            foreach ($categories as $name) {
                PostCategory::withoutGlobalScopes()->updateOrCreate(
                    ['name' => $name, 'lang' => $lang],
                    [],
                );
            }
        }
    }
}
