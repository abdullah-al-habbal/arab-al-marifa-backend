<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel;

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
use Modules\SubjectCategory\Models\SubjectCategory;

final class SubjectCategoryResource extends Resource
{
    protected static ?string $model = SubjectCategory::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
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
                TextColumn::make('subject.name')
                    ->label('Subject'),
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
            'index' => ListSubjectCategories::route('/'),
            'create' => CreateSubjectCategory::route('/create'),
            'edit' => EditSubjectCategory::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListSubjectCategories extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateSubjectCategory extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubjectCategoryResource::class;
}

final class EditSubjectCategory extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubjectCategoryResource::class;
}
