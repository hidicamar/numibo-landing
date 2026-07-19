<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageSelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->options(static::localeOptions())
            ->default(app()->getLocale())
            ->native(false)
            ->searchable()
            ->required();
    }

    /**
     * Enabled locales as [short key => native name], ordered by `localesOrder`.
     *
     * @return array<string, string>
     */
    public static function localeOptions(): array
    {
        return collect(LaravelLocalization::getLocalesOrder())
            ->mapWithKeys(fn (array $properties, string $key): array => [
                $key => $properties['name'],
            ])
            ->all();
    }
}
