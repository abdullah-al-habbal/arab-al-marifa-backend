<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin\Pages;

use Modules\ExamAttempt\Filament\Panel\Admin\ExamAttemptResource;

class EditExamAttempt extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
