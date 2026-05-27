<?php
declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('app.user_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_of_birth')
                    ->label(__('app.date_of_birth'))
                    ->date()
                    ->sortable(),
                TextColumn::make('guardian_phone')
                    ->label(__('app.guardian_phone'))
                    ->searchable(),
                TextColumn::make('registration_number')
                    ->label(__('app.registration_number'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('app.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
