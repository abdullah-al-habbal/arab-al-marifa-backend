<?php
declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubjectCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('subject_id')
                ->label(__('app.subject_id'))
                ->relationship('subject', 'name')
                ->required(),
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
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
