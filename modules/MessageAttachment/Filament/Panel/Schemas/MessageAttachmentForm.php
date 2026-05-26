<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MessageAttachmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('message_id')
                ->label(__('app.message_id'))
                ->relationship('message', 'id')
                ->required(),
            TextInput::make('attachment_path')
                ->label(__('app.attachment_path'))
                ->required()
                ->maxLength(255),
            TextInput::make('mime_type')
                ->label(__('app.mime_type'))
                ->required()
                ->maxLength(255),
            TextInput::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->integer()
                ->nullable(),
        ]);
    }
}
