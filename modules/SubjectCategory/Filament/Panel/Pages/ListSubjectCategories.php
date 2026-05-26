<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Pages;

use Modules\SubjectCategory\Filament\Panel\SubjectCategoryResource;

class ListSubjectCategories extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
