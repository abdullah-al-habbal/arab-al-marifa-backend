<?php

declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Modules\StaticPage\Models\StaticPage;

final class StaticPageResource extends Resource
{
    protected static ?string $model = StaticPage::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('content'),
                Toggle::make('is_published')
                    ->default(false),
                TextInput::make('meta_title')
                    ->maxLength(255),
                TextInput::make('meta_description')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                ToggleColumn::make('is_published'),
                TextColumn::make('sort_order'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStaticPages::route('/'),
            'create' => CreateStaticPage::route('/create'),
            'edit' => EditStaticPage::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListStaticPages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = StaticPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateStaticPage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = StaticPageResource::class;
}

final class EditStaticPage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = StaticPageResource::class;
}
