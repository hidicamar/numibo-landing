<?php

namespace App\Filament\Resources\Faqs\Schemas;

use App\Filament\Forms\Components\LanguageSelect;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('is_visible')
                    ->required(),
                TextInput::make('question')
                    ->required(),
                Textarea::make('answer')
                    ->required()
                    ->columnSpanFull(),
                LanguageSelect::make('lang'),
                TextInput::make('sort')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
