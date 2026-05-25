<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\VideoFile\Models\VideoFile;

final class VideoFileResource extends Resource
{
    protected static ?string $model = VideoFile::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('lesson_id')
                    ->relationship('lesson', 'title')
                    ->required(),
                Select::make('quality')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                    ])
                    ->required(),
                TextInput::make('storage_path')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mime_type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('file_size_bytes')
                    ->numeric()
                    ->required(),
                TextInput::make('duration_seconds')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label('Lesson'),
                TextColumn::make('quality'),
                TextColumn::make('mime_type'),
                TextColumn::make('file_size_bytes')
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB'),
                TextColumn::make('duration_seconds')
                    ->formatStateUsing(fn ($state) => gmdate('H:i:s', $state)),
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
            'index' => ListVideoFiles::route('/'),
            'create' => CreateVideoFile::route('/create'),
            'edit' => EditVideoFile::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListVideoFiles extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = VideoFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateVideoFile extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = VideoFileResource::class;
}

final class EditVideoFile extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = VideoFileResource::class;
}
