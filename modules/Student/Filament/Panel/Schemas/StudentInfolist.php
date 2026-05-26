<?php
declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('user.name')
                ->label(__('app.user_name'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('date_of_birth')
                ->label(__('app.date_of_birth'))
                ->date()
                ->icon('heroicon-o-calendar')
                ->columnSpan(1),
            TextEntry::make('guardian_phone')
                ->label(__('app.guardian_phone'))
                ->icon('heroicon-o-phone')
                ->columnSpan(1),
            TextEntry::make('address')
                ->label(__('app.address'))
                ->icon('heroicon-o-map-pin')
                ->columnSpanFull(),
            TextEntry::make('registration_number')
                ->label(__('app.registration_number'))
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
