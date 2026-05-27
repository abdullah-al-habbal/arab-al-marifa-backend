<?php
declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('student.id')
                ->label(__('app.student_id'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('subscribable_type')
                ->label(__('app.subscribable_type'))
                ->columnSpan(1),
            TextEntry::make('subscribable_id')
                ->label(__('app.subscribable_id'))
                ->columnSpan(1),
            TextEntry::make('status')
                ->label(__('app.status'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'active' => 'success',
                    'pending' => 'warning',
                    'expired' => 'danger',
                    'cancelled' => 'gray',
                    default => 'gray',
                })
                ->columnSpan(1),
            TextEntry::make('activated_at')
                ->label(__('app.activated_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('expires_at')
                ->label(__('app.expires_at'))
                ->dateTime()
                ->columnSpan(1),
            TextEntry::make('activatedBy.name')
                ->label(__('app.activated_by'))
                ->columnSpan(1),
            TextEntry::make('notes')
                ->label(__('app.notes'))
                ->html()
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
