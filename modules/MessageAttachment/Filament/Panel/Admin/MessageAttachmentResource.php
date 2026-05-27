<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\MessageAttachment\Models\MessageAttachment;
use Modules\MessageAttachment\Filament\Panel\Admin\Pages\ListMessageAttachments;
use Modules\MessageAttachment\Filament\Panel\Admin\Pages\CreateMessageAttachment;
use Modules\MessageAttachment\Filament\Panel\Admin\Pages\ViewMessageAttachment;
use Modules\MessageAttachment\Filament\Panel\Admin\Pages\EditMessageAttachment;
use Modules\MessageAttachment\Filament\Panel\Admin\Schemas\MessageAttachmentForm;
use Modules\MessageAttachment\Filament\Panel\Admin\Schemas\MessageAttachmentInfolist;
use Modules\MessageAttachment\Filament\Panel\Admin\Tables\MessageAttachmentsTable;

class MessageAttachmentResource extends Resource
{
    protected static ?string $model = MessageAttachment::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-paper-clip';
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
        return __('app.message_attachments');
    }

    public static function getModelLabel(): string
    {
        return __('app.message_attachment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.message_attachments');
    }

    public static function form(Schema $schema): Schema
    {
        return MessageAttachmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MessageAttachmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MessageAttachmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMessageAttachments::route('/'),
            'create' => CreateMessageAttachment::route('/create'),
            'view' => ViewMessageAttachment::route('/{record}'),
            'edit' => EditMessageAttachment::route('/{record}/edit'),
        ];
    }
}
