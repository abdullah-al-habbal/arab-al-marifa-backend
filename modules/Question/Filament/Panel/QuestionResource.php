<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Question\Models\Question;

final class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('question_bank_id')
                    ->relationship('questionBank', 'stem')
                    ->required(),
                TextInput::make('body')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('questionBank.stem')
                    ->limit(50),
                TextColumn::make('body')
                    ->limit(50),
                TextColumn::make('sort_order'),
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
            'index' => ListQuestions::route('/'),
            'create' => CreateQuestion::route('/create'),
            'edit' => EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListQuestions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateQuestion extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionResource::class;
}

final class EditQuestion extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionResource::class;
}
