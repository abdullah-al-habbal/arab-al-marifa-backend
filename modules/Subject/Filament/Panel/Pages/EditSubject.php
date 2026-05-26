<?php

declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Pages;

use Modules\Subject\Filament\Panel\SubjectResource;

class EditSubject extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubjectResource::class;
}
