<?php

declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin\Pages;

use Modules\Student\Filament\Panel\Admin\StudentResource;

class EditStudent extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = StudentResource::class;
}
