<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin\Pages;

use Modules\LibraryItem\Filament\Panel\Admin\LibraryItemResource;

class CreateLibraryItem extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LibraryItemResource::class;
}
