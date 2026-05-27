<?php
declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\SubjectCategory\Models\SubjectCategory;
use Modules\SubjectCategory\Filament\Panel\Admin\Pages\ListSubjectCategories;
use Modules\SubjectCategory\Filament\Panel\Admin\Pages\CreateSubjectCategory;
use Modules\SubjectCategory\Filament\Panel\Admin\Pages\ViewSubjectCategory;
use Modules\SubjectCategory\Filament\Panel\Admin\Pages\EditSubjectCategory;
use Modules\SubjectCategory\Filament\Panel\Admin\Schemas\SubjectCategoryForm;
use Modules\SubjectCategory\Filament\Panel\Admin\Schemas\SubjectCategoryInfolist;
use Modules\SubjectCategory\Filament\Panel\Admin\Tables\SubjectCategoriesTable;

class SubjectCategoryResource extends Resource
{
    protected static ?string $model = SubjectCategory::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-tag';
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
        return __('app.subject_categories');
    }

    public static function getModelLabel(): string
    {
        return __('app.subject_category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.subject_categories');
    }

    public static function form(Schema $schema): Schema
    {
        return SubjectCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubjectCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubjectCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubjectCategories::route('/'),
            'create' => CreateSubjectCategory::route('/create'),
            'view' => ViewSubjectCategory::route('/{record}'),
            'edit' => EditSubjectCategory::route('/{record}/edit'),
        ];
    }
}
