<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Pages;

use Modules\EducationalStage\Filament\Panel\EducationalStageResource;

class ListEducationalStages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = EducationalStageResource::class;

}
