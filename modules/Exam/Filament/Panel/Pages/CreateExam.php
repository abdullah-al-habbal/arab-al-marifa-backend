<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Pages;

use Modules\Exam\Filament\Panel\ExamResource;

class CreateExam extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamResource::class;
}
