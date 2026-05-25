<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel;

use Filament\Forms\Components\Select;
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
use Modules\LibraryItem\Models\LibraryItem;

final class LibraryItemResource extends Resource
{
    protected static ?string $model = LibraryItem::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('item_type')
                    ->options([
                        'government_book' => 'Government Book',
                        'study_notes' => 'Study Notes',
                        'lesson_attachment' => 'Lesson Attachment',
                    ])
                    ->required(),
                TextInput::make('storage_path')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mime_type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('file_size_bytes')
                    ->integer()
                    ->required(),
                Select::make('classifiable_type')
                    ->options([
                        'Modules\EducationalStage\Models\EducationalStage' => 'Educational Stage',
                        'Modules\EducationalSubStage\Models\EducationalSubStage' => 'Educational Sub Stage',
                        'Modules\CourseType\Models\CourseType' => 'Course Type',
                        'Modules\Subject\Models\Subject' => 'Subject',
                        'Modules\Lesson\Models\Lesson' => 'Lesson',
                    ])
                    ->required(),
                TextInput::make('classifiable_id')
                    ->numeric()
                    ->required(),
                Toggle::make('is_downloadable')
                    ->default(false),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('item_type'),
                TextColumn::make('classifiable_type'),
                TextColumn::make('classifiable_id'),
                ToggleColumn::make('is_downloadable'),
                ToggleColumn::make('is_active'),
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
            'index' => ListLibraryItems::route('/'),
            'create' => CreateLibraryItem::route('/create'),
            'edit' => EditLibraryItem::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListLibraryItems extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LibraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateLibraryItem extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LibraryItemResource::class;
}

final class EditLibraryItem extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LibraryItemResource::class;
}
