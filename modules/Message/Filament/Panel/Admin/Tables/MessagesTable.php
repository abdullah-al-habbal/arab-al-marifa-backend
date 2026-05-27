<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('channel_id')
                    ->label(__('app.channel_id'))
                    ->sortable(),
                TextColumn::make('sender.name')
                    ->label(__('app.sender_name'))
                    ->sortable(),
                TextColumn::make('message_type')
                    ->label(__('app.message_type'))
                    ->sortable(),
                TextColumn::make('sent_at')
                    ->label(__('app.sent_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('read_at')
                    ->label(__('app.read_at'))
                    ->dateTime()
                    ->sortable(),
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
