<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Pages;

use Modules\LibraryItem\Filament\Panel\LibraryItemResource;

class CreateLibraryItem extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LibraryItemResource::class;
}
