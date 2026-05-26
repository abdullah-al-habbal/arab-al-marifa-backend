<?php
declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\QuestionOption\Filament\Panel\QuestionOptionResource;

class ViewQuestionOption extends ViewRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
