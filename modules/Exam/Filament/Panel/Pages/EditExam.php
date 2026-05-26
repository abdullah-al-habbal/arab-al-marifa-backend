<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Pages;

use Modules\Exam\Filament\Panel\ExamResource;

class EditExam extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamResource::class;
}
