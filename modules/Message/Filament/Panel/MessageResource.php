<?php

declare(strict_types=1);

namespace Modules\Message\Filament\Panel;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Message\Models\Message;

final class MessageResource extends Resource
{
    protected static ?string $model = Message::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('channel_id')
                    ->relationship('channel', 'id')
                    ->required(),
                Select::make('sender_id')
                    ->relationship('sender', 'name')
                    ->required(),
                Select::make('sender_type')
                    ->options([
                        'student' => 'Student',
                        'teacher' => 'Teacher',
                    ])
                    ->required(),
                Select::make('message_type')
                    ->options([
                        'text' => 'Text',
                        'voice' => 'Voice',
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->required(),
                RichEditor::make('body'),
                TextInput::make('attachment_path')
                    ->maxLength(255),
                DateTimePicker::make('sent_at')
                    ->required(),
                DateTimePicker::make('read_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('channel_id'),
                TextColumn::make('sender.name')
                    ->label('Sender'),
                TextColumn::make('message_type'),
                TextColumn::make('sent_at')
                    ->dateTime(),
                TextColumn::make('read_at')
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
            'index' => ListMessages::route('/'),
            'create' => CreateMessage::route('/create'),
            'edit' => EditMessage::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListMessages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateMessage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = MessageResource::class;
}

final class EditMessage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = MessageResource::class;
}
