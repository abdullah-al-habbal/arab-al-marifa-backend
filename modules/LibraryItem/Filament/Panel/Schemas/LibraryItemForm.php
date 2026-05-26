<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LibraryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label(__('app.title'))
                ->required()
                ->maxLength(255),
            Select::make('item_type')
                ->label(__('app.item_type'))
                ->options([
                    'government_book' => __('app.government_book'),
                    'study_notes' => __('app.study_notes'),
                    'lesson_attachment' => __('app.lesson_attachment'),
                ])
                ->required(),
            TextInput::make('storage_path')
                ->label(__('app.storage_path'))
                ->required()
                ->maxLength(255),
            TextInput::make('mime_type')
                ->label(__('app.mime_type'))
                ->required()
                ->maxLength(255),
            TextInput::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->integer()
                ->required(),
            Select::make('classifiable_type')
                ->label(__('app.classifiable_type'))
                ->options([
                    'Modules\EducationalStage\Models\EducationalStage' => __('app.educational_stage'),
                    'Modules\EducationalSubStage\Models\EducationalSubStage' => __('app.educational_sub_stage'),
                    'Modules\CourseType\Models\CourseType' => __('app.course_type'),
                    'Modules\Subject\Models\Subject' => __('app.subject'),
                    'Modules\Lesson\Models\Lesson' => __('app.lesson'),
                ])
                ->required(),
            TextInput::make('classifiable_id')
                ->label(__('app.classifiable_id'))
                ->numeric()
                ->required(),
            Toggle::make('is_downloadable')
                ->label(__('app.is_downloadable'))
                ->default(false),
            Toggle::make('is_active')
                ->label(__('app.is_active'))
                ->default(true),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
        ]);
    }
}
