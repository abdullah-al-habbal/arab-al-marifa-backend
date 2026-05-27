<?php
declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('body')
                ->label(__('app.body'))
                ->weight('bold')
                ->size('xl')
                ->columnSpanFull(),
            TextEntry::make('questionBank.stem')
                ->label(__('app.question_bank_id'))
                ->columnSpan(1),
            TextEntry::make('sort_order')
                ->label(__('app.sort_order'))
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
