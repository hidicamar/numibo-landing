<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\LanguageSelect;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('post_category_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('subtitle'),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('popularity')
                    ->required()
                    ->numeric()
                    ->default(0),
                LanguageSelect::make('lang'),
                DateTimePicker::make('published_at')
                    ->required(),
            ]);
    }
}
