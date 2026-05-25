<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\EducationalStage\Models\EducationalStage;

class EducationalStageResource extends Resource
{
    protected static ?string $model = EducationalStage::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                RichEditor::make('description'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
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
            'index' => ListEducationalStages::route('/'),
            'create' => CreateEducationalStage::route('/create'),
            'edit' => EditEducationalStage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Educational Stages';
    }
}

class ListEducationalStages extends ListRecords
{
    protected static string $resource = EducationalStageResource::class;
}

class CreateEducationalStage extends CreateRecord
{
    protected static string $resource = EducationalStageResource::class;
}

class EditEducationalStage extends EditRecord
{
    protected static string $resource = EducationalStageResource::class;
}
