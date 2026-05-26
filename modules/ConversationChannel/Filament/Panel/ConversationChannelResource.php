<?php
declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\ConversationChannel\Models\ConversationChannel;
use Modules\ConversationChannel\Filament\Panel\Pages\ListConversationChannels;
use Modules\ConversationChannel\Filament\Panel\Pages\CreateConversationChannel;
use Modules\ConversationChannel\Filament\Panel\Pages\ViewConversationChannel;
use Modules\ConversationChannel\Filament\Panel\Pages\EditConversationChannel;
use Modules\ConversationChannel\Filament\Panel\Schemas\ConversationChannelForm;
use Modules\ConversationChannel\Filament\Panel\Schemas\ConversationChannelInfolist;
use Modules\ConversationChannel\Filament\Panel\Tables\ConversationChannelsTable;

class ConversationChannelResource extends Resource
{
    protected static ?string $model = ConversationChannel::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-chat-bubble-left-right';
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
        return __('app.conversation_channels');
    }

    public static function getModelLabel(): string
    {
        return __('app.conversation_channel');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.conversation_channels');
    }

    public static function form(Schema $schema): Schema
    {
        return ConversationChannelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConversationChannelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConversationChannelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConversationChannels::route('/'),
            'create' => CreateConversationChannel::route('/create'),
            'view' => ViewConversationChannel::route('/{record}'),
            'edit' => EditConversationChannel::route('/{record}/edit'),
        ];
    }
}
