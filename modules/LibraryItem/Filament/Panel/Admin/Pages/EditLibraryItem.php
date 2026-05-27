<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin\Pages;

use Modules\LibraryItem\Filament\Panel\Admin\LibraryItemResource;

class EditLibraryItem extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LibraryItemResource::class;
}
