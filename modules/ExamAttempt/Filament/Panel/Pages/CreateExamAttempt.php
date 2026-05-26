<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Pages;

use Modules\ExamAttempt\Filament\Panel\ExamAttemptResource;

class CreateExamAttempt extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
