<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\LibraryItem\Models\LibraryItem;
use Modules\LibraryItem\Filament\Panel\Admin\Pages\ListLibraryItems;
use Modules\LibraryItem\Filament\Panel\Admin\Pages\CreateLibraryItem;
use Modules\LibraryItem\Filament\Panel\Admin\Pages\ViewLibraryItem;
use Modules\LibraryItem\Filament\Panel\Admin\Pages\EditLibraryItem;
use Modules\LibraryItem\Filament\Panel\Admin\Schemas\LibraryItemForm;
use Modules\LibraryItem\Filament\Panel\Admin\Schemas\LibraryItemInfolist;
use Modules\LibraryItem\Filament\Panel\Admin\Tables\LibraryItemsTable;

class LibraryItemResource extends Resource
{
    protected static ?string $model = LibraryItem::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-bookmark';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.library');
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
        return __('app.library_items');
    }

    public static function getModelLabel(): string
    {
        return __('app.library_item');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.library_items');
    }

    public static function form(Schema $schema): Schema
    {
        return LibraryItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LibraryItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LibraryItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLibraryItems::route('/'),
            'create' => CreateLibraryItem::route('/create'),
            'view' => ViewLibraryItem::route('/{record}'),
            'edit' => EditLibraryItem::route('/{record}/edit'),
        ];
    }
}
