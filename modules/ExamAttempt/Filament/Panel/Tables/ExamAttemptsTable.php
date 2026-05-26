<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamAttemptsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exam.title')
                    ->label(__('app.exam_id'))
                    ->sortable(),
                TextColumn::make('student.id')
                    ->label(__('app.student_id'))
                    ->sortable(),
                TextColumn::make('started_at')
                    ->label(__('app.started_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->label(__('app.submitted_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('score_percent')
                    ->label(__('app.score_percent'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('app.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'passed' => 'success',
                        'failed' => 'danger',
                        'in_progress' => 'warning',
                        'timed_out' => 'gray',
                        default => 'gray',
                    })
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
