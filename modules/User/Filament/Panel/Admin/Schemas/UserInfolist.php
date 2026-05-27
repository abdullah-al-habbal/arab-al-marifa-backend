<?php
declare(strict_types=1);

namespace Modules\User\Filament\Panel\Admin\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('name')
                ->label(__('app.name'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('phone')
                ->label(__('app.phone'))
                ->icon('heroicon-o-phone')
                ->copyable()
                ->columnSpan(1),
            TextEntry::make('email')
                ->label(__('app.email'))
                ->icon('heroicon-o-envelope')
                ->copyable()
                ->columnSpan(1),
            TextEntry::make('role')
                ->label(__('app.role'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('status')
                ->label(__('app.status'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'active' => 'success',
                    'suspended' => 'danger',
                    default => 'gray',
                })
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
