<?php
declare(strict_types=1);

namespace Modules\LibraryItem\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\LibraryItem\Filament\Panel\Admin\LibraryItemResource;

class ViewLibraryItem extends ViewRecord
{
    protected static string $resource = LibraryItemResource::class;
}
