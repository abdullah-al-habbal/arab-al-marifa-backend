<?php

declare(strict_types=1);

namespace Modules\Subject\Filament\Panel;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Modules\Subject\Models\Subject;

final class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('course_type_id')
                    ->relationship('courseType', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('description'),
                TextInput::make('cover_image_path')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('courseType.name')
                    ->label('Course Type'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('sort_order'),
                ToggleColumn::make('is_active'),
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
            'index' => ListSubjects::route('/'),
            'create' => CreateSubject::route('/create'),
            'edit' => EditSubject::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListSubjects extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateSubject extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubjectResource::class;
}

final class EditSubject extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubjectResource::class;
}
