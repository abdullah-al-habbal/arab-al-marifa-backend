<?php
declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Teacher\Models\Teacher;
use Modules\Teacher\Filament\Panel\Admin\Pages\ListTeachers;
use Modules\Teacher\Filament\Panel\Admin\Pages\CreateTeacher;
use Modules\Teacher\Filament\Panel\Admin\Pages\ViewTeacher;
use Modules\Teacher\Filament\Panel\Admin\Pages\EditTeacher;
use Modules\Teacher\Filament\Panel\Admin\Schemas\TeacherForm;
use Modules\Teacher\Filament\Panel\Admin\Schemas\TeacherInfolist;
use Modules\Teacher\Filament\Panel\Admin\Tables\TeachersTable;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'specialization';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-presentation-chart-bar';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.people');
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
        return __('app.teachers');
    }

    public static function getModelLabel(): string
    {
        return __('app.teacher');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.teachers');
    }

    public static function form(Schema $schema): Schema
    {
        return TeacherForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TeacherInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeachersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeachers::route('/'),
            'create' => CreateTeacher::route('/create'),
            'view' => ViewTeacher::route('/{record}'),
            'edit' => EditTeacher::route('/{record}/edit'),
        ];
    }
}
