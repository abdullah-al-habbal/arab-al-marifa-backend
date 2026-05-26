<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LessonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('title')
                ->label(__('app.title'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('subjectCategory.name')
                ->label(__('app.subject_category_id'))
                ->columnSpan(1),
            TextEntry::make('teacher.user.name')
                ->label(__('app.teacher_id'))
                ->columnSpan(1),
            TextEntry::make('description')
                ->label(__('app.description'))
                ->html()
                ->columnSpanFull(),
            TextEntry::make('unit_tag')
                ->label(__('app.unit_tag'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('sort_order')
                ->label(__('app.sort_order'))
                ->columnSpan(1),
            IconEntry::make('is_published')
                ->label(__('app.is_published'))
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
