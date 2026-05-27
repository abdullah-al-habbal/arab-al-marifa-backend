<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Filament\Panel\Admin\Pages;

use Modules\SubjectCategory\Filament\Panel\Admin\SubjectCategoryResource;

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
