<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\LibraryItem\Filament\Panel\LibraryItemResource;

class ViewLibraryItem extends ViewRecord
{
    protected static string $resource = LibraryItemResource::class;
}
