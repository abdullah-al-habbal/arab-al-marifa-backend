<?php
declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('app.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject.name')
                    ->label(__('app.subject_name'))
                    ->sortable(),
                TextColumn::make('question_count')
                    ->label(__('app.question_count'))
                    ->sortable(),
                TextColumn::make('passing_score_percent')
                    ->label(__('app.passing_score_percent'))
                    ->sortable(),
                TextColumn::make('time_limit_minutes')
                    ->label(__('app.time_limit_minutes'))
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
