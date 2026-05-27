<?php
declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class StaticPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label(__('app.slug'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label(__('app.title'))
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_published')
                    ->label(__('app.is_published')),
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
