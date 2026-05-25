<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel;

use Filament\Forms\Components\Select;
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
use Modules\EducationalSubStage\Models\EducationalSubStage;

class EducationalSubStageResource extends Resource
{
    protected static ?string $model = EducationalSubStage::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('stage_id')
                    ->relationship('stage', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
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
                TextColumn::make('stage.name')
                    ->searchable()
                    ->sortable(),
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
            'index' => ListEducationalSubStages::route('/'),
            'create' => CreateEducationalSubStage::route('/create'),
            'edit' => EditEducationalSubStage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Educational Sub Stages';
    }
}

class ListEducationalSubStages extends ListRecords
{
    protected static string $resource = EducationalSubStageResource::class;
}

class CreateEducationalSubStage extends CreateRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}

class EditEducationalSubStage extends EditRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}
