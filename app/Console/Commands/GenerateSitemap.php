<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

#[Signature('sitemap:generate')]
#[Description('Generate public/sitemap.xml with all localized public pages and published posts')]
class GenerateSitemap extends Command
{
    /**
     * Route names of the static public pages included in the sitemap.
     *
     * @var list<string>
     */
    private array $staticRoutes = [
        'home',
        'pricing',
        'posts.index',
        'legal.privacy-policy',
        'legal.terms-and-conditions',
        'legal.cookies',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sitemap = Sitemap::create();

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            foreach ($this->staticRoutes as $routeName) {
                $sitemap->add(Url::create(LaravelLocalization::getLocalizedURL($locale, route($routeName))));
            }

            Post::withoutGlobalScopes()
                ->where('lang', $locale)
                ->published()
                ->get()
                ->each(fn (Post $post) => $sitemap->add(
                    Url::create(LaravelLocalization::getLocalizedURL($locale, route('posts.show', $post->slug)))
                        ->setLastModificationDate($post->updated_at),
                ));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap written to public/sitemap.xml.');

        return self::SUCCESS;
    }
}
