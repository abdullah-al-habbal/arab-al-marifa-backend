<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('channel_id')
                ->label(__('app.channel_id'))
                ->relationship('channel', 'id')
                ->required(),
            Select::make('sender_id')
                ->label(__('app.sender_id'))
                ->relationship('sender', 'name')
                ->required(),
            Select::make('sender_type')
                ->label(__('app.sender_type'))
                ->options([
                    'student' => __('app.student'),
                    'teacher' => __('app.teacher'),
                ])
                ->required(),
            Select::make('message_type')
                ->label(__('app.message_type'))
                ->options([
                    'text' => __('app.text'),
                    'voice' => __('app.voice'),
                    'image' => __('app.image'),
                    'video' => __('app.video'),
                ])
                ->required(),
            RichEditor::make('body')
                ->label(__('app.body')),
            TextInput::make('attachment_path')
                ->label(__('app.attachment_path'))
                ->maxLength(255),
            DateTimePicker::make('sent_at')
                ->label(__('app.sent_at'))
                ->required(),
            DateTimePicker::make('read_at')
                ->label(__('app.read_at')),
        ]);
    }
}
