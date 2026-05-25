<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Modules\QuestionBank\Models\QuestionBank;

final class QuestionBankResource extends Resource
{
    protected static ?string $model = QuestionBank::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                Select::make('lesson_id')
                    ->relationship('lesson', 'title'),
                TextInput::make('unit_tag')
                    ->maxLength(255),
                RichEditor::make('stem')
                    ->required(),
                Select::make('question_type')
                    ->options([
                        'single_choice' => 'Single Choice',
                    ])
                    ->default('single_choice'),
                Select::make('difficulty')
                    ->options([
                        'easy' => 'Easy',
                        'medium' => 'Medium',
                        'hard' => 'Hard',
                    ])
                    ->default('medium'),
                Select::make('created_by')
                    ->relationship('createdBy', 'name'),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subject.name'),
                TextColumn::make('lesson.title'),
                TextColumn::make('unit_tag'),
                TextColumn::make('stem')
                    ->limit(50),
                TextColumn::make('question_type'),
                TextColumn::make('difficulty'),
                ToggleColumn::make('is_active'),
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
            'index' => ListQuestionBanks::route('/'),
            'create' => CreateQuestionBank::route('/create'),
            'edit' => EditQuestionBank::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListQuestionBanks extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateQuestionBank extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionBankResource::class;
}

final class EditQuestionBank extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionBankResource::class;
}
