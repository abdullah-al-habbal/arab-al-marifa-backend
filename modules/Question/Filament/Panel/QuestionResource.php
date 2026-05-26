<?php
declare(strict_types=1);

namespace Modules\Question\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Question\Models\Question;
use Modules\Question\Filament\Panel\Pages\ListQuestions;
use Modules\Question\Filament\Panel\Pages\CreateQuestion;
use Modules\Question\Filament\Panel\Pages\ViewQuestion;
use Modules\Question\Filament\Panel\Pages\EditQuestion;
use Modules\Question\Filament\Panel\Schemas\QuestionForm;
use Modules\Question\Filament\Panel\Schemas\QuestionInfolist;
use Modules\Question\Filament\Panel\Tables\QuestionsTable;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'body';

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
        return __('app.questions');
    }

    public static function getModelLabel(): string
    {
        return __('app.question');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.questions');
    }

    public static function form(Schema $schema): Schema
    {
        return QuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuestions::route('/'),
            'create' => CreateQuestion::route('/create'),
            'view' => ViewQuestion::route('/{record}'),
            'edit' => EditQuestion::route('/{record}/edit'),
        ];
    }
}
