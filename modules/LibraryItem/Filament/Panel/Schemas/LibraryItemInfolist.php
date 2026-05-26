<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LibraryItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('title')
                ->label(__('app.title'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('item_type')
                ->label(__('app.item_type'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('classifiable_type')
                ->label(__('app.classifiable_type'))
                ->columnSpan(1),
            TextEntry::make('classifiable_id')
                ->label(__('app.classifiable_id'))
                ->columnSpan(1),
            TextEntry::make('storage_path')
                ->label(__('app.storage_path'))
                ->columnSpan(1),
            TextEntry::make('mime_type')
                ->label(__('app.mime_type'))
                ->columnSpan(1),
            TextEntry::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->columnSpan(1),
            TextEntry::make('sort_order')
                ->label(__('app.sort_order'))
                ->columnSpan(1),
            IconEntry::make('is_downloadable')
                ->label(__('app.is_downloadable'))
                ->boolean()
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
