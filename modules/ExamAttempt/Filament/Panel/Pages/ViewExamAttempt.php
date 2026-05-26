<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\ExamAttempt\Filament\Panel\ExamAttemptResource;

class ViewExamAttempt extends ViewRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
