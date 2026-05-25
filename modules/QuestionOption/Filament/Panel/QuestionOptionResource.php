<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\QuestionOption\Models\QuestionOption;

final class QuestionOptionResource extends Resource
{
    protected static ?string $model = QuestionOption::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('question_id')
                    ->relationship('question', 'body')
                    ->required(),
                TextInput::make('body')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
                Toggle::make('is_correct')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question.body')
                    ->limit(50),
                TextColumn::make('body')
                    ->limit(50),
                TextColumn::make('sort_order'),
                IconColumn::make('is_correct')
                    ->boolean(),
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
            'index' => ListQuestionOptions::route('/'),
            'create' => CreateQuestionOption::route('/create'),
            'edit' => EditQuestionOption::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListQuestionOptions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateQuestionOption extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionOptionResource::class;
}

final class EditQuestionOption extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
