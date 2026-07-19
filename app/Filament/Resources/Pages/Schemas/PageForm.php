<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->state(fn (Page $record): string => $record->name),

                RichEditor::make('content')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('pages')
                    ->toolbarButtons([
                        'attachFiles',
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'underline',
                        'undo',
                    ])
                    ->visible(fn (Get $get): bool => in_array($get('type'), ['privacy-policy', 'terms-and-conditions', 'cookies']))
                    ->columnSpan('full'),

                Fieldset::make('SEO')
                    ->relationship('seo')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->hint(fn ($state, $component) => 'left: '.$component->getMaxLength() - mb_strlen($state).' characters')
                            ->lazy()
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->columnSpanFull(),

                        /*
                        TagsInput::make('keywords')
                            ->nullable()
                            ->separator(',')
                            ->columnSpanFull(),
                        */

                        SpatieMediaLibraryFileUpload::make('seo-cover')
                            ->label(__('Image'))
                            ->collection('seo-cover')
                            ->nullable()
                            ->automaticallyResizeImagesToWidth('1200')
                            ->automaticallyResizeImagesToHeight('630')
                            ->maxSize(4000)
                            ->maxFiles(1)
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

            ]);
    }
}
