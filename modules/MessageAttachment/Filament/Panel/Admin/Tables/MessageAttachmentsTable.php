<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessageAttachmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('message_id')
                    ->label(__('app.message_id'))
                    ->sortable(),
                TextColumn::make('attachment_path')
                    ->label(__('app.attachment_path'))
                    ->limit(50),
                TextColumn::make('mime_type')
                    ->label(__('app.mime_type')),
                TextColumn::make('file_size_bytes')
                    ->label(__('app.file_size_bytes')),
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
