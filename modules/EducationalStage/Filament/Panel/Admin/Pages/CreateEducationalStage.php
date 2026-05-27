<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Admin\Pages;

use Modules\EducationalStage\Filament\Panel\Admin\EducationalStageResource;

class CreateEducationalStage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = EducationalStageResource::class;
}
