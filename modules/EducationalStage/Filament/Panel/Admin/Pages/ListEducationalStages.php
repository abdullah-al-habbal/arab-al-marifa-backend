<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Admin\Pages;

use Modules\EducationalStage\Filament\Panel\Admin\EducationalStageResource;

class ListEducationalStages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = EducationalStageResource::class;

}
