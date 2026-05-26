<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuestionBankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('subject_id')
                ->label(__('app.subject_id'))
                ->relationship('subject', 'name')
                ->required(),
            Select::make('lesson_id')
                ->label(__('app.lesson_id'))
                ->relationship('lesson', 'title'),
            TextInput::make('unit_tag')
                ->label(__('app.unit_tag'))
                ->maxLength(255),
            RichEditor::make('stem')
                ->label(__('app.stem'))
                ->required(),
            Select::make('question_type')
                ->label(__('app.question_type'))
                ->options([
                    'single_choice' => __('app.single_choice'),
                ])
                ->default('single_choice'),
            Select::make('difficulty')
                ->label(__('app.difficulty'))
                ->options([
                    'easy' => __('app.easy'),
                    'medium' => __('app.medium'),
                    'hard' => __('app.hard'),
                ])
                ->default('medium'),
            Select::make('created_by')
                ->label(__('app.created_by'))
                ->relationship('createdBy', 'name'),
            Toggle::make('is_active')
                ->label(__('app.is_active'))
                ->default(true),
        ]);
    }
}
