<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Admin\Pages;

use Modules\EducationalSubStage\Filament\Panel\Admin\EducationalSubStageResource;

class CreateEducationalSubStage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}
