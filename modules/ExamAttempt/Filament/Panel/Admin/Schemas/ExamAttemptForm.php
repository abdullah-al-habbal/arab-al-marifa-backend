<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamAttemptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('exam_id')
                ->label(__('app.exam_id'))
                ->relationship('exam', 'title')
                ->required(),
            Select::make('student_id')
                ->label(__('app.student_id'))
                ->relationship('student', 'id')
                ->required(),
            DateTimePicker::make('started_at')
                ->label(__('app.started_at')),
            DateTimePicker::make('submitted_at')
                ->label(__('app.submitted_at')),
            TextInput::make('score_percent')
                ->label(__('app.score_percent'))
                ->numeric(),
            Select::make('status')
                ->label(__('app.status'))
                ->options([
                    'in_progress' => __('app.in_progress'),
                    'passed' => __('app.passed'),
                    'failed' => __('app.failed'),
                    'timed_out' => __('app.timed_out'),
                ])
                ->default('in_progress')
                ->required(),
        ]);
    }
}
