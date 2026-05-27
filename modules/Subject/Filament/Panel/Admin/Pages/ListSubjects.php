<?php

declare(strict_types=1);

namespace Modules\Subject\Filament\Panel\Admin\Pages;

use Modules\Subject\Filament\Panel\Admin\SubjectResource;

class ListSubjects extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
