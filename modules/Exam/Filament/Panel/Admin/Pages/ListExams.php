<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Admin\Pages;

use Modules\Exam\Filament\Panel\Admin\ExamResource;

class ListExams extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
