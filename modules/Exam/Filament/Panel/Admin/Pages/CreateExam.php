<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Admin\Pages;

use Modules\Exam\Filament\Panel\Admin\ExamResource;

class CreateExam extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ExamResource::class;
}
