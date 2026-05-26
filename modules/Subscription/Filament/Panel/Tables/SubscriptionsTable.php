<?php
declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.id')
                    ->label(__('app.student_id'))
                    ->sortable(),
                TextColumn::make('subscribable_type')
                    ->label(__('app.subscribable_type')),
                TextColumn::make('subscribable_id')
                    ->label(__('app.subscribable_id')),
                TextColumn::make('status')
                    ->label(__('app.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('activated_at')
                    ->label(__('app.activated_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label(__('app.expires_at'))
                    ->dateTime()
                    ->sortable(),
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
