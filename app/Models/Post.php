<?php

namespace App\Models;

use App\Models\Scopes\LanguageScope;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[ScopedBy(LanguageScope::class)]
class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'post_category_id',
        'title',
        'subtitle',
        'summary',
        'content',
        'lang',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'model');
    }

    public function seoTitle(): Attribute
    {
        $seoTitle = $this->seo && $this->seo->title
            ? $this->seo->title
            : $this->title.' | '.config('app.short_url');

        return Attribute::make(
            get: fn () => $seoTitle,
        );
    }

    public function seoDescription(): Attribute
    {
        $seoDescription = null;

        if ($this->seo?->description) {
            $seoDescription = $this->seo->description;
        } elseif ($this->summary) {
            $seoDescription = $this->summary;
        } elseif ($this->content) {
            $seoDescription = Str::limit(
                preg_replace('/\s+/', ' ', strip_tags(str_replace('\n', '', $this->content))),
                160
            );
        }

        return Attribute::make(
            get: fn () => $seoDescription
        );
    }

    /**
     * Scope a query to only include published posts.
     */
    #[Scope]
    public function published(Builder $query): void
    {
        $query->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include unpublished posts (drafts).
     */
    #[Scope]
    public function unpublished(Builder $query): void
    {
        $query->where('published_at', '>', now());
    }

    /**
     * Get post read time.
     */
    protected function readTime(): Attribute
    {
        return Attribute::make(
            get: fn () => (int) max(1, ceil($this->word_count / 200)),
        );
    }

    /**
     * Get post word count.
     */
    protected function wordCount(): Attribute
    {
        return Attribute::make(
            get: fn () => str(strip_tags($this->content))->wordCount()
        );
    }

    public function calculateReadTimes(): void
    {
        $this->word_count = str(strip_tags($this->content))->wordCount();
        $this->readTime = (int) max(1, ceil($this->word_count / 200));
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post-cover')->singleFile();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
