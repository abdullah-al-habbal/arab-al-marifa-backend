<?php

declare(strict_types=1);

namespace Modules\Unit\Filament\Panel;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Unit\Models\Unit;

final class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->nullable(),
                TextInput::make('sort_order')
                    ->integer()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('subject.name')
                    ->label('Subject'),
                TextColumn::make('sort_order'),
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
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListUnits extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateUnit extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = UnitResource::class;
}

final class EditUnit extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = UnitResource::class;
}
