<?php
declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonAttachmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label(__('app.lesson_title'))
                    ->sortable(),
                TextColumn::make('original_filename')
                    ->label(__('app.original_filename'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('storage_path')
                    ->label(__('app.storage_path')),
                TextColumn::make('file_size_bytes')
                    ->label(__('app.file_size_bytes'))
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB'),
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
