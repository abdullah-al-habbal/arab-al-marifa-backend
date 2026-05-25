<?php

declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel;

use Filament\Forms\Components\RichEditor;
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
use Modules\Lesson\Models\Lesson;

final class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('subject_category_id')
                    ->relationship('subjectCategory', 'name')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? (string) $record->id)
                    ->nullable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('description'),
                TextInput::make('unit_tag')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
                Toggle::make('is_published')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('subjectCategory.name')
                    ->label('Subject Category'),
                TextColumn::make('teacher_id')
                    ->label('Teacher'),
                TextColumn::make('sort_order'),
                ToggleColumn::make('is_published'),
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
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListLessons extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateLesson extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonResource::class;
}

final class EditLesson extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LessonResource::class;
}
