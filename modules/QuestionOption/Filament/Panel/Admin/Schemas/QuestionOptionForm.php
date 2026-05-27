<?php
declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuestionOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('question_id')
                ->label(__('app.question_id'))
                ->relationship('question', 'body')
                ->required(),
            TextInput::make('body')
                ->label(__('app.body'))
                ->required()
                ->maxLength(255),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
            Toggle::make('is_correct')
                ->label(__('app.is_correct'))
                ->default(false),
        ]);
    }
}
