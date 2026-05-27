<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExamAttemptInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('exam.title')
                ->label(__('app.exam_id'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('student.id')
                ->label(__('app.student_id'))
                ->columnSpan(1),
            TextEntry::make('status')
                ->label(__('app.status'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'passed' => 'success',
                    'failed' => 'danger',
                    'in_progress' => 'warning',
                    'timed_out' => 'gray',
                    default => 'gray',
                })
                ->columnSpan(1),
            TextEntry::make('started_at')
                ->label(__('app.started_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('submitted_at')
                ->label(__('app.submitted_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('score_percent')
                ->label(__('app.score_percent'))
                ->columnSpan(1),
            TextEntry::make('created_at')
                ->label(__('app.created_at'))
                ->dateTime()
                ->icon('heroicon-o-calendar')
                ->columnSpan(1),
            TextEntry::make('updated_at')
                ->label(__('app.updated_at'))
                ->dateTime()
                ->since()
                ->icon('heroicon-o-clock')
                ->columnSpan(1),
            TextEntry::make('id')
                ->label(__('app.id'))
                ->size('sm')
                ->columnSpan(1),
        ])->columns(2);
    }
}
