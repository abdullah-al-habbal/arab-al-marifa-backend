<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Admin\Pages;

use Modules\EducationalSubStage\Filament\Panel\Admin\EducationalSubStageResource;

class ListEducationalSubStages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = EducationalSubStageResource::class;

}
