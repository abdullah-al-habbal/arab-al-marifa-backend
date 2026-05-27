<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class LibraryItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('app.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item_type')
                    ->label(__('app.item_type'))
                    ->sortable(),
                TextColumn::make('classifiable_type')
                    ->label(__('app.classifiable_type')),
                TextColumn::make('classifiable_id')
                    ->label(__('app.classifiable_id')),
                ToggleColumn::make('is_downloadable')
                    ->label(__('app.is_downloadable')),
                ToggleColumn::make('is_active')
                    ->label(__('app.is_active')),
                TextColumn::make('sort_order')
                    ->label(__('app.sort_order'))
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
