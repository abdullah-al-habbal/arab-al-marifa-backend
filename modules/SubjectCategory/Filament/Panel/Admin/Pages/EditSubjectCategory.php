<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Admin\Pages;

use Modules\SubjectCategory\Filament\Panel\Admin\SubjectCategoryResource;

class EditSubjectCategory extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubjectCategoryResource::class;
}
