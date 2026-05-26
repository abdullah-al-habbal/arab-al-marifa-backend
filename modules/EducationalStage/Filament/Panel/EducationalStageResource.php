<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\EducationalStage\Models\EducationalStage;
use Modules\EducationalStage\Filament\Panel\Pages\ListEducationalStages;
use Modules\EducationalStage\Filament\Panel\Pages\CreateEducationalStage;
use Modules\EducationalStage\Filament\Panel\Pages\ViewEducationalStage;
use Modules\EducationalStage\Filament\Panel\Pages\EditEducationalStage;
use Modules\EducationalStage\Filament\Panel\Schemas\EducationalStageForm;
use Modules\EducationalStage\Filament\Panel\Schemas\EducationalStageInfolist;
use Modules\EducationalStage\Filament\Panel\Tables\EducationalStagesTable;

class EducationalStageResource extends Resource
{
    protected static ?string $model = EducationalStage::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-building-library';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.hierarchy');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function getNavigationLabel(): string
    {
        return __('app.educational_stages');
    }

    public static function getModelLabel(): string
    {
        return __('app.educational_stage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.educational_stages');
    }

    public static function form(Schema $schema): Schema
    {
        return EducationalStageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EducationalStageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationalStagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationalStages::route('/'),
            'create' => CreateEducationalStage::route('/create'),
            'view' => ViewEducationalStage::route('/{record}'),
            'edit' => EditEducationalStage::route('/{record}/edit'),
        ];
    }
}
