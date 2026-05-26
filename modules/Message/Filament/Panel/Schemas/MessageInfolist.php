<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('body')
                ->label(__('app.body'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('channel_id')
                ->label(__('app.channel_id'))
                ->columnSpan(1),
            TextEntry::make('sender.name')
                ->label(__('app.sender_name'))
                ->columnSpan(1),
            TextEntry::make('sender_type')
                ->label(__('app.sender_type'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('message_type')
                ->label(__('app.message_type'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('sent_at')
                ->label(__('app.sent_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('read_at')
                ->label(__('app.read_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('attachment_path')
                ->label(__('app.attachment_path'))
                ->columnSpanFull(),
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
