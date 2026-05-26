<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Pages;

use Modules\SubjectCategory\Filament\Panel\SubjectCategoryResource;

class CreateSubjectCategory extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubjectCategoryResource::class;
}
