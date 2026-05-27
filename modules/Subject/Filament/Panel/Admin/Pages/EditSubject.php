<?php

declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Admin\Pages;

use Modules\Subject\Filament\Panel\Admin\SubjectResource;

class EditSubject extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubjectResource::class;
}
