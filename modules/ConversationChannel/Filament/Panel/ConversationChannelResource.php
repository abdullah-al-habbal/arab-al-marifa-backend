<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\ConversationChannel\Models\ConversationChannel;

final class ConversationChannelResource extends Resource
{
    protected static ?string $model = ConversationChannel::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('lesson_id')
                    ->relationship('lesson', 'title')
                    ->required(),
                Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label('Lesson'),
                TextColumn::make('student_id'),
                TextColumn::make('teacher_id'),
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
            'index' => ListConversationChannels::route('/'),
            'create' => CreateConversationChannel::route('/create'),
            'edit' => EditConversationChannel::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListConversationChannels extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ConversationChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateConversationChannel extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ConversationChannelResource::class;
}

final class EditConversationChannel extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
