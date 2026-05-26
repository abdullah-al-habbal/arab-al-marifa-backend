<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuestionBankInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('stem')
                ->label(__('app.stem'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('subject.name')
                ->label(__('app.subject_id'))
                ->columnSpan(1),
            TextEntry::make('lesson.title')
                ->label(__('app.lesson_id'))
                ->columnSpan(1),
            TextEntry::make('unit_tag')
                ->label(__('app.unit_tag'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('question_type')
                ->label(__('app.question_type'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('difficulty')
                ->label(__('app.difficulty'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'easy' => 'success',
                    'medium' => 'warning',
                    'hard' => 'danger',
                    default => 'gray',
                })
                ->columnSpan(1),
            TextEntry::make('createdBy.name')
                ->label(__('app.created_by'))
                ->columnSpan(1),
            IconEntry::make('is_active')
                ->label(__('app.is_active'))
                ->boolean()
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
