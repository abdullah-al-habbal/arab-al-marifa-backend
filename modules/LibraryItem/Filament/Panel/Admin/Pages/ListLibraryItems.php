<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin\Pages;

use Modules\LibraryItem\Filament\Panel\Admin\LibraryItemResource;

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
