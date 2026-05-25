<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\LessonAttachment\Models\LessonAttachment;

final class LessonAttachmentResource extends Resource
{
    protected static ?string $model = LessonAttachment::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('lesson_id')
                    ->relationship('lesson', 'title')
                    ->required(),
                TextInput::make('storage_path')
                    ->required()
                    ->maxLength(255),
                TextInput::make('original_filename')
                    ->required()
                    ->maxLength(255),
                TextInput::make('file_size_bytes')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label('Lesson'),
                TextColumn::make('original_filename')
                    ->searchable(),
                TextColumn::make('storage_path'),
                TextColumn::make('file_size_bytes')
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB'),
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
            'index' => ListLessonAttachments::route('/'),
            'create' => CreateLessonAttachment::route('/create'),
            'edit' => EditLessonAttachment::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListLessonAttachments extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LessonAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateLessonAttachment extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}

final class EditLessonAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
