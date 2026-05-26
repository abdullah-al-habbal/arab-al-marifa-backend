<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Pages;

use Modules\Exam\Filament\Panel\ExamResource;

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
