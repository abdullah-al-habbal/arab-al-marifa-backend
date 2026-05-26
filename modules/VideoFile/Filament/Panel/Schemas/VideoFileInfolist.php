<?php
declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VideoFileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('lesson.title')
                ->label(__('app.lesson_id'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('quality')
                ->label(__('app.quality'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('storage_path')
                ->label(__('app.storage_path'))
                ->columnSpan(1),
            TextEntry::make('mime_type')
                ->label(__('app.mime_type'))
                ->columnSpan(1),
            TextEntry::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB')
                ->columnSpan(1),
            TextEntry::make('duration_seconds')
                ->label(__('app.duration_seconds'))
                ->formatStateUsing(fn ($state) => gmdate('H:i:s', $state))
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
