<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('sub_stage_id')
                ->label(__('app.sub_stage_id'))
                ->relationship('subStage', 'name')
                ->required(),
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
                ->maxLength(255),
            TextInput::make('academic_year')
                ->label(__('app.academic_year'))
                ->maxLength(255),
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
