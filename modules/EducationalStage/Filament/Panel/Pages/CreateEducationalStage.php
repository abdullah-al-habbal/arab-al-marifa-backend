<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Pages;

use Modules\EducationalStage\Filament\Panel\EducationalStageResource;

class CreateEducationalStage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = EducationalStageResource::class;
}
