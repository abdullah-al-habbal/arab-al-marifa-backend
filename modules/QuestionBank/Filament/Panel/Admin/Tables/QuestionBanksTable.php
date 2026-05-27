<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class QuestionBanksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject.name')
                    ->label(__('app.subject_name'))
                    ->sortable(),
                TextColumn::make('lesson.title')
                    ->label(__('app.lesson_title'))
                    ->sortable(),
                TextColumn::make('unit_tag')
                    ->label(__('app.unit_tag'))
                    ->sortable(),
                TextColumn::make('stem')
                    ->label(__('app.stem'))
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('question_type')
                    ->label(__('app.question_type'))
                    ->sortable(),
                TextColumn::make('difficulty')
                    ->label(__('app.difficulty'))
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label(__('app.is_active')),
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
