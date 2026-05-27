<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Lesson\Models\Lesson;
use Modules\Lesson\Filament\Panel\Admin\Pages\ListLessons;
use Modules\Lesson\Filament\Panel\Admin\Pages\CreateLesson;
use Modules\Lesson\Filament\Panel\Admin\Pages\ViewLesson;
use Modules\Lesson\Filament\Panel\Admin\Pages\EditLesson;
use Modules\Lesson\Filament\Panel\Admin\Schemas\LessonForm;
use Modules\Lesson\Filament\Panel\Admin\Schemas\LessonInfolist;
use Modules\Lesson\Filament\Panel\Admin\Tables\LessonsTable;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-play-circle';
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
        return __('app.lessons');
    }

    public static function getModelLabel(): string
    {
        return __('app.lesson');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.lessons');
    }

    public static function form(Schema $schema): Schema
    {
        return LessonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LessonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'view' => ViewLesson::route('/{record}'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }
}
