<?php
declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\StaticPage\Models\StaticPage;
use Modules\StaticPage\Filament\Panel\Admin\Pages\ListStaticPages;
use Modules\StaticPage\Filament\Panel\Admin\Pages\CreateStaticPage;
use Modules\StaticPage\Filament\Panel\Admin\Pages\ViewStaticPage;
use Modules\StaticPage\Filament\Panel\Admin\Pages\EditStaticPage;
use Modules\StaticPage\Filament\Panel\Admin\Schemas\StaticPageForm;
use Modules\StaticPage\Filament\Panel\Admin\Schemas\StaticPageInfolist;
use Modules\StaticPage\Filament\Panel\Admin\Tables\StaticPagesTable;

class StaticPageResource extends Resource
{
    protected static ?string $model = StaticPage::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-document';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.cms');
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
        return __('app.static_pages');
    }

    public static function getModelLabel(): string
    {
        return __('app.static_page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.static_pages');
    }

    public static function form(Schema $schema): Schema
    {
        return StaticPageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StaticPageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StaticPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStaticPages::route('/'),
            'create' => CreateStaticPage::route('/create'),
            'view' => ViewStaticPage::route('/{record}'),
            'edit' => EditStaticPage::route('/{record}/edit'),
        ];
    }
}
