<?php
declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExamInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('title')
                ->label(__('app.title'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('subject.name')
                ->label(__('app.subject_id'))
                ->columnSpan(1),
            TextEntry::make('question_count')
                ->label(__('app.question_count'))
                ->columnSpan(1),
            TextEntry::make('passing_score_percent')
                ->label(__('app.passing_score_percent'))
                ->columnSpan(1),
            TextEntry::make('time_limit_minutes')
                ->label(__('app.time_limit_minutes'))
                ->columnSpan(1),
            TextEntry::make('createdBy.name')
                ->label(__('app.created_by'))
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
