<?php
declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LessonAttachmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('lesson_id')
                ->label(__('app.lesson_id'))
                ->relationship('lesson', 'title')
                ->required(),
            TextInput::make('storage_path')
                ->label(__('app.storage_path'))
                ->required()
                ->maxLength(255),
            TextInput::make('original_filename')
                ->label(__('app.original_filename'))
                ->required()
                ->maxLength(255),
            TextInput::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->numeric()
                ->required(),
        ]);
    }
}
