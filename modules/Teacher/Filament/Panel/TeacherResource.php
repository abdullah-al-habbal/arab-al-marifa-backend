<?php

declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Teacher\Models\Teacher;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                RichEditor::make('bio'),
                TextInput::make('profile_photo_path')
                    ->maxLength(255),
                TextInput::make('specialization')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('specialization')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeachers::route('/'),
            'create' => CreateTeacher::route('/create'),
            'edit' => EditTeacher::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Teachers';
    }
}

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;
}

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
}

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;
}
