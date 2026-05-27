<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Filament\Panel\Admin\Pages;

use Modules\EducationalSubStage\Filament\Panel\Admin\EducationalSubStageResource;

class EditEducationalSubStage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = EducationalSubStageResource::class;
}
