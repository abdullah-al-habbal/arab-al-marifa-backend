<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Exam\Models\Exam;

final class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                TextInput::make('question_count')
                    ->numeric()
                    ->required(),
                TextInput::make('passing_score_percent')
                    ->numeric()
                    ->default(70),
                TextInput::make('time_limit_minutes')
                    ->numeric(),
                Select::make('created_by')
                    ->relationship('createdBy', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('subject.name'),
                TextColumn::make('question_count'),
                TextColumn::make('passing_score_percent'),
                TextColumn::make('time_limit_minutes'),
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
            'index' => ListExams::route('/'),
            'create' => CreateExam::route('/create'),
            'edit' => EditExam::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListExams extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateExam extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamResource::class;
}

final class EditExam extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamResource::class;
}
