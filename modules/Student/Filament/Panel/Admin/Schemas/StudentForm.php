<?php
declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('user_id')
                ->label(__('app.user_id'))
                ->relationship('user', 'name')
                ->required(),
            DatePicker::make('date_of_birth')
                ->label(__('app.date_of_birth')),
            TextInput::make('guardian_phone')
                ->label(__('app.guardian_phone'))
                ->maxLength(255),
            TextInput::make('address')
                ->label(__('app.address'))
                ->maxLength(255),
            TextInput::make('registration_number')
                ->label(__('app.registration_number'))
                ->unique(ignoreRecord: true)
                ->maxLength(255),
        ]);
    }
}
