<?php

declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Admin\Pages;

use Modules\Subject\Filament\Panel\Admin\SubjectResource;

class CreateSubject extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubjectResource::class;
}
