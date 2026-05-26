<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Pages;

use Modules\ExamAttempt\Filament\Panel\ExamAttemptResource;

class EditExamAttempt extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
