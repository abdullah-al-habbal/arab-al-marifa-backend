<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\EducationalSubStage\Models\EducationalSubStage;
use Modules\EducationalSubStage\Filament\Panel\Admin\Pages\ListEducationalSubStages;
use Modules\EducationalSubStage\Filament\Panel\Admin\Pages\CreateEducationalSubStage;
use Modules\EducationalSubStage\Filament\Panel\Admin\Pages\ViewEducationalSubStage;
use Modules\EducationalSubStage\Filament\Panel\Admin\Pages\EditEducationalSubStage;
use Modules\EducationalSubStage\Filament\Panel\Admin\Schemas\EducationalSubStageForm;
use Modules\EducationalSubStage\Filament\Panel\Admin\Schemas\EducationalSubStageInfolist;
use Modules\EducationalSubStage\Filament\Panel\Admin\Tables\EducationalSubStagesTable;

class EducationalSubStageResource extends Resource
{
    protected static ?string $model = EducationalSubStage::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-adjustments-vertical';
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
        return __('app.educational_sub_stages');
    }

    public static function getModelLabel(): string
    {
        return __('app.educational_sub_stage');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.educational_sub_stages');
    }

    public static function form(Schema $schema): Schema
    {
        return EducationalSubStageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EducationalSubStageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationalSubStagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationalSubStages::route('/'),
            'create' => CreateEducationalSubStage::route('/create'),
            'view' => ViewEducationalSubStage::route('/{record}'),
            'edit' => EditEducationalSubStage::route('/{record}/edit'),
        ];
    }
}
