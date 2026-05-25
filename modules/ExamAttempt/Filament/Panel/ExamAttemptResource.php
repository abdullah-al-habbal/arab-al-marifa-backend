<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\ExamAttempt\Models\ExamAttempt;

final class ExamAttemptResource extends Resource
{
    protected static ?string $model = ExamAttempt::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('exam_id')
                    ->relationship('exam', 'title')
                    ->required(),
                Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                DateTimePicker::make('started_at'),
                DateTimePicker::make('submitted_at'),
                TextInput::make('score_percent')
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'in_progress' => 'In Progress',
                        'passed' => 'Passed',
                        'failed' => 'Failed',
                        'timed_out' => 'Timed Out',
                    ])
                    ->default('in_progress')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('exam.title'),
                TextColumn::make('student.id')
                    ->label('Student ID'),
                TextColumn::make('started_at')
                    ->dateTime(),
                TextColumn::make('submitted_at')
                    ->dateTime(),
                TextColumn::make('score_percent'),
                TextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamAttempts::route('/'),
            'create' => CreateExamAttempt::route('/create'),
            'edit' => EditExamAttempt::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListExamAttempts extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ExamAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateExamAttempt extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamAttemptResource::class;
}

final class EditExamAttempt extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
