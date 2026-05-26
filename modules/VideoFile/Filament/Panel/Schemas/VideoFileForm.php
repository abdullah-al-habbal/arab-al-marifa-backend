<?php
declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VideoFileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('lesson_id')
                ->label(__('app.lesson_id'))
                ->relationship('lesson', 'title')
                ->required(),
            Select::make('quality')
                ->label(__('app.quality'))
                ->options([
                    'low' => __('app.low'),
                    'medium' => __('app.medium'),
                    'high' => __('app.high'),
                ])
                ->required(),
            TextInput::make('storage_path')
                ->label(__('app.storage_path'))
                ->required()
                ->maxLength(255),
            TextInput::make('mime_type')
                ->label(__('app.mime_type'))
                ->required()
                ->maxLength(255),
            TextInput::make('file_size_bytes')
                ->label(__('app.file_size_bytes'))
                ->numeric()
                ->required(),
            TextInput::make('duration_seconds')
                ->label(__('app.duration_seconds'))
                ->numeric()
                ->required(),
        ]);
    }
}
