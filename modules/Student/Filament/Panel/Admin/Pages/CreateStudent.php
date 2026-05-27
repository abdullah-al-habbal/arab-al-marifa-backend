<?php

declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin\Pages;

use Modules\Student\Filament\Panel\Admin\StudentResource;

class CreateStudent extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = StudentResource::class;
}
