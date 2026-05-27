<?php
declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label(__('app.title'))
                ->required()
                ->maxLength(255),
            Select::make('subject_id')
                ->label(__('app.subject_id'))
                ->relationship('subject', 'name')
                ->required(),
            TextInput::make('question_count')
                ->label(__('app.question_count'))
                ->numeric()
                ->required(),
            TextInput::make('passing_score_percent')
                ->label(__('app.passing_score_percent'))
                ->numeric()
                ->default(70),
            TextInput::make('time_limit_minutes')
                ->label(__('app.time_limit_minutes'))
                ->numeric(),
            Select::make('created_by')
                ->label(__('app.created_by'))
                ->relationship('createdBy', 'name'),
        ]);
    }
}
