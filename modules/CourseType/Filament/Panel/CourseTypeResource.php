<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel;

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
use Modules\CourseType\Models\CourseType;

class CourseTypeResource extends Resource
{
    protected static ?string $model = CourseType::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('sub_stage_id')
                    ->relationship('subStage', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('academic_year')
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
                TextColumn::make('subStage.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('academic_year')
                    ->searchable(),
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
            'index' => ListCourseTypes::route('/'),
            'create' => CreateCourseType::route('/create'),
            'edit' => EditCourseType::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Course Types';
    }
}

class ListCourseTypes extends ListRecords
{
    protected static string $resource = CourseTypeResource::class;
}

class CreateCourseType extends CreateRecord
{
    protected static string $resource = CourseTypeResource::class;
}

class EditCourseType extends EditRecord
{
    protected static string $resource = CourseTypeResource::class;
}
