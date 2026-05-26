<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('subject_category_id')
                ->label(__('app.subject_category_id'))
                ->relationship('subjectCategory', 'name')
                ->required(),
            Select::make('teacher_id')
                ->label(__('app.teacher_id'))
                ->relationship('teacher', 'id')
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? (string) $record->id)
                ->nullable(),
            TextInput::make('title')
                ->label(__('app.title'))
                ->required()
                ->maxLength(255),
            RichEditor::make('description')
                ->label(__('app.description')),
            TextInput::make('unit_tag')
                ->label(__('app.unit_tag'))
                ->maxLength(255),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
            Toggle::make('is_published')
                ->label(__('app.is_published'))
                ->default(false),
        ]);
    }
}
