<?php
declare(strict_types=1);

namespace Modules\Subject\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Subject\Models\Subject;
use Modules\Subject\Filament\Panel\Pages\ListSubjects;
use Modules\Subject\Filament\Panel\Pages\CreateSubject;
use Modules\Subject\Filament\Panel\Pages\ViewSubject;
use Modules\Subject\Filament\Panel\Pages\EditSubject;
use Modules\Subject\Filament\Panel\Schemas\SubjectForm;
use Modules\Subject\Filament\Panel\Schemas\SubjectInfolist;
use Modules\Subject\Filament\Panel\Tables\SubjectsTable;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-book-open';
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
        return __('app.subjects');
    }

    public static function getModelLabel(): string
    {
        return __('app.subject');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.subjects');
    }

    public static function form(Schema $schema): Schema
    {
        return SubjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubjects::route('/'),
            'create' => CreateSubject::route('/create'),
            'view' => ViewSubject::route('/{record}'),
            'edit' => EditSubject::route('/{record}/edit'),
        ];
    }
}
