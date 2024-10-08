<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Builder::make('content')
                    ->blocks([
                        Forms\Components\Builder\Block::make('heading')
                            ->icon('heroicon-m-hashtag')
                            ->schema([
                                Forms\Components\TextInput::make('content')
                                    ->label('Heading')
                                    ->required(),
                                Forms\Components\Select::make('level')
                                    ->options([
                                        'h1' => 'Heading 1',
                                        'h2' => 'Heading 2',
                                        'h3' => 'Heading 3',
                                        'h4' => 'Heading 4',
                                        'h5' => 'Heading 5',
                                        'h6' => 'Heading 6',
                                    ])
                                    ->required(),
                            ])
                            ->label(function (?array $state): string {
                                if ($state === null) {
                                    return 'Heading';
                                }

                                return $state['content'] ?? 'Untitled heading';
                            })
                            ->columns(2),
                        Forms\Components\Builder\Block::make('paragraph')
                            ->icon('heroicon-m-bars-3-bottom-left')
                            ->schema([
                                Forms\Components\Textarea::make('content')
                                    ->label('Paragraph')
                                    ->required(),
                            ])
                            ->label(function (?array $state): string {
                                if ($state === null) {
                                    return 'Heading';
                                }

                                return $state['content'] ?? 'Untitled heading';
                            }),
                        Forms\Components\Builder\Block::make('image')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('url')
                                    ->label('Image')
                                    ->image()
                                    ->required(),
                                Forms\Components\TextInput::make('alt')
                                    ->label('Alt text')
                                    ->required(),
                            ]),
                    ])
                    ->collapsed(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
