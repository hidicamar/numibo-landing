<?php

namespace App\Models;

use App\Models\Scopes\LanguageScope;
use App\Models\Scopes\OrderBySortScope;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(LanguageScope::class)]
#[ScopedBy(OrderBySortScope::class)]
class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'is_visible',
        'question',
        'answer',
        'lang',
        'sort',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
        'sort' => 'integer',
    ];

    /**
     * Scope a query to only include visible faqs.
     */
    #[Scope]
    public function visible(Builder $query): void
    {
        $query->where('is_visible', true);
    }

    /**
     * Scope a query to only include hidden faqs.
     */
    #[Scope]
    public function hidden(Builder $query): void
    {
        $query->where('is_visible', false);
    }
}
