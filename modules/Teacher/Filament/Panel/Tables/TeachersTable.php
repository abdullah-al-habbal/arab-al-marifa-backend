<?php
declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('app.user_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('specialization')
                    ->label(__('app.specialization'))
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
