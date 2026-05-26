<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Pages;

use Modules\EducationalStage\Filament\Panel\EducationalStageResource;

class EditEducationalStage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = EducationalStageResource::class;
}
