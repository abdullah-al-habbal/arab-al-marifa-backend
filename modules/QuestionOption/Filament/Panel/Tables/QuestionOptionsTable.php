<?php
declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuestionOptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question.body')
                    ->label(__('app.question_id'))
                    ->limit(50)
                    ->sortable(),
                TextColumn::make('body')
                    ->label(__('app.body'))
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('app.sort_order'))
                    ->sortable(),
                IconColumn::make('is_correct')
                    ->label(__('app.is_correct'))
                    ->boolean()
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
