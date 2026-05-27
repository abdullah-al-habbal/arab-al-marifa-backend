<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\EducationalSubStage\Filament\Panel\Admin\EducationalSubStageResource;

class ViewEducationalSubStage extends ViewRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}
