<?php
declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideoFilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label(__('app.lesson_title'))
                    ->sortable(),
                TextColumn::make('quality')
                    ->label(__('app.quality'))
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->label(__('app.mime_type')),
                TextColumn::make('file_size_bytes')
                    ->label(__('app.file_size_bytes'))
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB'),
                TextColumn::make('duration_seconds')
                    ->label(__('app.duration_seconds'))
                    ->formatStateUsing(fn ($state) => gmdate('H:i:s', $state)),
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
