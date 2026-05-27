<?php
declare(strict_types=1);

namespace Modules\ExamAttempt\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\ExamAttempt\Filament\Panel\Admin\ExamAttemptResource;

class ViewExamAttempt extends ViewRecord
{
    protected static string $resource = ExamAttemptResource::class;
}
