<?php
declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\LessonAttachment\Models\LessonAttachment;
use Modules\LessonAttachment\Filament\Panel\Pages\ListLessonAttachments;
use Modules\LessonAttachment\Filament\Panel\Pages\CreateLessonAttachment;
use Modules\LessonAttachment\Filament\Panel\Pages\ViewLessonAttachment;
use Modules\LessonAttachment\Filament\Panel\Pages\EditLessonAttachment;
use Modules\LessonAttachment\Filament\Panel\Schemas\LessonAttachmentForm;
use Modules\LessonAttachment\Filament\Panel\Schemas\LessonAttachmentInfolist;
use Modules\LessonAttachment\Filament\Panel\Tables\LessonAttachmentsTable;

class LessonAttachmentResource extends Resource
{
    protected static ?string $model = LessonAttachment::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'original_filename';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-paper-clip';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.content');
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
        return __('app.lesson_attachments');
    }

    public static function getModelLabel(): string
    {
        return __('app.lesson_attachment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.lesson_attachments');
    }

    public static function form(Schema $schema): Schema
    {
        return LessonAttachmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LessonAttachmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonAttachmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessonAttachments::route('/'),
            'create' => CreateLessonAttachment::route('/create'),
            'view' => ViewLessonAttachment::route('/{record}'),
            'edit' => EditLessonAttachment::route('/{record}/edit'),
        ];
    }
}
