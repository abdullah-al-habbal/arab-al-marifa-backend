<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\MessageAttachment\Models\MessageAttachment;

final class MessageAttachmentResource extends Resource
{
    protected static ?string $model = MessageAttachment::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('message_id')
                    ->relationship('message', 'id')
                    ->required(),
                TextInput::make('attachment_path')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mime_type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('file_size_bytes')
                    ->integer()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('message_id'),
                TextColumn::make('attachment_path')
                    ->limit(50),
                TextColumn::make('mime_type'),
                TextColumn::make('file_size_bytes'),
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
            'index' => ListMessageAttachments::route('/'),
            'create' => CreateMessageAttachment::route('/create'),
            'edit' => EditMessageAttachment::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListMessageAttachments extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = MessageAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateMessageAttachment extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}

final class EditMessageAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
