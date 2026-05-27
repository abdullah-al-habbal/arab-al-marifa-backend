<?php
declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Student\Models\Student;
use Modules\Student\Filament\Panel\Admin\Pages\ListStudents;
use Modules\Student\Filament\Panel\Admin\Pages\CreateStudent;
use Modules\Student\Filament\Panel\Admin\Pages\ViewStudent;
use Modules\Student\Filament\Panel\Admin\Pages\EditStudent;
use Modules\Student\Filament\Panel\Admin\Schemas\StudentForm;
use Modules\Student\Filament\Panel\Admin\Schemas\StudentInfolist;
use Modules\Student\Filament\Panel\Admin\Tables\StudentsTable;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'user.name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-academic-cap';
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
        return __('app.students');
    }

    public static function getModelLabel(): string
    {
        return __('app.student');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.students');
    }

    public static function form(Schema $schema): Schema
    {
        return StudentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StudentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStudents::route('/'),
            'create' => CreateStudent::route('/create'),
            'view' => ViewStudent::route('/{record}'),
            'edit' => EditStudent::route('/{record}/edit'),
        ];
    }
}
