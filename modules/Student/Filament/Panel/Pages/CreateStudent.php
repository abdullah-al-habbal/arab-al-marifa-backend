<?php

declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Pages;

use Modules\Student\Filament\Panel\StudentResource;

class CreateStudent extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = StudentResource::class;
}
