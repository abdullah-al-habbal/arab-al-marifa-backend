<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\EducationalStage\Filament\Panel\Admin\EducationalStageResource;

class ViewEducationalStage extends ViewRecord
{
    protected static string $resource = EducationalStageResource::class;
}
