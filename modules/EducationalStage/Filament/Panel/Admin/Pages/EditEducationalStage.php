<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Filament\Panel\Admin\Pages;

use Modules\EducationalStage\Filament\Panel\Admin\EducationalStageResource;

class EditEducationalStage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = EducationalStageResource::class;
}
