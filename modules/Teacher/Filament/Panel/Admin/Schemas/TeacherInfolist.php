<?php
declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Admin\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TeacherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('user.name')
                ->label(__('app.user_name'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('specialization')
                ->label(__('app.specialization'))
                ->badge()
                ->columnSpan(1),
            TextEntry::make('profile_photo_path')
                ->label(__('app.profile_photo_path'))
                ->columnSpan(1),
            TextEntry::make('bio')
                ->label(__('app.bio'))
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
