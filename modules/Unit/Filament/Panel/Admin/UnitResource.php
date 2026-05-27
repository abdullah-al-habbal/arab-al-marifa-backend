<?php
declare(strict_types=1);

namespace Modules\Unit\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Unit\Models\Unit;
use Modules\Unit\Filament\Panel\Admin\Pages\ListUnits;
use Modules\Unit\Filament\Panel\Admin\Pages\CreateUnit;
use Modules\Unit\Filament\Panel\Admin\Pages\ViewUnit;
use Modules\Unit\Filament\Panel\Admin\Pages\EditUnit;
use Modules\Unit\Filament\Panel\Admin\Schemas\UnitForm;
use Modules\Unit\Filament\Panel\Admin\Schemas\UnitInfolist;
use Modules\Unit\Filament\Panel\Admin\Tables\UnitsTable;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-cube';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.catalog');
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
        return __('app.units');
    }

    public static function getModelLabel(): string
    {
        return __('app.unit');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.units');
    }

    public static function form(Schema $schema): Schema
    {
        return UnitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UnitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'view' => ViewUnit::route('/{record}'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }
}
