<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('post_category_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('subtitle')
                    ->placeholder('-'),
                TextEntry::make('summary')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->columnSpanFull(),
                TextEntry::make('popularity')
                    ->numeric(),
                TextEntry::make('lang'),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
