<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Pages;

use Modules\LibraryItem\Filament\Panel\LibraryItemResource;

class ListLibraryItems extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LibraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
