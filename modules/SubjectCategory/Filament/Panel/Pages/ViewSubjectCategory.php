<?php
declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\SubjectCategory\Filament\Panel\SubjectCategoryResource;

class ViewSubjectCategory extends ViewRecord
{
    protected static string $resource = SubjectCategoryResource::class;
}
