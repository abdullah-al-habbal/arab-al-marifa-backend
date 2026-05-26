<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Pages;

use Modules\ExamAttempt\Filament\Panel\ExamAttemptResource;

class ListExamAttempts extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ExamAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
