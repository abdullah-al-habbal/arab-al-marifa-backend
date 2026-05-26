<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Message\Models\Message;
use Modules\Message\Filament\Panel\Pages\ListMessages;
use Modules\Message\Filament\Panel\Pages\CreateMessage;
use Modules\Message\Filament\Panel\Pages\ViewMessage;
use Modules\Message\Filament\Panel\Pages\EditMessage;
use Modules\Message\Filament\Panel\Schemas\MessageForm;
use Modules\Message\Filament\Panel\Schemas\MessageInfolist;
use Modules\Message\Filament\Panel\Tables\MessagesTable;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'body';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-envelope';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.communication');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function getNavigationLabel(): string
    {
        return __('app.messages');
    }

    public static function getModelLabel(): string
    {
        return __('app.message');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.messages');
    }

    public static function form(Schema $schema): Schema
    {
        return MessageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MessageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MessagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMessages::route('/'),
            'create' => CreateMessage::route('/create'),
            'view' => ViewMessage::route('/{record}'),
            'edit' => EditMessage::route('/{record}/edit'),
        ];
    }
}
