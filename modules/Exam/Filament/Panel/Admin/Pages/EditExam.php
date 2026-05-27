<?php

declare(strict_types=1);

namespace Modules\Exam\Filament\Panel\Admin\Pages;

use Modules\Exam\Filament\Panel\Admin\ExamResource;

class EditExam extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ExamResource::class;
}
