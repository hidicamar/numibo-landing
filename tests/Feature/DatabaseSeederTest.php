<?php

use App\Models\PostCategory;
use Database\Seeders\DatabaseSeeder;

it('seeds post categories with generated slugs', function () {
    // Regression: DatabaseSeeder previously used WithoutModelEvents, which muted
    // the HasSlug creating/updating events — slugs stayed empty and MySQL's
    // strict mode rejected the inserts.
    $this->seed(DatabaseSeeder::class);

    expect(PostCategory::withoutGlobalScopes()->count())->toBe(20)
        ->and(PostCategory::withoutGlobalScopes()->where(fn ($query) => $query->whereNull('slug')->orWhere('slug', ''))->count())->toBe(0);
});
