<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\EducationalSubStage\Filament\Panel\EducationalSubStageResource;

class ViewEducationalSubStage extends ViewRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}
