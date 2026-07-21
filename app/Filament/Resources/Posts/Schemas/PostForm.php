<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\LanguageSelect;
use App\Models\Scopes\LanguageScope;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('post-cover')
                                    ->label(__('Cover image'))
                                    ->collection('post-cover')
                                    ->nullable()
                                    ->automaticallyResizeImagesToWidth('1200')
                                    ->automaticallyResizeImagesToHeight('800')
                                    ->maxSize(4000)
                                    ->maxFiles(1)
                                    ->downloadable()
                                    ->openable()
                                    ->columnSpanFull(),

                                TextInput::make('title')
                                    ->required()
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('seo.title', $state))
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                TextInput::make('subtitle')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Textarea::make('summary')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                RichEditor::make('content')
                                    ->required()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('posts')
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
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(7),

                        Grid::make()
                            ->schema([
                                Section::make('Organisation')
                                    ->collapsible()
                                    ->schema([
                                        LanguageSelect::make('lang')
                                            ->columnSpanFull(),

                                        Select::make('post_category_id')
                                            ->relationship(
                                                name: 'category',
                                                titleAttribute: 'name',
                                                // The panel manages every locale, so the
                                                // select must offer categories beyond the
                                                // current one.
                                                modifyQueryUsing: fn (Builder $query) => $query->withoutGlobalScope(LanguageScope::class),
                                            )
                                            ->required()
                                            ->preload()
                                            ->columnSpanFull(),

                                        DateTimePicker::make('published_at')
                                            ->label('Publish date')
                                            ->helperText('Post will be visible at selected date. Posts are ordered by publish date.')
                                            ->native(false)
                                            ->displayFormat('d.m.Y H:i')
                                            ->seconds(false)
                                            ->default(now())
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('SEO')
                                    ->collapsible()
                                    ->relationship('seo')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->hint(fn ($state, $component) => 'left: '.$component->getMaxLength() - mb_strlen($state ?? '').' characters')
                                            ->lazy()
                                            ->maxLength(100)
                                            ->columnSpanFull(),

                                        Textarea::make('description')
                                            ->required()
                                            ->hint(fn ($state, $component) => 'left: '.$component->getMaxLength() - mb_strlen($state ?? '').' characters')
                                            ->lazy()
                                            ->maxLength(160)
                                            ->columnSpanFull(),

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
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(5),
                    ])->columnSpanFull(),
            ]);
    }
}
