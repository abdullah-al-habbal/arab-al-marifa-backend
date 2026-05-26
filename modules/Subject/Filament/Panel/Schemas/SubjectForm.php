<?php
declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('course_type_id')
                ->label(__('app.course_type_id'))
                ->relationship('courseType', 'name')
                ->required(),
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
                ->maxLength(255),
            RichEditor::make('description')
                ->label(__('app.description')),
            TextInput::make('cover_image_path')
                ->label(__('app.cover_image_path'))
                ->maxLength(255),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
            Toggle::make('is_active')
                ->label(__('app.is_active'))
                ->default(true),
        ]);
    }
}
