<?php
declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Subject\Filament\Panel\SubjectResource;

class ViewSubject extends ViewRecord
{
    protected static string $resource = SubjectResource::class;
}
