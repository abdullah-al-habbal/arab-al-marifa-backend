<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EducationalStageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            RichEditor::make('description')
                ->label(__('app.description')),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->numeric()
                ->default(0),
            Toggle::make('is_active')
                ->label(__('app.is_active'))
                ->default(true),
        ]);
    }
}
