<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin\Pages;

use Modules\ExamAttempt\Filament\Panel\Admin\ExamAttemptResource;

class CreateExamAttempt extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
