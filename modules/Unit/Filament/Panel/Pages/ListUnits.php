<?php

declare(strict_types=1);

namespace Modules\Unit\Filament\Panel\Pages;

use Modules\Unit\Filament\Panel\UnitResource;

class ListUnits extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
