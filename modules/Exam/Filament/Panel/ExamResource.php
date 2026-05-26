<?php
declare(strict_types=1);

namespace Modules\Exam\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Exam\Models\Exam;
use Modules\Exam\Filament\Panel\Pages\ListExams;
use Modules\Exam\Filament\Panel\Pages\CreateExam;
use Modules\Exam\Filament\Panel\Pages\ViewExam;
use Modules\Exam\Filament\Panel\Pages\EditExam;
use Modules\Exam\Filament\Panel\Schemas\ExamForm;
use Modules\Exam\Filament\Panel\Schemas\ExamInfolist;
use Modules\Exam\Filament\Panel\Tables\ExamsTable;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.assessment');
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
        return __('app.exams');
    }

    public static function getModelLabel(): string
    {
        return __('app.exam');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.exams');
    }

    public static function form(Schema $schema): Schema
    {
        return ExamForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExamInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExams::route('/'),
            'create' => CreateExam::route('/create'),
            'view' => ViewExam::route('/{record}'),
            'edit' => EditExam::route('/{record}/edit'),
        ];
    }
}
