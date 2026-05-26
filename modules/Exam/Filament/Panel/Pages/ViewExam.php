<?php
declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Exam\Filament\Panel\ExamResource;

class ViewExam extends ViewRecord
{
    protected static string $resource = ExamResource::class;
}
