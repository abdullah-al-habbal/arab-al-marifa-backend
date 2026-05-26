<?php

declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Pages;

use Modules\Student\Filament\Panel\StudentResource;

class EditStudent extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = StudentResource::class;
}
