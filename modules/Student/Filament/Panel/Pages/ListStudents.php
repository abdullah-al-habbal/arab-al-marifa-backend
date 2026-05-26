<?php

declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Pages;

use Modules\Student\Filament\Panel\StudentResource;

class ListStudents extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = StudentResource::class;

}
