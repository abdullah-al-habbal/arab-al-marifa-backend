<?php
declare(strict_types=1);

namespace Modules\Unit\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
                ->maxLength(255),
            Select::make('subject_id')
                ->label(__('app.subject_id'))
                ->relationship('subject', 'name')
                ->nullable(),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
        ]);
    }
}
