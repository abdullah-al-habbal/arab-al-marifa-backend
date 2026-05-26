<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MessageAttachmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('message_id')
                ->label(__('app.message_id'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('attachment_path')
                ->label(__('app.attachment_path'))
                ->columnSpan(1),
            TextEntry::make('mime_type')
                ->label(__('app.mime_type'))
                ->columnSpan(1),
            TextEntry::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
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
