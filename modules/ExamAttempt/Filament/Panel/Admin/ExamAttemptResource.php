<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\ExamAttempt\Models\ExamAttempt;
use Modules\ExamAttempt\Filament\Panel\Admin\Pages\ListExamAttempts;
use Modules\ExamAttempt\Filament\Panel\Admin\Pages\CreateExamAttempt;
use Modules\ExamAttempt\Filament\Panel\Admin\Pages\ViewExamAttempt;
use Modules\ExamAttempt\Filament\Panel\Admin\Pages\EditExamAttempt;
use Modules\ExamAttempt\Filament\Panel\Admin\Schemas\ExamAttemptForm;
use Modules\ExamAttempt\Filament\Panel\Admin\Schemas\ExamAttemptInfolist;
use Modules\ExamAttempt\Filament\Panel\Admin\Tables\ExamAttemptsTable;

class ExamAttemptResource extends Resource
{
    protected static ?string $model = ExamAttempt::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-clipboard-document-list';
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
        return __('app.exam_attempts');
    }

    public static function getModelLabel(): string
    {
        return __('app.exam_attempt');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.exam_attempts');
    }

    public static function form(Schema $schema): Schema
    {
        return ExamAttemptForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExamAttemptInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamAttemptsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamAttempts::route('/'),
            'create' => CreateExamAttempt::route('/create'),
            'view' => ViewExamAttempt::route('/{record}'),
            'edit' => EditExamAttempt::route('/{record}/edit'),
        ];
    }
}
