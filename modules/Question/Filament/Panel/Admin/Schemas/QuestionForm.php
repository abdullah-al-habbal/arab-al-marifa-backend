<?php
declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('question_bank_id')
                ->label(__('app.question_bank_id'))
                ->relationship('questionBank', 'stem')
                ->required(),
            TextInput::make('body')
                ->label(__('app.body'))
                ->required()
                ->maxLength(255),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
        ]);
    }
}
