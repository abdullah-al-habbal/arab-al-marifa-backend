<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\QuestionBank\Models\QuestionBank;
use Modules\QuestionBank\Filament\Panel\Pages\ListQuestionBanks;
use Modules\QuestionBank\Filament\Panel\Pages\CreateQuestionBank;
use Modules\QuestionBank\Filament\Panel\Pages\ViewQuestionBank;
use Modules\QuestionBank\Filament\Panel\Pages\EditQuestionBank;
use Modules\QuestionBank\Filament\Panel\Schemas\QuestionBankForm;
use Modules\QuestionBank\Filament\Panel\Schemas\QuestionBankInfolist;
use Modules\QuestionBank\Filament\Panel\Tables\QuestionBanksTable;

class QuestionBankResource extends Resource
{
    protected static ?string $model = QuestionBank::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'stem';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-question-mark-circle';
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
        return __('app.question_banks');
    }

    public static function getModelLabel(): string
    {
        return __('app.question_bank');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.question_banks');
    }

    public static function form(Schema $schema): Schema
    {
        return QuestionBankForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuestionBankInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionBanksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuestionBanks::route('/'),
            'create' => CreateQuestionBank::route('/create'),
            'view' => ViewQuestionBank::route('/{record}'),
            'edit' => EditQuestionBank::route('/{record}/edit'),
        ];
    }
}
