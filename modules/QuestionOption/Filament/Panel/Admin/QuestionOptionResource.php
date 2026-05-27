<?php
declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\QuestionOption\Models\QuestionOption;
use Modules\QuestionOption\Filament\Panel\Admin\Pages\ListQuestionOptions;
use Modules\QuestionOption\Filament\Panel\Admin\Pages\CreateQuestionOption;
use Modules\QuestionOption\Filament\Panel\Admin\Pages\ViewQuestionOption;
use Modules\QuestionOption\Filament\Panel\Admin\Pages\EditQuestionOption;
use Modules\QuestionOption\Filament\Panel\Admin\Schemas\QuestionOptionForm;
use Modules\QuestionOption\Filament\Panel\Admin\Schemas\QuestionOptionInfolist;
use Modules\QuestionOption\Filament\Panel\Admin\Tables\QuestionOptionsTable;

class QuestionOptionResource extends Resource
{
    protected static ?string $model = QuestionOption::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'body';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-list-bullet';
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
        return __('app.question_options');
    }

    public static function getModelLabel(): string
    {
        return __('app.question_option');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.question_options');
    }

    public static function form(Schema $schema): Schema
    {
        return QuestionOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuestionOptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuestionOptions::route('/'),
            'create' => CreateQuestionOption::route('/create'),
            'view' => ViewQuestionOption::route('/{record}'),
            'edit' => EditQuestionOption::route('/{record}/edit'),
        ];
    }
}
