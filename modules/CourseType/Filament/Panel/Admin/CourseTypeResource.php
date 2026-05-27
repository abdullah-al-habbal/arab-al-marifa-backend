<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\CourseType\Models\CourseType;
use Modules\CourseType\Filament\Panel\Admin\Pages\ListCourseTypes;
use Modules\CourseType\Filament\Panel\Admin\Pages\CreateCourseType;
use Modules\CourseType\Filament\Panel\Admin\Pages\ViewCourseType;
use Modules\CourseType\Filament\Panel\Admin\Pages\EditCourseType;
use Modules\CourseType\Filament\Panel\Admin\Schemas\CourseTypeForm;
use Modules\CourseType\Filament\Panel\Admin\Schemas\CourseTypeInfolist;
use Modules\CourseType\Filament\Panel\Admin\Tables\CourseTypesTable;

class CourseTypeResource extends Resource
{
    protected static ?string $model = CourseType::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-rectangle-stack';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.hierarchy');
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
        return __('app.course_types');
    }

    public static function getModelLabel(): string
    {
        return __('app.course_type');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.course_types');
    }

    public static function form(Schema $schema): Schema
    {
        return CourseTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CourseTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourseTypes::route('/'),
            'create' => CreateCourseType::route('/create'),
            'view' => ViewCourseType::route('/{record}'),
            'edit' => EditCourseType::route('/{record}/edit'),
        ];
    }
}
